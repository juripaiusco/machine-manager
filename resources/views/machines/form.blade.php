@extends('layouts.card')

@section('card-body')

    <style>
        .result-container {
            border: 1px solid #ddd;
            background-color: white;
            position: absolute;
            width: calc(100% - 30px);
            display: none;
            z-index: 1000;
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
                url: '{{ asset('machines') }}/search/?q=' + obj.value + '&cod=' + cod
            }).done(function (data) {

                var json = $.parseJSON(data);
                var ObjResult = $('#' + obj.id + 'Result');

                ObjResult.css('display', 'none');
                ObjResult.html('');

                if (obj.value != '') {

                    ObjResult.css('display', 'block');

                    $.each(json, function (i, item) {

                        var itemHTML = '<div class="result-item"' +
                            'data-cod="' + item.cod + '"' +
                            'data-desc="' + item.desc + '"' +
                            'data-sub_element="' + item.sub_element + '"' +
                        '>';
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

                var ObjItem = $(this).closest('.form-group');
                var ObjHiddenValue = ObjItem.find('.hiddenValue');
                var ObjViewValue = ObjItem.find('.form-control');
                var ObjResult = ObjItem.find('.result-container');

                ObjHiddenValue.val($(this).data('cod'));
                ObjViewValue.val($(this).data('desc'));
                ObjResult.css('display', 'none');

                /*if ( $(this).data('sub_element') != null ) {

                    ObjItem.after(ObjItem.clone());

                }*/

            });

        };

    </script>

    <form method="post"
          action="{{ isset($machine->id) ? route('machines.update', $machine->id) : route('machines.store') }}"
          autocomplete="off">

        @csrf

        <div class="card bg-light">
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-3">

                        <div class="form-group">

                            @php
                            $type_array = array(
	                            'Atomizzatori trainati',
                                'Atomizzatori portati',
                                'Polverizzatori semiportati',
                                'Polverizzatori portati',
                                'Gruppo portato'
	                        );
                            @endphp

                            <label for="type">Tipologia</label>
                            <select class="form-control" id="type" name="type">

                                <option value="">Seleziona Tipologia</option>

                                @foreach($type_array as $type)
                                    <option value="{{ $type }}"
                                    @if(isset($machine->type) && $machine->type == $type)
                                    selected
                                    @endif>{{ $type }}</option>
                                @endforeach

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
                                   value="{{ isset($machine->id) ? date('d/m/Y', strtotime($machine->date_machine)) : date('d/m/Y') }}">
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

                @php
                    $field_name = preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name)))
                @endphp

                <div class="col-lg-6">

                    @switch($field->type)

                        @case('check')

                        <div class="custom-control custom-switch">
                            <input type="checkbox"
                                   class="custom-control-input"
                                   id="{{ $field_name }}"
                                   name="json[{{ $field_name }}]"
                                   @if(isset($json[$field_name]) && $json[$field_name] == 'on')
                                   checked
                                    @endif>
                            <label class="custom-control-label"
                                   for="{{ $field_name }}">
                                {{ $field->name }}
                            </label>
                        </div>

                        @break

                        @default

                        <x-form-group-text
                            :fieldName="$field_name"
                            :field="$field"
                            :json="$json ?? ''" />

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
