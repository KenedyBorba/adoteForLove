<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Http\Requests\PetRequest;
use App\Models\Porte;
use App\Models\Raca;
use App\Models\Especie;
use App\Models\User;
use App\Models\Estado;
use App\Models\Cidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PetController extends Controller
{
    public function index(Request $request)
    {
        $pets = Pet::when($request->has('nome'), function ($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
        ->with('portes')
        ->with('especies')
        ->with('racas')
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

        return view('pets.index', [
            'pets' => $pets,
            'nome' => $request->nome,
            'image' => $request->image,
        ]);
    }

    public function show(Pet $pet, Request $request)
    {
        $porte = Porte::find($pet->porte_id);
        $raca = Raca::find($pet->raca_id);
        $especie = Especie::find($pet->especie_id);
        $doador = User::find($pet->user_id);
        $estado = Estado::find($pet->estado_id);
        $cidade = Cidade::find($pet->cidade_id);

        return view('pets.show', [
            'pet' => $pet,
            'porte' => $porte,
            'raca' => $raca,
            'especie' => $especie,
            'doador' => $doador,
            'estado' => $estado,
            'cidade' => $cidade,
        ]);
    }

    public function create(Request $request)
    {
        $user_id  = $request->user()->id;
        $portes = $this->getPortes();
        $especies = $this->getEspecies();
        $racas = $this->getRacas();
        $estados = $this->getEstados();

        return view('pets.create',[
            'portes' => $portes,
            'especies' => $especies,
            'racas'=> $racas,
            'estados' => $estados,
            'user_id '=> $user_id,
        ]);
    }

    public function store(PetRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $data['especie_id'] = $request->input('especie');
        $data['porte_id'] = $request->input('porte');
        $data['raca_id'] = $request->input('raca');
        $data['estado_id'] = $request->input('estado');
        $data['cidade_id'] = $request->input('cidade');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()) .'.'. strtotime("now") . "." . $extension;

            $requestImage->move(public_path('img/pets'), $imageName);

            $data['image'] = 'img/pets/' . $imageName; 
        }

        Pet::create($data);

        return redirect('pets');
    }

    public function edit(Pet $pet, Request $request)
    {
        $user  = $request->user()->id;
        $portes = $this->getPortes();
        $especies = $this->getEspecies();
        $racas = $this->getRacas();
        $estados = $this->getEstados();

        $portesIdSelected = Porte::find($pet->porte_id)['id'];
        $especiesIdSelected = Especie::find($pet->especie_id)['id'];
        $racasIdSelected = Raca::find($pet->raca_id)['id'];

        $cidades = $this->getCidadesByEstadoId($pet->estado_id);

        $cidadeIdSelected = $pet->cidade_id;
        $estadoIdSelected = $pet->estado_id;

        return view('pets.edit', compact('pet', 'especies', 'especiesIdSelected', 'portes', 'portesIdSelected', 'racas', 'racasIdSelected', 'cidades', 'estados', 'cidadeIdSelected', 'estadoIdSelected'));
    }
    public function update(PetRequest $request, Pet $pet)
    {
        $pet->fill($request->all());

        $pet->especies()->associate(Especie::find($pet->especie_id));
        $pet->racas()->associate(Raca::find($pet->raca_id));
        $pet->portes()->associate(Porte::find($pet->porte_id));
        $pet->save();

        return redirect()->route('pets.index');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return redirect()->route('pets.index');
    }

    public function getPortes()
    {
        $portes = DB::table('portes')
            -> get();
        return $portes;
    }

    public function getRacas()
    {
        $racas = DB::table('racas')
            -> get();
        return $racas;
    }

    public function getEspecies()
    {
        $especies = DB::table('especies')
            -> get();
        return $especies;
    }

    public function getEstados()
    {
        $estados = DB::table('estados')
            -> get();
        return $estados;
    }

    public function getCidades(Request $request)
    {
        $cidades = DB::table('cidades')
            ->where('estado_id', $request->estado_id)
            ->get();

        if(count($cidades) > 0){
            return response()->json($cidades);
        }
    }

    public function getCidadesByEstadoId(string $estadoId)
    {
        $cidades = DB::table('cidades')
            ->where('estado_id', $estadoId)
            ->get();

        if(count($cidades) > 0){
            return $cidades;
        }

        return [];
    }
}