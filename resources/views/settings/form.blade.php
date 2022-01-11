@extends('layouts.card')

@section('card-body')

    <form method="post"
          action="{{ route('settings.store') }}">

        @csrf

        <nav>
            <div class="nav nav-pills" id="nav-tab" role="tablist">

                @foreach($json_file_content as $file => $content)

                    <a class="nav-link @if(!isset($active)) active @endif"
                       id="nav-{{ current(explode('.', $file)) }}-tab"
                       aria-controls="nav-{{ current(explode('.', $file)) }}"
                       href="#nav-{{ current(explode('.', $file)) }}"
                       data-toggle="tab"
                       role="tab"
                       aria-selected="true">
                        {{ ucfirst(current(explode('.', $file))) }}
                    </a>

                    @php
                        $active = 1;
                    @endphp

                @endforeach

            </div>
        </nav>

        @php
            unset($active);
        @endphp

        <div class="tab-content" id="nav-tabContent">

            @foreach($json_file_content as $file => $content)

                <div class="tab-pane fade @if(!isset($active)) show active @endif"
                     id="nav-{{ current(explode('.', $file)) }}"
                     aria-labelledby="nav-{{ current(explode('.', $file)) }}-tab"
                     role="tabpanel">

                    <br>

                    <div class="form-group">

                        <textarea name="json_file_content[{{$file}}]"
                                  class="form-control"
                                  style="height: 400px;">{{ $content }}</textarea>

                    </div>

                </div>

                @php
                    $active = 1;
                @endphp

            @endforeach

        </div>

        <br>

        <button type="submit"
                class="btn btn-primary">Salva</button>

    </form>

@endsection
