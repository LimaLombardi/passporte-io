@extends('layouts.app')

@section('title', 'Criar Evento — Passaporte.io')

@section('content')
<div class="mb-8">
    <p class="text-primary text-sm font-medium uppercase tracking-widest mb-2">Organizador</p>
    <h1 class="text-4xl font-bold tracking-tight">Criar evento</h1>
</div>

<form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data"
      class="page-card rounded-2xl border border-base-content/10 p-6 lg:p-8 max-w-3xl">
    @csrf
    <div class="space-y-5">
        @include('organizer.events._form')

        <div class="flex justify-end gap-2 pt-4 border-t border-base-content/10">
            <a href="{{ route('organizer.events.index') }}" class="btn btn-ghost">Cancelar</a>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
@endsection
