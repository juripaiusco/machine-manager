@if($classFormElementGroup == true)
<div class="form-element @if(isset($json[$field_name]['son']) && $classFormElementGroup == true) form-element-group @endif">
@endif

    <div class="form-group @if($classFormElementGroup == false) conn_element @endif">
        <label for="{{ $field_name }}">
            {{ $field->name }}
        </label>
        <input type="text"
               class="form-control text-left"
               id="{{ $field_name }}"
               autocomplete="off"

               @if(isset($field->search_cod) && $field->search_cod != 'null')

               placeholder="Ricerca prodotti {{ $field->search_cod }}*"
               onkeyup="showResult(this, '{{ $field->search_cod }}')"
               name="json[{{ $field_name }}][label]"
               value="{{ isset($json[$field_name]['label']) ? $json[$field_name]['label'] : '' }}"

               @else

               name="json[{{ $field_name }}]"
               value="{{ isset($json[$field_name]) ? $json[$field_name] : '' }}"

            @endif
        >

        @if(isset($field->search_cod) && $field->search_cod != 'null')

            <input type="hidden"
                   class="hiddenValueCod"
                   name="json[{{ $field_name }}][cod]"
                   value="{{ isset($json[$field_name]['cod']) ? $json[$field_name]['cod'] : '' }}">

            <input type="hidden"
                   class="hiddenValueSon"
                   name="json[{{ $field_name }}][son]"
                   value="{{ isset($json[$field_name]['son']) ? $json[$field_name]['son'] : '' }}">

            <input type="hidden"
                   class="hiddenValueName"
                   name="json[{{ $field_name }}][name]"
                   value="{{ isset($json[$field_name]['name']) ? $json[$field_name]['name'] : '' }}">

            <input type="hidden"
                   class="hiddenValueSearchCod"
                   name="json[{{ $field_name }}][search_cod]"
                   value="{{ isset($json[$field_name]['search_cod']) ? $json[$field_name]['search_cod'] : '' }}">

            <div class="result-container"
                 id="{{ $field_name }}Result"></div>

        @endif

    </div>

    @if(isset($json[$field_name]['son']))

        @php
            $field = (object) array(
                'name' => $json[$json[$field_name]['son']]['name'],
                'search_cod' => $json[$json[$field_name]['son']]['search_cod'],
                'type' => 'text',
            );
        @endphp

        <x-form-group-text
            :fieldName="$json[$field_name]['son']"
            :field="$field"
            :json="$json ?? ''"
            :classFormElementGroup="false" />

    @endif

@if($classFormElementGroup == true)
</div>
@endif
