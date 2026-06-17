<!DOCTYPE html>
<html lang="pt-BR" data-theme="passaporte">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Passaporte.io')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex flex-col font-sans antialiased">
    <div class="navbar sticky top-0 z-50 glass-nav px-4 lg:px-8">
        <div class="navbar-start">
            <div class="dropdown lg:hidden">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </div>
                <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 rounded-box z-50 mt-3 w-52 p-2 shadow-xl border border-base-content/10">
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
            <a href="{{ route('home') }}" class="btn btn-ghost text-xl font-bold tracking-tight gap-2">
                <span class="text-primary">●</span> Passaporte.io
            </a>
        </div>

        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1 gap-1">
                <li><a href="{{ route('home') }}" class="rounded-lg {{ request()->routeIs('home') ? 'bg-primary/15 text-primary' : '' }}">Eventos</a></li>
                @auth
                    @if(auth()->user()->isParticipant())
                        <li><a href="{{ route('my-events.index') }}" class="rounded-lg {{ request()->routeIs('my-events.*') ? 'bg-primary/15 text-primary' : '' }}">Meus Eventos</a></li>
                    @endif
                    @if(auth()->user()->isOrganizer())
                        <li><a href="{{ route('organizer.events.index') }}" class="rounded-lg {{ request()->routeIs('organizer.*') ? 'bg-primary/15 text-primary' : '' }}">Painel</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        <div class="navbar-end gap-2">
            @guest
                <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Cadastrar</a>
            @else
                <div class="hidden sm:flex items-center gap-2 px-3 py-1.5 rounded-full bg-base-300/50 text-sm">
                    <span class="w-2 h-2 rounded-full bg-success"></span>
                    {{ auth()->user()->name }}
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-ghost btn-sm">Sair</button>
                </form>
            @endguest
        </div>
    </div>

    <main class="flex-1 container mx-auto px-4 py-10 max-w-7xl">
        @if(session('success'))
            <div role="alert" class="alert alert-success mb-6 border border-success/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div role="alert" class="alert alert-error mb-6 border border-error/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        @if($errors->any())
            <div role="alert" class="alert alert-error mb-6 border border-error/30">
                <ul class="list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <footer class="border-t border-base-content/10 py-8 mt-8">
        <div class="container mx-auto px-4 max-w-7xl flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-base-content/50">
            <p class="font-semibold text-base-content/70">Passaporte.io</p>
            <p>&copy; {{ date('Y') }}</p>
        </div>
    </footer>
</body>
</html>
