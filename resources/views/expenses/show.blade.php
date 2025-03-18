<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expense Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-8">
                        <a href="{{ route('expenses', ['group_id' => $expense->group_id]) }}" class="inline-flex items-center text-gray-600 hover:text-gray-800 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                        </a>
                        <div class="flex space-x-4">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="text-blue-600 hover:text-blue-800 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="mb-8">
                        <div class="grid grid-cols-1 gap-8">
                            <div class="border-b border-gray-100 pb-8">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-900">{{ $expense->title }}</h3>
                                        <div class="flex items-center mt-2 space-x-3 text-sm text-gray-500">
                                            <span>{{ $expense->expense_date->format('F j, Y') }}</span>
                                            <span>&bull;</span>
                                            <span class="inline-flex items-center rounded-full bg-red-50 px-2.5 py-0.5 text-red-700">
                                                {{ $expense->category->name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-3xl font-bold text-red-600">${{ number_format($expense->amount, 2) }}</p>
                                        <p class="text-sm text-gray-500 mt-1">Paid by {{ $expense->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="px-1">
                                <p class="text-base text-gray-700 whitespace-pre-wrap">{{ $expense->description ?? 'No description provided' }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 