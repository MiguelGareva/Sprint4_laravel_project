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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrenadores = Entrenador::all();
        return view('pokemon.create', compact('entrenadors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:25',
            'tipo' => 'required|string|max:20',
            'stats' => 'required|integer|min:1|max:780',
            'nivel' => 'required|integer|min:1|max:100',
            'entrenador_id' => 'required|exists:entrenadores,id'
        ]);

        $entrenador = Entrenador::findOrFail($validated['entrenador_id']);
        if($entrenador->pokemon->count() >= 3){
            return redirect()->back()->withErrors(['entrenador_id' => 'El entrenador ya ha alcanzado el máximo de pokemons'])
                ->withInput();
        }

        $pokemon = Pokemon::create($validated);

        return redirect()->route('pokemon.show', $pokemon)->with('success', 'Pokemon creado correctamente');
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
            'nombre' => 'required|string|max:25',
            'tipo' => 'required|string|max:20',
            'stats' => 'required|integer|min:1|max:780',
            'nivel' => 'required|integer|min:1|max:100',
            'entrenador_id' => 'required|exists:entrenadores,id'
        ]);

        if($pokemon->entrenador_id != $validated['entrenador_id']){
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
     * Remove the specified resource from storage.
     */
    public function destroy(Pokemon $pokemon)
    {
        $pokemon->delete();
        return redirect()->route('pokemon.index')->with('success', 'Pokemon eliminado correctamente');
    }
}
