@extends('layouts.app')

@section('title', 'Pokémon: ' . $pokemon->nombre)

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Información del Pokémon -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex flex-col items-center mb-4">
                    <div class="h-24 w-24 rounded-full flex items-center justify-center text-4xl font-bold mb-4
                        @if($pokemon->tipo == 'Fuego') bg-red-100 text-red-800
                        @elseif($pokemon->tipo == 'Agua') bg-blue-100 text-blue-800
                        @elseif($pokemon->tipo == 'Planta') bg-green-100 text-green-800
                        @elseif($pokemon->tipo == 'Eléctrico') bg-yellow-100 text-yellow-800
                        @elseif($pokemon->tipo == 'Tierra') bg-yellow-800 text-white
                        @elseif($pokemon->tipo == 'Roca') bg-gray-400 text-white
                        @elseif($pokemon->tipo == 'Veneno') bg-purple-100 text-purple-800
                        @elseif($pokemon->tipo == 'Psíquico') bg-pink-100 text-pink-800
                        @elseif($pokemon->tipo == 'Hielo') bg-blue-50 text-blue-800
                        @elseif($pokemon->tipo == 'Dragón') bg-indigo-100 text-indigo-800
                        @elseif($pokemon->tipo == 'Fantasma') bg-purple-200 text-purple-800
                        @elseif($pokemon->tipo == 'Siniestro') bg-gray-900 text-white
                        @elseif($pokemon->tipo == 'Acero') bg-gray-300 text-gray-800
                        @elseif($pokemon->tipo == 'Hada') bg-pink-200 text-pink-800
                        @elseif($pokemon->tipo == 'Volador') bg-blue-200 text-blue-800
                        @elseif($pokemon->tipo == 'Lucha') bg-orange-100 text-orange-800
                        @elseif($pokemon->tipo == 'Bicho') bg-green-200 text-green-800
                        @elseif($pokemon->tipo == 'Normal') bg-gray-100 text-gray-800
                        @else bg-gray-50 text-gray-800
                        @endif">
                        {{ substr($pokemon->nombre, 0, 1) }}
                    </div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $pokemon->nombre }}</h1>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full mt-2
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
                
                <div class="border-t border-gray-200 pt-4 mt-2">
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Nivel:</span>
                        <span class="font-semibold">{{ $pokemon->nivel }}</span>
                    </div>
                    <div class="flex justify-between py-2">
                        <span class="text-gray-600">Estadísticas:</span>
                        <span class="font-semibold">{{ $pokemon->stats }}/780</span>
                    </div>
                    <div class="mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-blue-600 h-2.5 rounded-full" 
                                 style="width: {{ min(100, ($pokemon->stats / 780) * 100) }}%"></div>
                        </div>
                    </div>
                    <div class="flex justify-between py-2 mt-2">
                        <span class="text-gray-600">Entrenador:</span>
                        <span class="font-semibold">
                            @if($pokemon->entrenador)
                                <a href="{{ route('entrenadores.show', $pokemon->entrenador) }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $pokemon->entrenador->nombre }}
                                </a>
                            @else
                                <span class="text-gray-500">Pokémon salvaje</span>
                            @endif
                        </span>
                    </div>
                </div>
                
                <div class="mt-6 flex space-x-3">
                    <a href="{{ route('pokemon.edit', $pokemon) }}" 
                       class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white font-medium py-2 px-4 rounded text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                        Editar
                    </a>
                    <form action="{{ route('pokemon.destroy', $pokemon) }}" method="POST" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded"
                                onclick="return confirm('¿Estás seguro de querer eliminar este Pokémon?')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            Eliminar
                        </button>
                    </form>
                </div>
                
                <a href="{{ route('pokemon.index') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Volver al listado
                </a>
            </div>
        </div>
        
        <!-- Información adicional y estadísticas -->
        <div class="md:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-6 h-full">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Estadísticas de Combate</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="border rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-3">Fortalezas y Debilidades</h3>
                        <div class="space-y-2">
                            <p><span class="font-semibold">Efectivo contra:</span></p>
                            <div class="flex flex-wrap gap-1">
                                @switch($pokemon->tipo)
                                    @case('Fuego')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">Planta</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-600 text-white">Bicho</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-300 text-white">Hielo</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-500 text-white">Acero</span>
                                        @break
                                    @case('Agua')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">Fuego</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-700 text-white">Tierra</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-600 text-white">Roca</span>
                                        @break
                                    @case('Planta')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-500 text-white">Agua</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-700 text-white">Tierra</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-600 text-white">Roca</span>
                                        @break
                                    @default
                                        <span class="text-gray-500">Varía según combate</span>
                                @endswitch
                            </div>
                            <p class="mt-3"><span class="font-semibold">Débil contra:</span></p>
                            <div class="flex flex-wrap gap-1">
                                @switch($pokemon->tipo)
                                    @case('Fuego')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-500 text-white">Agua</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-700 text-white">Tierra</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-600 text-white">Roca</span>
                                        @break
                                    @case('Agua')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-500 text-white">Planta</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-500 text-black">Eléctrico</span>
                                        @break
                                    @case('Planta')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-500 text-white">Fuego</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-400 text-white">Volador</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-600 text-white">Bicho</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-purple-500 text-white">Veneno</span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-300 text-white">Hielo</span>
                                        @break
                                    @default
                                        <span class="text-gray-500">Varía según combate</span>
                                @endswitch
                            </div>
                        </div>
                    </div>
                    
                    <div class="border rounded-lg p-4">
                        <h3 class="text-lg font-semibold mb-3">Potencial de Combate</h3>
                        <div class="space-y-3">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Ataque</span>
                                    <span>{{ floor($pokemon->stats / 6) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-red-500 h-2 rounded-full" 
                                         style="width: {{ min(100, (floor($pokemon->stats / 6) / 130) * 100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Defensa</span>
                                    <span>{{ floor($pokemon->stats / 6) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" 
                                         style="width: {{ min(100, (floor($pokemon->stats / 6) / 130) * 100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Velocidad</span>
                                    <span>{{ floor($pokemon->stats / 6) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-yellow-500 h-2 rounded-full" 
                                         style="width: {{ min(100, (floor($pokemon->stats / 6) / 130) * 100) }}%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span>Especial</span>
                                    <span>{{ floor($pokemon->stats / 6) }}</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-purple-500 h-2 rounded-full" 
                                         style="width: {{ min(100, (floor($pokemon->stats / 6) / 130) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 p-4 border rounded-lg">
                    <h3 class="text-lg font-semibold mb-3">Evolución y Desarrollo</h3>
                    <p class="text-gray-700">
                        Este Pokémon de tipo {{ $pokemon->tipo }} se encuentra actualmente en el nivel {{ $pokemon->nivel }}. 
                        @if($pokemon->nivel < 30)
                            Aún tiene mucho potencial para crecer y mejorar sus estadísticas.
                        @elseif($pokemon->nivel < 70)
                            Ha alcanzado un nivel intermedio y muestra buenas habilidades en combate.
                        @else
                            Ha alcanzado un nivel muy alto y domina perfectamente sus habilidades.
                        @endif
                    </p>
                    
                    <div class="mt-4">
                        <div class="flex justify-between text-sm mb-1">
                            <span>Progreso hacia nivel máximo</span>
                            <span>{{ $pokemon->nivel }}/100</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                            <div class="bg-green-600 h-2.5 rounded-full" 
                                 style="width: {{ $pokemon->nivel }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection