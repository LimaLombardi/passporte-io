@extends('layouts.app')

@section('title', 'Meus Eventos — Passaporte.io')

@section('content')
<div class="mb-8">
    <p class="text-primary text-sm font-medium uppercase tracking-widest mb-2">Participante</p>
    <h1 class="text-4xl font-bold tracking-tight">Meus Eventos</h1>
</div>

@if($registrations->isEmpty())
    <div class="page-card rounded-2xl p-12 text-center">
        <p class="text-4xl mb-3 opacity-30">🎟️</p>
        <p class="text-base-content/60">Você ainda não está inscrito em nenhum evento.</p>
    </div>
@else
    <div class="page-card rounded-2xl overflow-hidden border border-base-content/10">
        <div class="overflow-x-auto">
            <table class="table">
                <thead>
                    <tr class="border-base-content/10 text-base-content/50 text-xs uppercase tracking-widest">
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Ingresso</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($registrations as $event)
                        <tr class="border-base-content/10 hover:bg-base-200/30">
                            <td>
                                <p class="font-semibold">{{ $event->title }}</p>
                                <p class="text-sm text-base-content/40">{{ $event->location }}</p>
                            </td>
                            <td class="text-base-content/70">{{ $event->date_time->format('d/m/Y H:i') }}</td>
                            <td>
                                <code class="px-3 py-1.5 rounded-lg bg-primary/15 text-primary font-mono text-sm tracking-wider">
                                    {{ $event->pivot->ticket_code }}
                                </code>
                            </td>
                            <td>
                                <form action="{{ route('registrations.destroy', $event) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-error btn-sm btn-outline" onclick="return confirm('Cancelar inscrição?')">
                                        Cancelar
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
