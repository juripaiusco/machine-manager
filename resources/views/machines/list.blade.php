@extends('layouts.card')

@section('card-body')

    <script language="JavaScript">

        function tipologiaOnChange() {

            $('#machinesFormSearch').submit();

        }

        window.onload = function() {

            $('#deleteModal').on('show.bs.modal', function(e) {
                $(this).find('#btn-del').attr('href', $(e.relatedTarget).data('href'));
            });

        };

    </script>

    <div class="row">
        <div class="col-lg-6">
            <a class="btn btn-primary" href="{{ route('machines.create') }}">Nuova distinta</a>
        </div>
        <div class="col-lg-6">

            <div class="float-right">
                <form id="machinesFormSearch"
                      class="form-inline my-2 my-lg-0"
                      action="{{ route('machines') }}"
                      method="get">

                    <div class="form-group" style="margin-right: 8px;">

                        <select class="form-control"
                                id="type"
                                name="type"
                                onchange="tipologiaOnChange()">

                            <option value="">Filtra Tipologia</option>

                            @foreach($type_array as $type_name)
                                <option value="{{ $type_name }}"
                                @if(isset($type) && $type == $type_name)
                                selected
                                @endif>{{ $type_name }}</option>
                            @endforeach

                        </select>

                    </div>

                    <div class="form-group">
                        <input class="form-control mr-sm-2"
                               type="search"
                               placeholder="cerca macchina"
                               aria-label="Search"
                               name="s"
                               value="{{ $s ?? '' }}" />
                    </div>

                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerca</button>

                </form>
            </div>

        </div>
    </div>

    <br><br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{ __('machines.number') }}</th>
            <th>{{ __('machines.type') }}</th>
            <th>{{ __('machines.name') }}</th>
            <th>{{ __('machines.customer') }}</th>
            <th>{{ __('machines.date') }}</th>
            <th width="160"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($machines as $machine)

            <tr>
                <td class="align-middle">{{ $machine->number }}</td>
                <td class="align-middle">{{ $machine->type }}</td>
                <td class="align-middle">{{ $machine->name }}</td>
                <td class="align-middle">{{ $machine->customer }}</td>
                <td class="align-middle">{{ date('d/m/Y', strtotime($machine->date_machine)) }}</td>
                <td class="text-right">

                    <div class="row nopadding">
                        <div class="col nopadding">
                            <a href="{{ route('machines.edit', $machine->id) }}" class="btn btn-block btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="col nopadding">

                            <button type="button"
                                    class="btn btn-block btn-danger"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    data-href="{{ route('machines.destroy', $machine->id) }}">
                                <i class="far fa-trash-alt"></i>
                            </button>

                        </div>
                    </div>

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Elimina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Confermi l'eminazione?

                    <br /><br />

                    <div class="row">
                        <div class="col-lg-6">

                            <a href="#" id="btn-del" class="btn btn-danger btn-block">Sì</a>

                        </div>
                        <div class="col-lg-6">

                            <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">No</button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
