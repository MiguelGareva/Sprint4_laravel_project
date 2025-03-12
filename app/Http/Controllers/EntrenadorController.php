<?php

namespace App\Http\Controllers;

use App\Models\Entrenador;
use Illuminate\Http\Request;

class EntrenadorController extends Controller
{
    public function index()
    {
        $entrenadores = Entrenador::withCount('pokemon')->orderBy('puntos', 'desc')->get();
        return view('entrenadores.index', compact('entrenadores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('entrenadores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:60',
            'email' => 'required|email|unique:entrenadores,email'
        ]);

        $validated['fecha_registro'] = now();
        $validated['puntos'] = 0;

        $entrenador = Entrenador::create($validated);

        return redirect()->route('entrenadores.show', $entrenador)->with('success', 'Entrenador creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Entrenador $entrenador)
    {
        $entrenador->load('pokemon');
        return view('entrenadores.show', compact('entrenador'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Entrenador $entrenador)
    {
        return view('entrenadores.edit', compact('entrenador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Entrenador $entrenador)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:60',
            'email' => 'required|email|unique:entrenadores,email,' . $entrenador->id
        ]);

        $entrenador->update($validated);

        return redirect()->route('entrenadores.show', $entrenador)->with('success', 'Entrenador actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Entrenador $entrenador)
    {
        $entrenador->delete();
        return redirect()->route('entrenadores.index')->with('success', 'Entrenador eliminado correctamente');
    }
}
