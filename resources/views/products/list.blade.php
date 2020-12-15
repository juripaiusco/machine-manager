@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">{{ __('navbar.products') }}</div>

            <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('products.cod') }}</th>
                        <th>{{ __('products.desc') }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($products as $product)

                        <tr>
                            <td>{{ $product->cod }}</td>
                            <td>{{ $product->desc }}</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

                {{ $products->links() }}

            </div>
        </div>

    </div>
@endsection
