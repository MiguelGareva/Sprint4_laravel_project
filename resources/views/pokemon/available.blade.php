@extends('layouts.app')

@section('title', 'Pokémon Disponibles')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pokémon Disponibles para Capturar</h1>
                @if($entrenador)
                    <p class="text-gray-600 mt-1">Selecciona un Pokémon para el entrenador {{ $entrenador->nombre }}</p>
                @endif
            </div>
            <a href="{{ $entrenador ? route('entrenadores.show', $entrenador) : route('entrenadores.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Volver
            </a>
        </div>

        @if($pokemonDisponibles->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                No hay Pokémon disponibles para capturar en este momento.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($pokemonDisponibles as $pokemon)
                    <div class="border rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                        <div class="p-4 
                            @if($pokemon->tipo == 'Fuego') bg-red-100
                            @elseif($pokemon->tipo == 'Agua') bg-blue-100
                            @elseif($pokemon->tipo == 'Planta') bg-green-100
                            @elseif($pokemon->tipo == 'Eléctrico') bg-yellow-100
                            @elseif($pokemon->tipo == 'Tierra') bg-yellow-800 text-white
                            @elseif($pokemon->tipo == 'Roca') bg-gray-400
                            @elseif($pokemon->tipo == 'Veneno') bg-purple-100
                            @elseif($pokemon->tipo == 'Psíquico') bg-pink-100
                            @elseif($pokemon->tipo == 'Hielo') bg-blue-50
                            @elseif($pokemon->tipo == 'Dragón') bg-indigo-100
                            @elseif($pokemon->tipo == 'Fantasma') bg-purple-200
                            @elseif($pokemon->tipo == 'Siniestro') bg-gray-900 text-white
                            @elseif($pokemon->tipo == 'Acero') bg-gray-300
                            @elseif($pokemon->tipo == 'Hada') bg-pink-200
                            @elseif($pokemon->tipo == 'Volador') bg-blue-200
                            @elseif($pokemon->tipo == 'Lucha') bg-orange-100
                            @elseif($pokemon->tipo == 'Bicho') bg-green-200
                            @elseif($pokemon->tipo == 'Normal') bg-gray-100
                            @else bg-gray-50
                            @endif">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-bold">{{ $pokemon->nombre }}</h3>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($pokemon->tipo == 'Fuego') bg-red-500 text-white
                                    @elseif($pokemon->tipo == 'Agua') bg-blue-500 text-white
                                    @elseif($pokemon->tipo == 'Planta') bg-green-500 text-white
                                    @elseif($pokemon->tipo == 'Eléctrico') bg-yellow-500 text-black
                                    @elseif($pokemon->tipo == 'Tierra') bg-yellow-700 text-white
                                    @elseif($pokemon->tipo == 'Roca') bg-gray-600 text-white
                                    @elseif($pokemon->tipo == 'Veneno') bg-purple-500 text-white
                                    @elseif($pokemon->tipo == 'Psíquico') bg-pink-500 text-white
                                    @elseif($pokemon->tipo == 'Hielo') bg-blue-300 text-white
                                    @elseif($pokemon->tipo == 'Dragón') bg-indigo-500 text-white
                                    @elseif($pokemon->tipo == 'Fantasma') bg-purple-600 text-white
                                    @elseif($pokemon->tipo == 'Siniestro') bg-gray-800 text-white
                                    @elseif($pokemon->tipo == 'Acero') bg-gray-500 text-white
                                    @elseif($pokemon->tipo == 'Hada') bg-pink-400 text-white
                                    @elseif($pokemon->tipo == 'Volador') bg-blue-400 text-white
                                    @elseif($pokemon->tipo == 'Lucha') bg-orange-500 text-white
                                    @elseif($pokemon->tipo == 'Bicho') bg-green-600 text-white
                                    @elseif($pokemon->tipo == 'Normal') bg-gray-400 text-white
                                    @else bg-gray-300 text-gray-800
                                    @endif">
                                    {{ $pokemon->tipo }}
                                </span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Nivel:</span>
                                <span class="font-semibold">{{ $pokemon->nivel }}</span>
                            </div>
                            <div class="flex justify-between mb-3">
                                <span class="text-gray-600">Stats:</span>
                                <span class="font-semibold">{{ $pokemon->stats }}</span>
                            </div>
                            
                            @if($entrenador)
                                <form action="{{ route('pokemon.capture', $pokemon) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="entrenador_id" value="{{ $entrenador->id }}">
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded"
                                            onclick="return confirm('¿Estás seguro de querer capturar a {{ $pokemon->nombre }}?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                        </svg>
                                        Capturar
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('pokemon.show', $pokemon) }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                    Ver detalles
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection