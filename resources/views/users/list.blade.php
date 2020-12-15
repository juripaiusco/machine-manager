@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="card">
            <div class="card-header">{{ __('navbar.users') }}</div>

            <div class="card-body">

                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>{{ __('users.name') }}</th>
                        <th>{{ __('users.email') }}</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="text-right">

                                <a href="#" class="btn btn-danger">Del</a>

                            </td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>

{{--                {{ $products->links() }}--}}

            </div>
        </div>

    </div>
@endsection
