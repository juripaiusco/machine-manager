@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

                <div class="row">
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-header">Distinte Macchine</div>
                            <div class="card-body text-center">

                                <h2>{{ $machines_count }}</h2>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-header">Utenti registrati</div>
                            <div class="card-body text-center">

                                <h2>{{ $users_count }}</h2>

                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4">

                        <div class="card">
                            <div class="card-header">Prodotti a magazzino</div>
                            <div class="card-body text-center">

                                <h2>{{ $products_count }}</h2>

                            </div>
                        </div>

                    </div>
                </div>

        </div>
    </div>

</div>
@endsection
