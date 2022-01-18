@extends('layouts.card')

@section('card-body')

    <script language="JavaScript">

        window.onload = function() {

            $('body').on('click', '.conn-add', function () {

                var ObjConnData = $(this).closest('.conn-data');
                var ObjConnDataClone = ObjConnData.clone();

                ObjConnData.after(ObjConnDataClone);

                ctrlButtons();

                return false;

            });

            $('body').on('click', '.conn-del', function () {

                var Obj = $(this);
                var ObjConnData = Obj.closest('.conn-data');

                if (!Obj.hasClass('disabled')) {

                    ObjConnData.remove();

                    ctrlButtons();

                }

                return false;

            });

        };

        function ctrlButtons() {

            var ObjConnDelBtn = $('.conn-del');

            if (ObjConnDelBtn.length >= 2) {

                ObjConnDelBtn.removeClass('disabled');

            } else {

                ObjConnDelBtn.addClass('disabled');
            }

        }

    </script>

    <form method="post" action="{{ isset($product->id) ? route('products.update', $product->id) : route('products.store') }}">

        @csrf

        <div class="form-group">
            <label for="name">Codice</label>
            <input type="text"
                   class="form-control"
                   id="cod"
                   placeholder="Codice prodotto"
                   name="cod"
                   value="{{ isset($product->id) ? $product->cod : '' }}">
        </div>

        <div class="row">
            <div class="col-lg-9">

                <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="name"
                           class="form-control"
                           id="name"
                           placeholder="Nome"
                           name="name"
                           value="{{ isset($product->id) ? $product->name : '' }}">
                </div>

            </div>
            <div class="col-lg-3">

                <div class="form-group">
                    <label for="name">Prezzo</label>

                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">€</div>
                        </div>

                        <input type="text"
                               class="form-control text-right"
                               id="price"
                               placeholder="123,00"
                               name="price"
                               value="{{ isset($product->id) ? number_format($product->price, 2, ',', '') : '' }}">

                    </div>
                </div>

            </div>
        </div>

        <div class="form-group">
            <label for="email">Descrizione</label>

            <textarea name="desc"
                      id="desc"
                      class="form-control"
                      placeholder="Descrizione aggiuntiva del prodotto"
                      style="height: 120px;">{{ isset($product->id) ? $product->desc : '' }}</textarea>

        </div>

        <p>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseSubElement" aria-expanded="false" aria-controls="collapseSubElement">
                Connetti componente
            </button>
        </p>

        <div class="collapse @if(isset($product->id))
        @if(count($json->conn_element_name) >= 1) show @endif
        @endif" id="collapseSubElement">

            <div class="card text-white @if(isset($product->id))
                {{ count($json->conn_element_name) >= 1 ? 'bg-success' : 'bg-info' }}
            @else
                bg-info
            @endif">
                <div class="card-header">Dettagli di connessione</div>
                <div class="card-body">

                    @foreach($json->conn_element_name as $k => $conn_name)

                        <div class="row conn-data">
                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label for="name">Nome elemento</label>
                                    <input type="text"
                                           class="form-control"
                                           id="conn_element_name"
                                           placeholder="Nome del prodotto es.: Cuscinetti"
                                           name="json[conn_element_name][]"
                                           value="{{ $conn_name }}">
                                </div>

                            </div>
                            <div class="col-lg-5">

                                <div class="form-group">
                                    <label for="name">Codice di ricerca</label>
                                    <input type="text"
                                           class="form-control"
                                           id="conn_element_search_code"
                                           placeholder="Codice da filtrare per la ricerca es.: T0"
                                           name="json[conn_element_search_code][]"
                                           value="{{ $json->conn_element_search_code[$k] }}">
                                </div>

                            </div>
                            <div class="col-lg-2" style="padding-top: 30px;">

                                <div class="row nopadding">
                                    <div class="col nopadding">

                                        <button class="btn btn-primary btn-block conn-add">
                                            <i class="fas fa-plus"></i>
                                        </button>

                                    </div>
                                    <div class="col nopadding">

                                        <button class="btn
                                        btn-danger
                                        btn-block
                                        conn-del
                                        @if(count($json->conn_element_name) <= 1) disabled @endif">
                                            <i class="fas fa-times"></i>
                                        </button>

                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>
            </div>

        </div>

        <br>

        <a class="btn btn-secondary" href="javascript: history.go(-1)">Annulla</a>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

@endsection
