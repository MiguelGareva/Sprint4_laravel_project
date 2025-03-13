<?php

namespace App\Http\Controllers;

use App\Models\Pokemon;
use App\Models\Entrenador;
use Illuminate\Http\Request;

class PokemonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pokemon = Pokemon::with('entrenador')->get();
        return view('pokemon.index', compact('pokemon'));
    }

    /**
     * Show available pokemon.
     */
    public function available(Request $request){
        $entrenador_id = $request->input('entrenador_id');
        $entrenador = null;

        if($entrenador_id){
            $entrenador = Entrenador::findOrFail($entrenador_id);

            if($entrenador->pokemon->count() >= 3){
                return redirect()->route('entrenadores.show', $entrenador)
                ->with('error', 'Este entrenador ya ha alcanzado el máximo permitido de pokemons.');
            }
        }

        $pokemonDisponibles = Pokemon::whereNull('entrenador_id')->get();

        if($pokemonDisponibles->isEmpty()){
            return redirect()->route('entrenadores.show', $entrenador)
            ->with('info', 'No hay pokemon disponibles para capturar en este momento.');
        }
         return view('pokemon.available', compact('pokemonDisponibles', 'entrenador'));
    }

    /**
     * Assign a Pokemon to a trainer
     */
    public function capture(Request $request, Pokemon $pokemon)
    {
        $validated = $request->validate([
            'entrenador_id' => 'required|exists:entrenadores,id'
        ]);

        $entrenador = Entrenador::findOrFail($validated['entrenador_id']);
        if ($entrenador->pokemon->count() >= 3) {
            return redirect()->route('entrenadores.show', $entrenador)
                ->with('error', 'Este entrenador ya tiene el máximo de 3 Pokémon permitidos.');
        }

        if($pokemon->entrenador_id !== null){
            return redirect()->route('pokemon.available', ['entrenador_id' => $entrenador->id])
                ->with('error', 'Este Pokemon ya ha sido capturado por otro entrenador.');
        }

        $pokemon->entrenador_id = $entrenador->id;
        $pokemon->save();

        return redirect()->route('entrenadores.show', $entrenador)
            ->with('success', 'Has capturado un ' . $pokemon->nombre . ' con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pokemon $pokemon)
    {
        $pokemon->load('entrenador');
        return view('pokemon.show', compact('pokemon'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pokemon $pokemon)
    {
        $entrenadores = Entrenador::all();
        return view('pokemon.edit', compact('pokemon', 'entrenadores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pokemon $pokemon)
    {
        $validated = $request->validate([
            'nivel' => 'required|integer|min:1|max:100',
            'entrenador_id' => 'required|exists:entrenadores,id'
        ]);

        if (isset($validated['entrenador_id']) && $pokemon->entrenador_id != $validated['entrenador_id']){
            $entrenador = Entrenador::findOrFail($validated['entrenador_id']);
            if($entrenador->pokemon->count() >= 3){
                return back()->withErrors(['entrenador_id' => 'El entrenador ya ha alcanzado el máximo de pokemons'])
                    ->withInput();
            }
        }

        $pokemon->update($validated);

        return redirect()->route('pokemon.show', $pokemon)->with('success', 'Pokemon actualizado correctamente');
    }
    /**
     * Release a Pokemon from trainer
     */ 
    public function release(Pokemon $pokemon){
        if($pokemon->entrenador_id === null){
            return redirect()->route('pokemon.index')
            ->with('error', 'Este pokemon ya está liberado.');
        }

        $entrenador = $pokemon->entrenador;
        $pokemon->entrenador_id = null;
        $pokemon->save();

        return redirect()->route('entrenadores.show', $entrenador)
        ->with('success', 'Has liberado a ' . $pokemon->nombre . ' con éxito.');

    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        if ($pokemon->entrenador_id !== null) {
            return $this->release($pokemon);
        }
        
        return redirect()->route('pokemon.index')
            ->with('info', 'Los Pokémon no pueden ser eliminados, solo liberados si tienen entrenador.');
    }
}
