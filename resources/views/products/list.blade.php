@extends('layouts.card')

@section('card-body')

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

@endsection
