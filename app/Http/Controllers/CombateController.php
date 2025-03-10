<?php

namespace App\Http\Controllers;

use App\Models\Combate;
use App\Models\Entrenador;
use App\Services\CombateService; //Próximamente
use Illuminate\Http\Request;

class CombateController extends Controller
{

    protected $combateService;

    public function __construct(CombateService $combateService){
        $this->combateService = $combateService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $combates = Combate::with('entrenador1', 'entrenador2')->orderBy('fecha', 'desc')->get();
        return view('combates.index', compact('combates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $entrenadores = Entrenador::has('pokemon', '>=', 3)->get();
        if($entrenadores->count() < 2){
            return redirect()->route('combates.index')->with('error', 'Se necesitan dos entrenadores con 3 pokemons para crear un combate');
        }
        return view('combates.create', compact('entrenadores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
