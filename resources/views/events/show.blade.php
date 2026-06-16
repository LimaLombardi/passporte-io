@extends('layouts.app')

@section('title', $event->title . ' — Passaporte.io')

@section('content')
<div class="card bg-base-100 shadow-xl overflow-hidden">
    <figure class="max-h-96 bg-base-300">
        @if($event->banner_path)
            <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}" class="w-full object-cover">
        @else
            <div class="flex items-center justify-center w-full h-64 text-base-content/40">
                Sem banner
            </div>
        @endif
    </figure>

    <div class="card-body">
        <div class="flex flex-wrap gap-2 mb-2">
            <div class="badge badge-primary">{{ $event->category->name }}</div>
            <div class="badge badge-ghost">{{ $event->date_time->format('d/m/Y H:i') }}</div>
        </div>

        <h1 class="text-3xl font-bold">{{ $event->title }}</h1>

        <div class="grid md:grid-cols-2 gap-4 mt-4">
            <div>
                <h3 class="font-semibold text-lg mb-2">Descrição</h3>
                <p class="text-base-content/80 whitespace-pre-line">{{ $event->description }}</p>
            </div>
            <div class="space-y-3">
                <div class="stat bg-base-200 rounded-box">
                    <div class="stat-title">Local</div>
                    <div class="stat-value text-lg">{{ $event->location }}</div>
                </div>
                <div class="stat bg-base-200 rounded-box">
                    <div class="stat-title">Organizador</div>
                    <div class="stat-value text-lg">{{ $event->organizer->name }}</div>
                </div>
                <div class="stat bg-base-200 rounded-box">
                    <div class="stat-title">Vagas</div>
                    <div class="stat-value text-lg">
                        {{ $participantsCount }} / {{ $event->capacity }}
                        @if($participantsCount >= $event->capacity)
                            <span class="badge badge-error ml-2">Esgotado</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card-actions justify-end mt-6">
            <a href="{{ route('home') }}" class="btn btn-ghost">Voltar</a>

            @auth
                @if(auth()->user()->isParticipant())
                    @if($isRegistered)
                        <form action="{{ route('registrations.destroy', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-error" onclick="return confirm('Cancelar inscrição?')">
                                Cancelar inscrição
                            </button>
                        </form>
                    @elseif($participantsCount < $event->capacity)
                        <form action="{{ route('registrations.store', $event) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">Inscrever-se</button>
                        </form>
                    @else
                        <button class="btn btn-disabled" disabled>Vagas esgotadas</button>
                    @endif
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Entrar para se inscrever</a>
            @endauth
        </div>
    </div>
</div>
@endsection
