<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Expense Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-6">
                        <a href="{{ route('expenses', ['group_id' => $expense->group_id]) }}" class="inline-flex items-center text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Back to List
                        </a>
                        <div class="flex space-x-2">
                            <a href="{{ route('expenses.edit', $expense->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 disabled:opacity-25 transition">
                                Edit
                            </a>
                            <form action="{{ route('expenses.destroy', $expense->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-6">{{ $expense->title }}</h3>
                                
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm text-gray-500">Date</p>
                                        <p class="text-base">{{ $expense->expense_date->format('F j, Y') }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Category</p>
                                        <span class="inline-flex items-center rounded bg-red-600 px-2 py-1 text-xs font-medium text-white">
                                            {{ $expense->category->name }}
                                        </span>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Amount</p>
                                        <p class="text-xl font-bold text-red-600">${{ number_format($expense->amount, 2) }}</p>
                                    </div>
                                    
                                    <div>
                                        <p class="text-sm text-gray-500">Paid By</p>
                                        <p class="text-base">{{ $expense->user->name }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div>
                                <div class="bg-white p-4 rounded-lg border border-gray-200 h-full">
                                    <p class="text-sm text-gray-500 mb-2">Description</p>
                                    <p class="text-base whitespace-pre-wrap">{{ $expense->description ?? 'No description provided' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 