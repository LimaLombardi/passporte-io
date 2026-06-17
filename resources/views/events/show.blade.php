@extends('layouts.app')

@section('title', $event->title . ' — Passaporte.io')

@section('content')
<div class="page-card rounded-2xl overflow-hidden">
    <div class="relative">
        @if($event->banner_path)
            <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}"
                 class="w-full max-h-[420px] object-cover">
        @else
            <div class="w-full h-64 bg-gradient-to-br from-primary/40 to-secondary/30 flex items-center justify-center">
                <span class="text-6xl opacity-30">🎫</span>
            </div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-base-100 via-base-100/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 right-0 p-6 lg:p-10">
            <div class="flex flex-wrap gap-2 mb-3">
                <span class="badge badge-primary">{{ $event->category->name }}</span>
                <span class="badge badge-ghost border border-base-content/10">{{ $event->date_time->format('d/m/Y · H:i') }}</span>
                @if($participantsCount >= $event->capacity)
                    <span class="badge badge-error">Esgotado</span>
                @endif
            </div>
            <h1 class="text-3xl lg:text-4xl font-bold tracking-tight">{{ $event->title }}</h1>
        </div>
    </div>

    <div class="p-6 lg:p-10 grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <h2 class="text-sm font-semibold uppercase tracking-widest text-primary mb-3">Sobre</h2>
            <p class="text-base-content/80 leading-relaxed whitespace-pre-line">{{ $event->description }}</p>
        </div>

        <div class="space-y-4">
            <div class="page-card rounded-xl p-4 border border-base-content/10">
                <p class="text-xs uppercase tracking-widest text-base-content/40 mb-1">Local</p>
                <p class="font-medium">{{ $event->location }}</p>
            </div>
            <div class="page-card rounded-xl p-4 border border-base-content/10">
                <p class="text-xs uppercase tracking-widest text-base-content/40 mb-1">Organizador</p>
                <p class="font-medium">{{ $event->organizer->name }}</p>
            </div>
            <div class="page-card rounded-xl p-4 border border-base-content/10">
                <p class="text-xs uppercase tracking-widest text-base-content/40 mb-1">Vagas</p>
                <p class="font-medium text-2xl">{{ $participantsCount }}<span class="text-base-content/40 text-base"> / {{ $event->capacity }}</span></p>
                <progress class="progress progress-primary w-full mt-2" value="{{ $participantsCount }}" max="{{ $event->capacity }}"></progress>
            </div>

            <div class="flex flex-col gap-2 pt-2">
                <a href="{{ route('home') }}" class="btn btn-ghost btn-sm">← Voltar</a>

                @auth
                    @if(auth()->user()->isParticipant())
                        @if($isRegistered)
                            <form action="{{ route('registrations.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error w-full" onclick="return confirm('Cancelar inscrição?')">
                                    Cancelar inscrição
                                </button>
                            </form>
                        @elseif($participantsCount < $event->capacity)
                            <form action="{{ route('registrations.store', $event) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full">Inscrever-se</button>
                            </form>
                        @else
                            <button class="btn btn-disabled w-full" disabled>Vagas esgotadas</button>
                        @endif
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-full">Entrar para se inscrever</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
