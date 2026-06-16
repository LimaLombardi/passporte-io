<!DOCTYPE html>
<html lang="pt-BR" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Passaporte.io')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-base-200">
    <div class="navbar bg-primary text-primary-content shadow-lg">
        <div class="navbar-start">
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold">Passaporte.io</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li><a href="{{ route('home') }}">Eventos</a></li>
                @auth
                    @if(auth()->user()->isParticipant())
                        <li><a href="{{ route('my-events.index') }}">Meus Eventos</a></li>
                    @endif
                    @if(auth()->user()->isOrganizer())
                        <li><a href="{{ route('organizer.events.index') }}">Painel</a></li>
                    @endif
                @endauth
            </ul>
        </div>
        <div class="navbar-end gap-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-secondary btn-sm">Cadastrar</a>
            @else
                <span class="hidden sm:inline text-sm opacity-90">{{ auth()->user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Sair</button>
                </form>
            @endguest
        </div>
    </div>

    <main class="container mx-auto px-4 py-8 max-w-6xl">
        @if(session('success'))
            <div class="alert alert-success mb-6 shadow">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error mb-6 shadow">
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error mb-6 shadow">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="footer footer-center p-6 bg-base-300 text-base-content mt-auto">
        <aside>
            <p>Passaporte.io &copy; {{ date('Y') }}</p>
        </aside>
    </footer>
</body>
</html>
