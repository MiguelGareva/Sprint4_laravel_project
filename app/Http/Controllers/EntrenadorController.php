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
            'email' => 'required|email|unique:entrenadores.mail'
        ]);

        $entrenador = Entrenador::create($validated);

        return redirect()->route('entrenadores.show', $entrenador)->with('success', 'Entrenador creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
