@extends('layouts.app')

@section('title', 'Listado de Pokémon')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Pokémon Registrados</h1>
            <a href="{{ route('pokemon.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 00-1 1v5H4a1 1 0 100 2h5v5a1 1 0 102 0v-5h5a1 1 0 100-2h-5V4a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Nuevo Pokémon
            </a>
        </div>

        @if($pokemon->isEmpty())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                No hay Pokémon registrados. ¡Captura el primero!
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nivel</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stats</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Entrenador</th>
                            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($pokemon as $poke)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <a href="{{ route('pokemon.show', $poke) }}" class="text-blue-600 hover:text-blue-900 font-medium">
                                        {{ $poke->nombre }}
                                    </a>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                    @if($poke->tipo == 'Fuego') bg-red-500 text-white
                                    @elseif($poke->tipo == 'Agua') bg-blue-500 text-white
                                    @elseif($poke->tipo == 'Planta') bg-green-500 text-white
                                    @elseif($poke->tipo == 'Eléctrico') bg-yellow-500 text-black
                                    @elseif($poke->tipo == 'Tierra') bg-yellow-700 text-white
                                    @elseif($poke->tipo == 'Roca') bg-gray-600 text-white
                                    @elseif($poke->tipo == 'Veneno') bg-purple-500 text-white
                                    @elseif($poke->tipo == 'Psíquico') bg-pink-500 text-white
                                    @elseif($poke->tipo == 'Hielo') bg-blue-300 text-white
                                    @elseif($poke->tipo == 'Dragón') bg-indigo-500 text-white
                                    @elseif($poke->tipo == 'Fantasma') bg-purple-600 text-white
                                    @elseif($poke->tipo == 'Siniestro') bg-gray-800 text-white
                                    @elseif($poke->tipo == 'Acero') bg-gray-500 text-white
                                    @elseif($poke->tipo == 'Hada') bg-pink-400 text-white
                                    @elseif($poke->tipo == 'Volador') bg-blue-400 text-white
                                    @elseif($poke->tipo == 'Lucha') bg-orange-500 text-white
                                    @elseif($poke->tipo == 'Bicho') bg-green-600 text-white
                                    @elseif($poke->tipo == 'Normal') bg-gray-400 text-white
                                    @else bg-gray-300 text-gray-800
                                    @endif">
                                        {{ $poke->tipo }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <span class="font-semibold">Nv. {{ $poke->nivel }}</span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-blue-600 h-2.5 rounded-full" 
                                             style="width: {{ min(100, ($poke->stats / 780) * 100) }}%"></div>
                                    </div>
                                    <span class="text-xs text-gray-500">{{ $poke->stats }}/780</span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    @if($poke->entrenador)
                                        <a href="{{ route('entrenadores.show', $poke->entrenador) }}" class="text-indigo-600 hover:text-indigo-900">
                                            {{ $poke->entrenador->nombre }}
                                        </a>
                                    @else
                                        <span class="text-gray-500">Pokémon salvaje</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('pokemon.show', $poke) }}" class="text-indigo-600 hover:text-indigo-900" title="Ver detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('pokemon.edit', $poke) }}" class="text-yellow-600 hover:text-yellow-900" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('pokemon.destroy', $poke) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" 
                                                    onclick="return confirm('¿Estás seguro de querer eliminar este Pokémon?')" title="Eliminar">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection