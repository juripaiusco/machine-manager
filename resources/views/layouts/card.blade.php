@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">{{ __('navbar.users') }}</div>

            <div class="card-body">

                @yield('card-body')

            </div>
        </div>

    </div>
@endsection
