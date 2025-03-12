<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga Pokémon - @yield('title', 'Inicio')</title>
    <meta name="description" content="Aplicación web para la liga Pokémon">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @yield('styles')
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Header/Navbar -->
    <header class="bg-red-600 text-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <nav class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="font-bold text-2xl">Liga Pokémon</a>
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('entrenadores.index') }}" class="hover:bg-red-700 px-3 py-2 rounded">Entrenadores</a>
                        <a href="{{ route('pokemon.index') }}" class="hover:bg-red-700 px-3 py-2 rounded">Pokémon</a>
                        <a href="{{ route('combates.index') }}" class="hover:bg-red-700 px-3 py-2 rounded">Combates</a>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    @auth
                        <span class="mr-2">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-700 hover:bg-red-800 px-3 py-1 rounded">Cerrar sesión</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:bg-red-700 px-3 py-1 rounded">Iniciar sesión</a>
                        <a href="{{ route('register') }}" class="bg-red-700 hover:bg-red-800 px-3 py-1 rounded">Registrarse</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Flash Messages Component -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 mx-4 mt-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <p>&copy; {{ date('Y') }} Liga Pokémon. Todos los derechos reservados.</p>
                </div>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-gray-300">Términos y condiciones</a>
                    <a href="#" class="hover:text-gray-300">Política de privacidad</a>
                    <a href="#" class="hover:text-gray-300">Contacto</a>
                </div>
            </div>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>