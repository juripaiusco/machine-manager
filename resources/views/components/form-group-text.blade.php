<div>

    <div class="form-group">
        <label for="{{ $field_name }}">
            {{ $field->name }}
        </label>
        <input type="text"
               class="form-control text-left"
               id="{{ $field_name }}"
               autocomplete="off"

               @if($field->search_cod != 'null')

               placeholder="Ricerca prodotti {{ $field->search_cod }}*"
               onkeyup="showResult(this, '{{ $field->search_cod }}')"
               name="json[{{ $field_name }}][label]"
               value="{{ isset($json[$field_name]['label']) ? $json[$field_name]['label'] : '' }}"

               @else

               name="json[{{ $field_name }}]"
               value="{{ isset($json[$field_name]) ? $json[$field_name] : '' }}"

            @endif
        >

        @if($field->search_cod != 'null')

            <input type="hidden"
                   class="hiddenValue"
                   name="json[{{ $field_name }}][cod]"
                   value="{{ isset($json[$field_name]['cod']) ? $json[$field_name]['cod'] : '' }}">

            <div class="result-container"
                 id="{{ $field_name }}Result"></div>

        @endif

    </div>

    @if(isset($field->sub_element))

        <x-form-group-text
            :fieldName="$field->sub_element->name"
            :field="$field->sub_element"
            :json="$json ?? ''" />

    @endif

</div>
