@props(['disabled' => false, 'textarea' => false])

@php
    $class = 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1';
@endphp

@if($textarea)
    <textarea rows="5" @disabled($disabled) {{ $attributes->merge(['class' => $class]) }}>{{ $slot }}</textarea>
@else
    <input @disabled($disabled) {{ $attributes->merge(['class' => $class]) }}>
@endif
