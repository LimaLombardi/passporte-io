@extends('layouts.app')

@section('title', 'Cadastrar — Passaporte.io')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center py-8">
    <div class="auth-card rounded-2xl w-full max-w-md p-8">
        <div class="text-center mb-8">
            <p class="text-primary text-sm font-medium uppercase tracking-widest mb-2">Novo usuário</p>
            <h1 class="text-3xl font-bold tracking-tight">Criar conta</h1>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <div class="form-control">
                <label class="label py-1" for="name"><span class="label-text font-medium">Nome</span></label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="input input-bordered bg-base-200/50 focus:input-primary" required autofocus>
            </div>

            <div class="form-control">
                <label class="label py-1" for="email"><span class="label-text font-medium">E-mail</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="input input-bordered bg-base-200/50 focus:input-primary" required>
            </div>

            <div class="form-control">
                <label class="label py-1" for="password"><span class="label-text font-medium">Senha</span></label>
                <input type="password" id="password" name="password"
                       class="input input-bordered bg-base-200/50 focus:input-primary" required>
            </div>

            <div class="form-control">
                <label class="label py-1" for="password_confirmation"><span class="label-text font-medium">Confirmar senha</span></label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="input input-bordered bg-base-200/50 focus:input-primary" required>
            </div>

            <div class="form-control">
                <label class="label py-1" for="role"><span class="label-text font-medium">Tipo de conta</span></label>
                <select id="role" name="role" class="select select-bordered bg-base-200/50 focus:select-primary w-full" required>
                    <option value="participant" @selected(old('role') === 'participant')>Participante</option>
                    <option value="organizer" @selected(old('role') === 'organizer')>Organizador</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-full mt-2">Cadastrar</button>
        </form>

        <p class="text-center text-sm text-base-content/50 mt-6">
            Já tem conta?
            <a href="{{ route('login') }}" class="link link-primary font-medium">Entrar</a>
        </p>
    </div>
</div>
@endsection
