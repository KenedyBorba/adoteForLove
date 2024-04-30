<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadoCidadeController extends Controller
{
    public function getEstados()
    {
        $estados = DB::table('estados')
            -> get();
        return view('profile.edit', ['estados' => $estados]);
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
}
