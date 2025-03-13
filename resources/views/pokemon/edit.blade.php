@extends('layouts.app')

@section('title', 'Entrenar Pokémon: ' . $pokemon->nombre)

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 max-w-2xl mx-auto">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Entrenar a {{ $pokemon->nombre }}</h1>
            <p class="text-gray-600 mt-1">Modifica el nivel de tu Pokémon</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <p class="font-bold">Por favor corrige los siguientes errores:</p>
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pokemon.update', $pokemon) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                <div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100">
                    {{ $pokemon->nombre }}
                </div>
                <p class="text-gray-600 text-xs mt-1">No se puede cambiar el nombre de un Pokémon.</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Tipo</label>
                <div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 flex items-center">
                    <span class="px-2 py-1 text-xs font-semibold rounded-full mr-2
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
                <p class="text-gray-600 text-xs mt-1">No se puede cambiar el tipo de un Pokémon.</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Estadísticas</label>
                <div class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100">
                    {{ $pokemon->stats }}/780
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2.5 mt-1">
                    <div class="bg-blue-600 h-2.5 rounded-full" 
                         style="width: {{ min(100, ($pokemon->stats / 780) * 100) }}%"></div>
                </div>
                <p class="text-gray-600 text-xs mt-1">Las estadísticas base de cada Pokémon son fijas.</p>
            </div>

            <div class="mb-4">
                <label for="nivel" class="block text-gray-700 text-sm font-bold mb-2">Nivel</label>
                <input type="number" name="nivel" id="nivel" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nivel') border-red-500 @enderror"
                       value="{{ old('nivel', $pokemon->nivel) }}" 
                       min="1"
                       max="100"
                       required>
                @error('nivel')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-600 text-xs mt-1">Puedes entrenar a tu Pokémon para subir su nivel (1-100)</p>
            </div>

            <div class="mb-4">
                <label for="entrenador_id" class="block text-gray-700 text-sm font-bold mb-2">Entrenador</label>
                <select name="entrenador_id" id="entrenador_id" 
                       class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('entrenador_id') border-red-500 @enderror"
                       required>
                    <option value="{{ $pokemon->entrenador_id }}">{{ $pokemon->entrenador->nombre }} (Actual)</option>
                    <option value="">Liberar Pokémon</option>
                    @foreach($entrenadores as $entrenador)
                        @if($entrenador->id != $pokemon->entrenador_id)
                            <option value="{{ $entrenador->id }}" 
                                    {{ old('entrenador_id') == $entrenador->id ? 'selected' : '' }}
                                    {{ $entrenador->pokemon->count() >= 3 ? 'disabled' : '' }}>
                                {{ $entrenador->nombre }} 
                                ({{ $entrenador->pokemon->count() }}/3 Pokémon)
                                @if($entrenador->pokemon->count() >= 3)
                                    - Equipo completo
                                @endif
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('entrenador_id')
                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                @enderror
                <p class="text-gray-600 text-xs mt-1">Puedes transferir tu Pokémon a otro entrenador o liberarlo.</p>
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('pokemon.show', $pokemon) }}" class="inline-flex items-center px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 active:bg-gray-500 focus:outline-none focus:border-gray-500 focus:shadow-outline-gray transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:shadow-outline-yellow transition ease-in-out duration-150">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
@endsection