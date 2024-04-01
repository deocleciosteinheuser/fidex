<div>
    <style>
        .bootstrap-select .bs-ok-default::after {
            width: 0.3em;
            height: 0.6em;
            border-width: 0 0.1em 0.1em 0;
            transform: rotate(45deg) translateY(0.5rem);
        }

        .btn.dropdown-toggle:focus {
            outline: none !important;
        }
    </style>
    <label for="{{ $id }}">{{ $label }}</label>
    <select
        wire:model="{{ isset($wireModel) ? $wireModel : '' }}"
        name="{{ $name }}[]" id="{{ $id }}"
        {{$multiple ? 'multiple' : ''}}
        class="selectpicker show-tick"
        data-live-search="true"
        data-actions-box="true"
        x-show="$('#{{ $id }}').selectpicker();"
    >
        @foreach($options as $value => $label)
        <option value="{{ $value }}" {{ isset($selectedValues) && in_array($value, $selectedValues) ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>

</div>
