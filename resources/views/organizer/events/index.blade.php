@extends('layouts.app')

@section('title', 'Painel — Passaporte.io')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 mb-8">
    <div>
        <p class="text-primary text-sm font-medium uppercase tracking-widest mb-2">Organizador</p>
        <h1 class="text-4xl font-bold tracking-tight">Eventos cadastrados</h1>
    </div>
    <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">
        + Criar evento
    </a>
</div>

@if($events->isEmpty())
    <div class="page-card rounded-2xl p-12 text-center">
        <p class="text-4xl mb-3 opacity-30">📋</p>
        <p class="text-base-content/60 mb-4">Você ainda não criou nenhum evento.</p>
        <a href="{{ route('organizer.events.create') }}" class="btn btn-primary btn-sm">Criar primeiro evento</a>
    </div>
@else
    <div class="page-card rounded-2xl overflow-hidden border border-base-content/10">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="border-base-content/10 text-base-content/50 text-xs uppercase tracking-widest">
                        <th>Título</th>
                        <th>Categoria</th>
                        <th>Data</th>
                        <th>Vagas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $event)
                        <tr class="border-base-content/10 hover:bg-base-200/30">
                            <td class="font-semibold">{{ $event->title }}</td>
                            <td><span class="badge badge-primary badge-outline badge-sm">{{ $event->category->name }}</span></td>
                            <td class="text-base-content/70">{{ $event->date_time->format('d/m/Y H:i') }}</td>
                            <td>{{ $event->capacity }}</td>
                            <td class="flex gap-2">
                                <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-ghost btn-sm">Editar</a>
                                <form action="{{ route('organizer.events.destroy', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm btn-outline" onclick="return confirm('Excluir evento?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endif
@endsection
