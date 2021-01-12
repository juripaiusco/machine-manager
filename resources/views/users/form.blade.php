@extends('layouts.card')

@section('card-body')

    <form method="post" action="{{ route('users.update', $user->id) }}">

        @csrf

        <div class="form-group">
            <label for="name">Nome</label>
            <input type="name"
                   class="form-control"
                   id="name"
                   placeholder="Nome"
                   name="name"
                   value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email"
                   class="form-control"
                   id="email"
                   placeholder="Email"
                   name="email"
                   value="{{ $user->email }}">
        </div>

        <a class="btn btn-secondary" href="javascript: history.go(-1)">Annulla</a>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

@endsection
