@extends('layouts.app')

@section('title', 'Painel — Passaporte.io')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h1 class="text-3xl font-bold">Eventos cadastrados</h1>
    </div>
    <a href="{{ route('organizer.events.create') }}" class="btn btn-primary">Criar evento</a>
</div>

@if($events->isEmpty())
    <div class="alert shadow">
        <span>Você ainda não criou nenhum evento.</span>
    </div>
@else
    <div class="overflow-x-auto bg-base-100 rounded-box shadow">
        <table class="table">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th>Vagas</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td class="font-medium">{{ $event->title }}</td>
                        <td>{{ $event->category->name }}</td>
                        <td>{{ $event->date_time->format('d/m/Y H:i') }}</td>
                        <td>{{ $event->capacity }}</td>
                        <td class="flex gap-2">
                            <a href="{{ route('organizer.events.edit', $event) }}" class="btn btn-ghost btn-sm">Editar</a>
                            <form action="{{ route('organizer.events.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-sm" onclick="return confirm('Excluir evento?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
