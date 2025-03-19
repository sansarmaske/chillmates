@props(['label', 'for', 'error' => null, 'helpText' => null])

<div class="space-y-2">
    <x-input-label :for="$for" :value="$label" class="text-sm font-medium text-gray-700" />
    <div>
        {{ $slot }}
    </div>
    
    @if($error)
        <x-input-error :messages="$error" class="mt-1" />
    @endif
    
    @if($helpText)
        <p class="mt-1 text-sm text-gray-500">{{ $helpText }}</p>
    @endif
</div> 