@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="my-4">
        <!-- Mobile Pagination -->
        <div class="flex justify-center gap-4 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="px-3 py-1 text-gray-400">&larr;</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-gray-600 hover:text-gray-900 transition-colors dark:text-gray-400 dark:hover:text-gray-200">&larr;</a>
            @endif

            <span class="text-sm text-gray-700 dark:text-gray-300">
                {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
            </span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-gray-600 hover:text-gray-900 transition-colors dark:text-gray-400 dark:hover:text-gray-200">&rarr;</a>
            @else
                <span class="px-3 py-1 text-gray-400">&rarr;</span>
            @endif
        </div>

        <!-- Desktop Pagination -->
        <div class="hidden sm:flex sm:items-center sm:justify-center">
            <div class="flex items-center gap-2">
                <!-- Previous -->
                @if ($paginator->onFirstPage())
                    <span class="px-3 py-1 text-gray-400">&larr;</span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-1 text-gray-600 hover:text-gray-900 transition-colors dark:text-gray-400 dark:hover:text-gray-200">&larr;</a>
                @endif

                <!-- Pages -->
                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span class="px-3 py-1 text-gray-400">...</span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="px-3 py-1 text-blue-600 font-medium dark:text-blue-400">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 text-gray-600 hover:text-gray-900 transition-colors dark:text-gray-400 dark:hover:text-gray-200">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                <!-- Next -->
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-1 text-gray-600 hover:text-gray-900 transition-colors dark:text-gray-400 dark:hover:text-gray-200">&rarr;</a>
                @else
                    <span class="px-3 py-1 text-gray-400">&rarr;</span>
                @endif
            </div>
        </div>
    </nav>
@endif
