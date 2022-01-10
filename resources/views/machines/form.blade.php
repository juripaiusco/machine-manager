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
        .form-element-group {
            background-color: #eee;
            padding: 15px 15px 5px 15px;
            border-radius: 6px;
        }
    </style>

    <script language="JavaScript">

        function showResult(obj, cod) {

            $.ajax({
                url: '{{ asset('machines') }}/search/?q=' + obj.value + '&cod=' + cod
            }).done(function (data) {

                var json = $.parseJSON(data);
                var ObjResult = $('#' + obj.id + 'Result');
                var ObjFormGroup = $('#' + obj.id).closest('.form-group');

                ObjResult.css('display', 'none');
                ObjResult.html('');

                if (obj.value != '') {

                    $('.result-container').css('display', 'none');
                    ObjResult.css('display', 'block');

                    $.each(json, function (i, item) {

                        var itemHTML = '<div class="result-item"' +
                            'data-cod="' + item.cod + '"' +
                            'data-desc="' + item.desc + '"' +
                            'data-conn_element_name="' + item.conn_element_name + '"' +
                            'data-conn_element_search_code="' + item.conn_element_search_code + '"' +
                        '>';
                        itemHTML += '<span class="cod">' + item.cod + '</span><br>';
                        itemHTML += item.desc;
                        itemHTML += '</div>';

                        ObjResult.append(itemHTML);

                        $('.result-container').on('click', '.result-item', function () {

                            if( ObjFormGroup.hasClass('conn_element') == false ) {

                                ObjFormGroup.closest('.form-element')
                                    .find('.conn_element')
                                    .remove();

                            }

                            clickResultItem($(this));

                        });

                    });

                }

            });

        }

        function clickResultItem(Obj) {

            var ObjItem = Obj.closest('.form-group');
            var ObjHiddenValue = ObjItem.find('.hiddenValue');
            var ObjViewValue = ObjItem.find('.form-control');
            var ObjResult = ObjItem.find('.result-container');

            var Data_connElementName = Obj.data('conn_element_name');
            var Data_connElementSearchCode = Obj.data('conn_element_search_code');

            ObjHiddenValue.val(Obj.data('cod'));
            ObjViewValue.val(Obj.data('desc'));
            ObjResult.css('display', 'none');

            if ( Data_connElementSearchCode != null ) {

                var ObjClone = ObjItem.clone();
                var field_name = Data_connElementName.replace(/[^a-zA-Z0-9_]+/g, '').toLowerCase();

                if ( $('#' + field_name).length == 0 ) {

                    ObjClone.addClass('conn_element');

                    ObjClone.find('label')
                        .attr('for', field_name)
                        .html(Data_connElementName);

                    ObjClone.find('input[type="text"]')
                        .attr('id', field_name)
                        .attr('placeholder', 'Ricerca prodotti ' + Data_connElementSearchCode + '*')
                        .attr('name', 'json[' + field_name + '][label]')
                        .attr('onkeyup', 'showResult(this, "' + Data_connElementSearchCode + '")')
                        .val('');

                    ObjClone.find('input[type="hidden"]')
                        .attr('name', 'json[' + field_name + '][cod]')
                        .val('');

                    ObjClone.find('.result-container')
                        .attr('id', field_name + 'Result')
                        .html('');

                    ObjItem.after(ObjClone);

                    ObjClone.find('input[type="text"]').focus();

                    ObjItem.closest('.form-element')
                        .addClass('form-element-group');

                }

            }

        }

        function tipologiaOnChange() {

            $('#dynamicField')
                .load('{{ asset('machines') }}/dynamic-field/' + $('#type').find('option:selected').val().toLowerCase());

        }

        @if(!isset($machine->id))

        window.addEventListener('load', function () {

            $('#sceltaTipologia').modal('show');

            $('body').on('click', '.btn-tipologia', function () {

                $('#type').val($(this).data('value')).change();
                $('#year').focus();

            });

        });

        @endif

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
                                'Atomizzatore',
                                'Polverizzatore'
	                            /*'Atomizzatori trainati',
                                'Atomizzatori portati',
                                'Polverizzatori semiportati',
                                'Polverizzatori portati',
                                'Gruppo portato'*/
	                        );
                            @endphp

                            <label for="type">Tipologia</label>
                            <select class="form-control"
                                    id="type"
                                    name="type"
                                    onchange="tipologiaOnChange()">

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

        <div id="dynamicField"></div>

        <br>

        <a class="btn btn-secondary" href="javascript: history.go(-1)">Annulla</a>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

    <!-- Modal -->
    <div class="modal fade" id="sceltaTipologia" tabindex="-1" aria-labelledby="sceltaTipologiaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sceltaTipologiaLabel">Tipologia Macchina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-6">

                            <button class="btn-tipologia btn btn-block btn-primary"
                                    data-dismiss="modal"
                                    data-value="Atomizzatore">

                                <br>

                                Atomizzatore

                                <br><br>

                            </button>

                        </div>
                        <div class="col-lg-6">

                            <button class="btn-tipologia btn btn-block btn-success"
                                    data-dismiss="modal"
                                    data-value="Polverizzatore">

                                <br>

                                Polverizzatore

                                <br><br>

                            </button>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
