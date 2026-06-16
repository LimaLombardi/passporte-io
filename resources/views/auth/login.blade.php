@extends('layouts.app')

@section('title', 'Entrar — Passaporte.io')

@section('content')
<div class="max-w-md mx-auto">
    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h1 class="card-title text-2xl justify-center mb-4">Entrar</h1>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div class="form-control">
                    <label class="label" for="email"><span class="label-text">E-mail</span></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="input input-bordered" required autofocus>
                </div>

                <div class="form-control">
                    <label class="label" for="password"><span class="label-text">Senha</span></label>
                    <input type="password" id="password" name="password" class="input input-bordered" required>
                </div>

                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-2">
                        <input type="checkbox" name="remember" class="checkbox checkbox-sm">
                        <span class="label-text">Lembrar-me</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary w-full">Entrar</button>
            </form>

            <p class="text-center text-sm mt-4">
                Não tem conta?
                <a href="{{ route('register') }}" class="link link-primary">Cadastre-se</a>
            </p>
        </div>
    </div>
</div>
@endsection
