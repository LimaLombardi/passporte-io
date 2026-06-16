@extends('layouts.app')

@section('title', 'Cadastrar — Passaporte.io')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl justify-center mb-4">Criar conta</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <div class="form-control">
                    <label class="label" for="name"><span class="label-text">Nome</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="input input-bordered" required autofocus>
                </div>

                <div class="form-control">
                    <label class="label" for="email"><span class="label-text">E-mail</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label" for="password"><span class="label-text">Senha</span></label>
                    <input type="password" id="password" name="password" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label" for="password_confirmation"><span class="label-text">Confirmar senha</span></label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label" for="role"><span class="label-text">Tipo de conta</span></label>
                    <select id="role" name="role" class="select select-bordered" required>
                        <option value="participant" @selected(old('role') === 'participant')>Participante</option>
                        <option value="organizer" @selected(old('role') === 'organizer')>Organizador</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-full">Cadastrar</button>
            </form>

            <p class="text-center text-sm mt-4">
                Já tem conta?
                <a href="{{ route('login') }}" class="link link-primary">Entrar</a>
            </p>
        </div>
    </div>
</div>
@endsection
