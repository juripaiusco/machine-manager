@if(isset($classFormElementGroup) && $classFormElementGroup == true)
<div class="form-element @if(isset($json[$fieldName]['son']) && $classFormElementGroup == true) form-element-group @endif">
@endif

    <div class="form-group @if(isset($classFormElementGroup) && $classFormElementGroup == false) conn_element @endif">
        <label for="{{ $fieldName }}">
            {{ $field->name }}
        </label>
        <input type="text"
               class="form-control text-left"
               id="{{ $fieldName }}"
               autocomplete="off"

               @if(isset($field->search_cod) && $field->search_cod != 'null')

               placeholder="Ricerca prodotti {{ $field->search_cod }}*"
               onkeyup="showResult(this, '{{ $field->search_cod }}')"
               onfocus="showResult(this, '{{ $field->search_cod }}')"
               name="json[{{ $fieldName }}][label]"
               value="{{ isset($json[$fieldName]['label']) ? $json[$fieldName]['label'] : '' }}"

               @else

               name="json[{{ $fieldName }}]"
               value="{{ isset($json[$fieldName]) ? $json[$fieldName] : '' }}"

            @endif
        >

        @if(isset($field->search_cod) && $field->search_cod != 'null')

            <input type="hidden"
                   class="hiddenValueCod"
                   name="json[{{ $fieldName }}][cod]"
                   value="{{ isset($json[$fieldName]['cod']) ? $json[$fieldName]['cod'] : '' }}">

            <input type="hidden"
                   class="hiddenValueSon"
                   name="json[{{ $fieldName }}][son]"
                   value="{{ isset($json[$fieldName]['son']) ? $json[$fieldName]['son'] : '' }}">

            <input type="hidden"
                   class="hiddenValueName"
                   name="json[{{ $fieldName }}][name]"
                   value="{{ isset($json[$fieldName]['name']) ? $json[$fieldName]['name'] : '' }}">

            <input type="hidden"
                   class="hiddenValueSearchCod"
                   name="json[{{ $fieldName }}][search_cod]"
                   value="{{ isset($json[$fieldName]['search_cod']) ? $json[$fieldName]['search_cod'] : '' }}">

            <div class="result-container"
                 id="{{ $fieldName }}Result"></div>

        @endif

    </div>

    @if(isset($json[$fieldName]['son']))

        @php
            $field = (object) array(
                'name' => $json[$json[$fieldName]['son']]['name'],
                'search_cod' => $json[$json[$fieldName]['son']]['search_cod'],
                'type' => 'text',
            );
        @endphp

        <x-form-group-text
            :fieldName="$json[$fieldName]['son']"
            :field="$field"
            :json="$json ?? ''"
            :classFormElementGroup="false" />

    @endif

@if(isset($classFormElementGroup) && $classFormElementGroup == true)
</div>
@endif
