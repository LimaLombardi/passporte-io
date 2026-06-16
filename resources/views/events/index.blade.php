@extends('layouts.app')

@section('title', 'Eventos — Passaporte.io')

@section('content')
<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold">Eventos</h1>
    </div>

    <form method="GET" action="{{ route('home') }}" class="flex gap-2">
        <select name="category" class="select select-bordered w-full md:w-64" onchange="this.form.submit()">
            <option value="">Todas as categorias</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @if(request('category'))
            <a href="{{ route('home') }}" class="btn btn-ghost">Limpar</a>
        @endif
    </form>
</div>

@if($events->isEmpty())
    <div class="hero bg-base-100 rounded-box shadow">
        <div class="hero-content text-center py-16">
            <div>
                <h2 class="text-2xl font-bold">Nenhum evento encontrado</h2>
                <p class="py-4">Nenhum evento nesta categoria.</p>
            </div>
        </div>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($events as $event)
            <div class="card bg-base-100 shadow-xl">
                <figure class="h-48 bg-base-300">
                    @if($event->banner_path)
                        <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center w-full h-full text-base-content/40">
                            Sem banner
                        </div>
                    @endif
                </figure>
                <div class="card-body">
                    <div class="badge badge-primary badge-outline">{{ $event->category->name }}</div>
                    <h2 class="card-title">{{ $event->title }}</h2>
                    <p class="text-sm text-base-content/70">
                        <span class="font-medium">Organizador:</span> {{ $event->organizer->name }}
                    </p>
                    <p class="text-sm">
                        {{ $event->date_time->format('d/m/Y H:i') }}
                    </p>
                    <div class="card-actions justify-end mt-2">
                        <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm">Ver detalhes</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
