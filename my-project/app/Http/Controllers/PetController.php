<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Http\Requests\PetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        ->orderByDesc('criado_em')
        ->paginate(10)
        ->withQueryString();
        
        return view('pets.index', [
            'pets' => $pets,
            'nome' => $request->nome,
        ]);
    }

    public function show(Pet $pet)
    {
        return view('pets.show')->with('pet', $pet);
    }

    public function create()
    {
        $portes = $this->getPortes();
        $especies = $this->getEspecies();
        $racas = $this->getRacas();

        return view('pets.create',[
            'portes' => $portes,
            'especies' => $especies,
            'racas'=> $racas
        ]);
    }

    public function store(PetRequest $request)
    {
        $request->validated();

        Pet::create($request->all());
        
        return redirect('pets');
    }

    public function edit(Pet $pet)
    {
        return view('pets.edit', compact('pet'));
    }

    public function update(PetRequest $request, Pet $pet)
    {
        
        $pet->fill($request->all())->save;
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