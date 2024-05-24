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
        $estados = $this->getEstados();
        $especiesId = $this->getEspecies();
        
        $pets = Pet::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
        ->when($request->filled('especie_id'), function ($whenQuery) use ($request) {
            $whenQuery->where('especie_id', $request->especie_id);
        })
        ->when($request->filled('estado_id'), function ($whenQuery) use ($request) {
            $whenQuery->where('estado_id', $request->estado_id);
        })
        ->when($request->filled('estado_id') && $request->filled('cidadeId'), function ($whenQuery) use ($request) {
            $whenQuery->where('cidade_id', $request->cidadeId);
        })
        ->orderByDesc('created_at')
        ->paginate(6)
        ->withQueryString();

        if ($request->estado_id) {
            $cidades = $this->getCidadesByEstadoId($request->estado_id);
        }else{
            $cidades = $request->cidadeId;
        }

        return view('pets.index', [
            'pets' => $pets,
            'nome' => $request->nome,
            'estado_id' => $request->estado_id,
            'cidadeId' => $request->cidadeId,
            'cidades' => $cidades,
            'especie_id' => $request->especie_id,
            'image' => $request->image,
            'especiesId' => $especiesId,
            'estados' => $estados,
        ]);
    }

    public function myPets(Request $request)
    {
        $user_id  = $request->user()->id;
        
        $estados = $this->getEstados();
        $especiesId = $this->getEspecies();
        
        $pets = Pet::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
        ->when($request->filled('especie_id'), function ($whenQuery) use ($request) {
            $whenQuery->where('especie_id', $request->especie_id);
        })
        ->when($request->filled('estado_id'), function ($whenQuery) use ($request) {
            $whenQuery->where('estado_id', $request->estado_id);
        })
        ->when($request->filled('estado_id') && $request->filled('cidadeId'), function ($whenQuery) use ($request) {
            $whenQuery->where('cidade_id', $request->cidadeId);
        })
        ->where('user_id', $user_id)
        ->orderByDesc('created_at')
        ->paginate(6)
        ->withQueryString();

        if ($request->estado_id) {
            $cidades = $this->getCidadesByEstadoId($request->estado_id);
        }else{
            $cidades = $request->cidadeId;
        }

        return view('pets.index', [
            'pets' => $pets,
            'nome' => $request->nome,
            'estado_id' => $request->estado_id,
            'cidadeId' => $request->cidadeId,
            'cidades' => $cidades,
            'especie_id' => $request->especie_id,
            'image' => $request->image,
            'especiesId' => $especiesId,
            'estados' => $estados,
        ]);
    }

    public function show(Pet $pet, Request $request)
    {
        $user_id  = $request->user()->id;
        $porte = Porte::find($pet->porte_id);
        $raca = Raca::find($pet->raca_id);
        $especie = Especie::find($pet->especie_id);
        $doador = User::find($pet->user_id);
        $estado = Estado::find($pet->estado_id);
        $cidade = Cidade::find($pet->cidade_id);

        // Extrair os componentes do número de telefone
        $ddd = substr($doador->telefone, 0, 2);
        $prefixo = substr($doador->telefone, 2, 5);
        $sufixo = substr($doador->telefone, 7);

        // Formatar o número de telefone
        $telefoneFormatado = "($ddd)$prefixo-$sufixo";

        return view('pets.show', [
            'user_id'=> $user_id,
            'pet' => $pet,
            'porte' => $porte,
            'raca' => $raca,
            'especie' => $especie,
            'doador' => $doador,
            'estado' => $estado,
            'cidade' => $cidade,
            'telefone' => $telefoneFormatado
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

        $generoSelected = $pet->genero;
        $castracaoSelected = $pet->castracao;

        return view('pets.edit', compact('generoSelected', 'castracaoSelected', 'pet', 'especies', 'especiesIdSelected', 'portes', 'portesIdSelected', 'racas', 'racasIdSelected', 'cidades', 'estados', 'cidadeIdSelected', 'estadoIdSelected'));
    }
    public function update(PetRequest $request, Pet $pet)
    {
        $pet->fill($request->all());

        $pet->especie_id = $request->input('especie');
        $pet->porte_id = $request->input('porte');
        $pet->raca_id = $request->input('raca');
        $pet->estado_id = $request->input('estado');
        $pet->cidade_id = $request->input('cidade');

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName()) .'.'. strtotime("now") . "." . $extension;

            $requestImage->move(public_path('img/pets'), $imageName);

            $pet->image = 'img/pets/' . $imageName; 
        }
        
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

    public function getEstadoId()
    {
        $estados = DB::table('estados')
        ->pluck('id');
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