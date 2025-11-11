@props(['name', 'rows' => 3, 'value' => '', 'placeholder' => ''])

<textarea
    name="{{ $name }}"
    rows="{{ $rows }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'border-gray-300 rounded-md w-full p-2']) }}
>{{ old($name, $value) }}</textarea>
