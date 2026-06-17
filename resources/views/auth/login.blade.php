@extends('layouts.app')

@section('title', 'Entrar — Passaporte.io')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center">
    <div class="auth-card rounded-2xl w-full max-w-md p-8">
        <div class="text-center mb-8">
            <p class="text-primary text-sm font-medium uppercase tracking-widest mb-2">Acesso</p>
            <h1 class="text-3xl font-bold tracking-tight">Entrar</h1>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div class="form-control">
                <label class="label py-1" for="email"><span class="label-text font-medium">E-mail</span></label>
                <input type="email" id="email" name="email" value="{{ old('email') }}"
                       class="input input-bordered bg-base-200/50 focus:input-primary" required autofocus>
            </div>

            <div class="form-control">
                <label class="label py-1" for="password"><span class="label-text font-medium">Senha</span></label>
                <input type="password" id="password" name="password"
                       class="input input-bordered bg-base-200/50 focus:input-primary" required>
            </div>

            <label class="flex items-center gap-2 cursor-pointer text-sm text-base-content/60">
                <input type="checkbox" name="remember" class="checkbox checkbox-primary checkbox-sm">
                Lembrar-me
            </label>

            <button type="submit" class="btn btn-primary w-full">Entrar</button>
        </form>

        <p class="text-center text-sm text-base-content/50 mt-6">
            Não tem conta?
            <a href="{{ route('register') }}" class="link link-primary font-medium">Cadastre-se</a>
        </p>
    </div>
</div>
@endsection
