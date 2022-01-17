@extends('layouts.card')

@section('card-body')

    <form method="post" action="{{ isset($user->id) ? route('users.update', $user->id) : route('users.store') }}">

        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="name"
                   class="form-control"
                   id="name"
                   placeholder="Nome"
                   name="name"
                   value="{{ isset($user->id) ? $user->name : '' }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   placeholder="Email"
                   name="email"
                   value="{{ isset($user->id) ? $user->email : '' }}">
        </div>

        @if(!isset($user->id))
        <div class="form-group">
            <label for="email">Password</label>
            <input type="text"
                   class="form-control"
                   id="password"
                   placeholder="Password"
                   name="password"
                   value="{{ isset($user->id) ? $user->password : '' }}">
        </div>
        @endif

        <div class="form-group">

            <div class="custom-control custom-switch">
                <input name="settings_active"
                       id="settings_active"
                       type="checkbox"
                       class="custom-control-input"
                    {{ isset($user->settings_active) ? 'checked' : '' }}>
                <label class="custom-control-label" for="settings_active">Impostazioni visibili</label>
            </div>

        </div>

        <a class="btn btn-secondary" href="javascript: history.go(-1)">Annulla</a>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

@endsection
