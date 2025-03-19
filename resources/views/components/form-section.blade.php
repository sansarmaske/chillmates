@props(['title' => null])

<div {{ $attributes->merge(['class' => 'space-y-4']) }}>
    @if ($title)
        <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>
    @endif
    <div class="space-y-6">
        {{ $slot }}
    </div>
</div> 