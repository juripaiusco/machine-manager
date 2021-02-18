@extends('layouts.card')

@section('card-body')

    <style>
        .result-container {
            border: 1px solid #ddd;
            background-color: white;
            position: absolute;
            width: calc(100% - 30px);
        }
        .result-item {
            padding: 5px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }
        .result-item .cod {
            font-size: 10px;
        }
        .result-item:hover {
            background-color: #eee;
        }
    </style>

    <script language="JavaScript">

        function showResult(obj, cod) {

            $.ajax({
                url: './search/?q=' + obj.value + '&cod=' + cod
            }).done(function (data) {

                var json = $.parseJSON(data);
                var ObjResult = $('#' + obj.id + 'Result');

                ObjResult.html('');

                if (obj.value != '') {

                    $.each(json, function (i, item) {

                        var itemHTML = '<div class="result-item" data-cod="' + item.cod + '">';
                        itemHTML += '<span class="cod">' + item.cod + '</span><br>';
                        itemHTML += item.desc;
                        itemHTML += '</div>';

                        ObjResult.append(itemHTML);

                    });

                }

            });

        }

        window.onload = function() {

            $('.result-container').on('click', '.result-item', function () {

                alert($(this).data('cod'));

            });

        };

    </script>

    <form method="post" action="{{ isset($machine->id) ? route('machines.update', $machine->id) : route('machines.store') }}">

        @csrf

        <div class="card bg-light">
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-3">

                        <div class="form-group">

                            <label for="type">Tipologia</label>
                            <select class="form-control" id="type">
                                <option value="">Seleziona Tipologia</option>
                                <option value="Atomizzatori trainati">Atomizzatori trainati</option>
                                <option value="Atomizzatori portati">Atomizzatori portati</option>
                                <option value="Polverizzatori semiportati">Polverizzatori semiportati</option>
                                <option value="Polverizzatori portati">Polverizzatori portati</option>
                                <option value="Gruppo portato">Gruppo portato</option>

                            </select>

                        </div>

                    </div>
                    <div class="col-lg-3">

                        <div class="form-group">
                            <label for="year">Anno</label>
                            <input type="text"
                                   class="form-control"
                                   id="year"
                                   placeholder="Anno YYYY"
                                   name="year"
                                   value="{{ isset($machine->id) ? $machine->year : '' }}">
                        </div>

                    </div>
                    <div class="col-lg-3">

                        <div class="form-group">
                            <label for="author">Compilatore</label>
                            <input type="text"
                                   class="form-control"
                                   id="author"
                                   placeholder="Il tuo nome"
                                   name="author"
                                   value="{{ isset($machine->id) ? $machine->author : '' }}">
                        </div>

                    </div>
                    <div class="col-lg-3">

                        <div class="form-group">
                            <label for="date_machine">Data</label>
                            <input type="text"
                                   class="form-control text-center"
                                   id="date_machine"
                                   placeholder="Data"
                                   name="date_machine"
                                   value="{{ isset($machine->id) ? $machine->date_machine : date('d/m/Y') }}">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">

                        <div class="form-group">
                            <label for="customer">Cliente</label>
                            <input type="text"
                                   class="form-control"
                                   id="customer"
                                   placeholder="Nome / Ragione sociale del cliente"
                                   name="customer"
                                   value="{{ isset($machine->id) ? $machine->customer : '' }}">
                        </div>

                    </div>
                    <div class="col-lg-3">

                        <div class="form-group">
                            <label for="n_confirm">Conferma Nr.</label>
                            <input type="text"
                                   class="form-control text-center"
                                   id="n_confirm"
                                   placeholder="n. conferma"
                                   name="n_confirm"
                                   value="{{ isset($machine->id) ? $machine->n_confirm : '' }}">
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9">

                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   placeholder="Nome"
                                   name="name"
                                   value="{{ isset($machine->id) ? $machine->name : '' }}">
                        </div>

                    </div>
                    <div class="col-lg-3">

                        <div class="form-group">
                            <label for="quantity">Q.tà</label>
                            <input type="text"
                                   class="form-control text-center"
                                   id="quantity"
                                   placeholder="Quantità"
                                   name="quantity"
                                   value="{{ isset($machine->id) ? $machine->quantity : '' }}">
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <br>

        <div class="row">

            @foreach($fields_obj as $field)

                <div class="col-lg-3">

                    @switch($field->type)

                        @case('check')

                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="{{ preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name))) }}">
                            <label class="custom-control-label"
                                   for="{{ preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name))) }}">
                                {{ $field->name }}
                            </label>
                        </div>

                        @break

                        @default

                        <div class="form-group">
                            <label for="{{ preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name))) }}">
                                {{ $field->name }}
                            </label>
                            <input type="text"
                                   class="form-control text-center"
                                   id="{{ preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name))) }}"

                                   @if($field->search_cod != 'null')
                                   placeholder="Ricerca prodotti {{ $field->search_cod }}*"
                                   onkeyup="showResult(this, '{{ $field->search_cod }}')"
                                   @endif

                                   name="{{ preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name))) }}"
                                   value="{{ isset($machine->id) ? $machine->quantity : '' }}">

                            @if($field->search_cod != 'null')

                                <input type="hidden">
                            
                                <div class="result-container"
                                     id="{{ preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name))) }}Result"></div>

                            @endif

                        </div>

                    @endswitch

                </div>

            @endforeach

        </div>

        <br>

        <a class="btn btn-secondary" href="javascript: history.go(-1)">Annulla</a>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

@endsection
