@extends('layouts.card')

@section('card-body')

    <script language="JavaScript">

        window.onload = function() {

            $('#deleteModal').on('show.bs.modal', function(e) {
                $(this).find('#btn-del').attr('href', $(e.relatedTarget).data('href'));
            });

        };

    </script>

    <div class="row">
        <div class="col-lg-8">
            <a class="btn btn-primary" href="{{ route('products.create') }}">Nuovo prodotto</a>
        </div>
        <div class="col-lg-4">

            <div class="float-right">
                <form class="form-inline my-2 my-lg-0" action="{{ route('products') }}" method="get">

                    <input class="form-control mr-sm-2"
                           type="search"
                           placeholder="cerca prodotto"
                           aria-label="Search"
                           name="s"
                           value="{{ $s }}" />

                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Cerca</button>

                </form>
            </div>

        </div>
    </div>

    <br><br>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>{{ __('products.cod') }}</th>
            <th>{{ __('products.name') }}</th>
            <th width="160"></th>
        </tr>
        </thead>
        <tbody>

        @foreach($products as $product)

            <tr>
                <td>{{ $product->cod }}</td>
                <td>{{ $product->name }}</td>
                <td class="text-right">

                    <div class="row nopadding">
                        <div class="col nopadding">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-block btn-info">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>
                        <div class="col nopadding">

                            <button type="button"
                                    class="btn btn-block btn-danger"
                                    data-toggle="modal"
                                    data-target="#deleteModal"
                                    data-href="{{ route('products.destroy', $product->id) }}">
                                <i class="far fa-trash-alt"></i>
                            </button>

                        </div>
                    </div>

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

    {{ $products->links() }}

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
