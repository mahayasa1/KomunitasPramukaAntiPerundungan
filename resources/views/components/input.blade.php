@props(['type' => 'text', 'name', 'value' => '', 'placeholder' => ''])

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    placeholder="{{ $placeholder }}"
    {{ $attributes->merge(['class' => 'border-gray-300 rounded-md w-full p-2']) }}>
