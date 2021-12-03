@extends('layouts.card')

@section('card-body')

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

        <div class="form-group">
            <label for="name">Connetti sotto elemento</label>
            <input type="text"
                   class="form-control"
                   id="sub_element"
                   placeholder="Codice prodotto sotto elemento es.: T0"
                   name="sub_element"
                   value="{{ isset($product->id) ? $product->sub_element : '' }}">
        </div>

        <a class="btn btn-secondary" href="javascript: history.go(-1)">Annulla</a>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

@endsection
