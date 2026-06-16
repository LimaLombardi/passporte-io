@extends('layouts.app')

@section('title', 'Meus Eventos — Passaporte.io')

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-3xl font-bold">Meus Eventos</h1>
    </div>
</div>

@if($registrations->isEmpty())
    <div class="alert shadow">
        <span>Você ainda não está inscrito em nenhum evento.</span>
    </div>
@else
    <div class="overflow-x-auto bg-base-100 rounded-box shadow">
        <table class="table">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Data</th>
                    <th>Código do ingresso</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($registrations as $event)
                    <tr>
                        <td>
                            <div class="font-bold">{{ $event->title }}</div>
                            <div class="text-sm opacity-50">{{ $event->location }}</div>
                        </td>
                        <td>{{ $event->date_time->format('d/m/Y H:i') }}</td>
                        <td>
                            <code class="badge badge-lg badge-neutral font-mono">{{ $event->pivot->ticket_code }}</code>
                        </td>
                        <td>
                            <form action="{{ route('registrations.destroy', $event) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-error btn-sm" onclick="return confirm('Cancelar inscrição?')">
                                    Cancelar
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
