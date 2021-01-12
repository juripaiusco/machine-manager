@extends('layouts.card')

@section('card-body')

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{ __('users.name') }}</th>
            <th>{{ __('users.email') }}</th>
            <th width="160"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($users as $user)

            <tr>
                <td class="align-middle">{{ $user->name }}</td>
                <td class="align-middle">{{ $user->email }}</td>
                <td class="text-right">

                    <div class="row nopadding">
                        <div class="col nopadding">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-block btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="col nopadding">
                            <a href="#" class="btn btn-block btn-danger">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </div>
                    </div>

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

@endsection
