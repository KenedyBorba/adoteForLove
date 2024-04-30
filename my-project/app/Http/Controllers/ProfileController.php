<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Endereco;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $estados = $this->getEstados();
        
        //var_dump($request->user()->endereco_id); die;

        return view('profile.edit', [
            'user' => $request->user(),
            'endereco' => Endereco::find($request->user()->endereco_id),
            'estados' => $estados
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {

        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $endereco = Endereco::create([
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'bairro' => $request->bairro,
            'estado_id' => $request->estado,
            'cidade_id' => $request->cidade
        ]);

        $endereco->save();

        $request->user()->endereco_id = $endereco->id;

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    

    public function getEstados()
    {
        $estados = \DB::table('estados')
            -> get();
        return $estados;
    }

    public function getCidades(Request $request)
    {
        $cidades = \DB::table('cidades')
        ->where('estado_id', $request->estado_id)
        ->get();

        if(count($cidades) > 0){
            return response()->json($cidades);
        }
    }

}
