@foreach($fields_obj as $section)

    <div class="card">
        <div class="card-header">
            <strong>{{ $section->title }}</strong>
        </div>
        <div class="card-body">

            <div class="row">

                @foreach($section->fields as $field)

                    @php
                        $field_name = preg_replace("/[^a-zA-Z0-9_]+/", "", strtolower(str_replace(' ', '_', $field->name)))
                    @endphp

                    @if($field->type == 'textarea')

                        <div class="col-lg-12">

                            <div class="form-group">
                                <label for="{{ $field_name }}">{{ $field->name }}</label>
                                <textarea class="form-control"
                                          id="{{ $field_name }}"
                                          name="json[{{ $field_name }}]"
                                          rows="6">@if(isset($json[$field_name])){{ $json[$field_name] }}@endif</textarea>
                            </div>

                        </div>

                    @else

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

                    @endif

                @endforeach

            </div>

        </div>
    </div>

    <br>

@endforeach
