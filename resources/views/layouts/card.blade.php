@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">{{ __('navbar.' . Request::segment(1)) }}</div>

            <div class="card-body">

                @yield('card-body')

            </div>
        </div>

    </div>
@endsection
