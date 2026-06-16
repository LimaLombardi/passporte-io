@extends('layouts.app')

@section('title', 'Editar Evento — Passaporte.io')

@section('content')
<h1 class="text-3xl font-bold mb-8">Editar Evento</h1>

<form action="{{ route('organizer.events.update', $event) }}" method="POST" enctype="multipart/form-data" class="card bg-base-100 shadow-xl">
    @csrf
    @method('PUT')
    <div class="card-body space-y-4">
        @include('organizer.events._form', ['event' => $event])

        <div class="card-actions justify-end mt-4">
            <a href="{{ route('organizer.events.index') }}" class="btn btn-ghost">Cancelar</a>
            <button type="submit" class="btn btn-primary">Atualizar</button>
        </div>
    </div>
</form>
@endsection
