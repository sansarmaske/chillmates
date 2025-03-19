@props(['type' => 'button', 'variant' => 'primary', 'size' => 'md', 'fullWidth' => false])

@php
    $classes = 'inline-flex items-center justify-center rounded-md font-medium focus:outline-none focus:ring-2 focus:ring-offset-2 transition duration-150 ease-in-out';
    
    // Variant styles
    $variantClasses = [
        'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white border border-transparent focus:ring-indigo-500',
        'secondary' => 'bg-white hover:bg-gray-50 text-gray-700 border border-gray-300 focus:ring-indigo-500',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white border border-transparent focus:ring-red-500',
        'success' => 'bg-green-600 hover:bg-green-700 text-white border border-transparent focus:ring-green-500',
    ];
    
    // Size styles
    $sizeClasses = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2 text-sm',
        'lg' => 'px-6 py-3 text-base',
    ];
    
    $fullWidthClass = $fullWidth ? 'w-full' : '';
    
    $buttonClasses = $classes . ' ' . $variantClasses[$variant] . ' ' . $sizeClasses[$size] . ' ' . $fullWidthClass;
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $buttonClasses]) }}>
    {{ $slot }}
</button> 