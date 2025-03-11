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
        $validated = $request->validate([
            'entrenador1_id' => 'required|exists:entrenadores,id',
            'entrenador2_id' => 'required|exists:entrenadores,id|different:entrenador1_id',
            'fecha' => 'required|date'
        ]);

        $entrenador1 = Entrenador::find($validated['entrenador1_id']);
        $entrenador2 = Entrenador::find($validated['entrenador2_id']);

        if($entrenador1->pokemon->count() < 3 || $entrenador2->pokemon->count() < 3){
            return back()->withErrors(['error' => 'Ambos entrenadores deben tener 3 pokemons para poder combatir'])->withInput();
        }

        $resultado = $this->combateService->realizarCombate($entrenador1, $entrenador2);

        $combate = Combate::create([
            'entrenador1_id' => $validated['entrenador1_id'],
            'entrenador2_id' => $validated['entrenador2_id'],
            'fecha' => $validated['fecha'],
            'resultado' => $resultado['resultado']
        ]);

        $entrenador1->puntos += $resultado['puntos_entrenador1'];
        $entrenador2->puntos += $resultado['puntos_entrenador2'];
        $entrenador1->save();
        $entrenador2->save();

        return redirect()->route('combates.show', $combate)->with('success', 'Combate realizado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Combate $combate)
    {
        $combate->load('entrenador1', 'entrenador2');
        return view('combates.show', compact('combate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Combate $combate)
    {
        return redirect()->route('combates.show', $combate)->with('error', 'No se pueden editar combates ya realizados');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Combate $combate)
    {
        return redirect()->route('combates.show', $combate)->with('error', 'No se pueden actualizar combates ya realizados');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Combate $combate)
    {
        $entrenador1 = $combate->entrenador1;
        $entrenador2 = $combate->entrenador2;

        if($combate->resultado == 'entrenador1'){
            $entrenador1->puntos -= 3;
        }else if($combate->resultado == 'entrenador2'){
            $entrenador2->puntos -= 3;
        }else{
            $entrenador1->puntos -= 1;
            $entrenador2->puntos -= 1;
        }

        $entrenador1->save();
        $entrenador2->save();

        $combate->delete();

        return redirect()->route('combates.index')->with('success', 'Combate eliminado correctamente y puntos actualizados');
    }
}
