@extends('layouts.app')

@section('title', 'Eventos — Passaporte.io')

@section('content')
<div class="mb-10">
    <p class="text-primary text-sm font-medium uppercase tracking-widest mb-2">Explorar</p>
    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
        <h1 class="text-4xl lg:text-5xl font-bold tracking-tight">Eventos</h1>

        <form method="GET" action="{{ route('home') }}" class="flex flex-wrap gap-2">
            @foreach($categories as $category)
                <label class="cursor-pointer">
                    <input type="radio" name="category" value="{{ $category->id }}" class="peer hidden"
                           @checked(request('category') == $category->id) onchange="this.form.submit()">
                    <span class="btn btn-sm btn-ghost border border-base-content/10 peer-checked:btn-primary peer-checked:border-primary">
                        {{ $category->name }}
                    </span>
                </label>
            @endforeach
            @if(request('category'))
                <a href="{{ route('home') }}" class="btn btn-sm btn-ghost">Todos</a>
            @endif
        </form>
    </div>
</div>

@if($events->isEmpty())
    <div class="page-card rounded-2xl p-16 text-center">
        <p class="text-5xl mb-4 opacity-30">📅</p>
        <h2 class="text-xl font-semibold">Nenhum evento encontrado</h2>
        <p class="text-base-content/50 mt-2">Nenhum evento nesta categoria.</p>
    </div>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @foreach($events as $event)
            <article class="event-card page-card rounded-2xl overflow-hidden group">
                <figure class="relative h-52 overflow-hidden">
                    @if($event->banner_path)
                        <img src="{{ asset('storage/'.$event->banner_path) }}" alt="{{ $event->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-primary/30 to-secondary/20 flex items-center justify-center">
                            <span class="text-4xl opacity-40">🎫</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-base-100 via-transparent to-transparent"></div>
                    <span class="absolute top-3 left-3 badge badge-primary badge-sm">{{ $event->category->name }}</span>
                </figure>

                <div class="p-5 -mt-6 relative">
                    <h2 class="text-lg font-bold leading-snug mb-3 line-clamp-2">{{ $event->title }}</h2>

                    <div class="space-y-2 text-sm text-base-content/60 mb-4">
                        <p class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $event->date_time->format('d/m/Y · H:i') }}
                        </p>
                        <p class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 shrink-0 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            {{ $event->organizer->name }}
                        </p>
                    </div>

                    <a href="{{ route('events.show', $event) }}" class="btn btn-primary btn-sm btn-block">
                        Ver detalhes
                    </a>
                </div>
            </article>
        @endforeach
    </div>
@endif
@endsection
