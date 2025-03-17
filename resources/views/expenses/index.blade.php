<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    @if (Session::has('message'))
        <div class="p-4 mb-4 text-sm {{ Session::get('alert-class', 'text-blue-700 bg-blue-100') }} rounded-lg"
            role="alert">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end">
                        <a href="{{ route('expenses.create', ['group_id' => $group->id]) }}"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition">Add
                            Expense</a>
                    </div>

                    <div class="mt-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/2">
                                           Expense</th>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                                            Amount</th>
                                        <th scope="col"
                                            class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/4">
                                            Paid By</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 text-sm">
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td class="px-3 py-2 whitespace-normal">
                                                <div class="flex items-center">
                                                    <span class="text-xs text-gray-500 mr-2">{{ $expense->expense_date->format('j M Y') }}</span>
                                                    <span class="inline-flex items-center rounded bg-gray-100 px-1.5 py-0.5 text-xs font-medium text-gray-800">
                                                        {{ $expense->category->name }}
                                                    </span>
                                                </div>
                                                <p class="text-sm font-semibold text-gray-900 truncate max-w-xs">{{ $expense->title }}</p>
                                                <p class="text-xs text-gray-500 truncate max-w-xs">{{ $expense->description }}</p>
                                            </td>
                                            <td class="px-3 py-2 whitespace-nowrap">
                                                <div class="">
                                                    <span class="text-base font-medium text-red-600">${{ number_format($expense->amount, 2) }}</span>

                                                </div>
                                            </td>
                                            <td class="px-3 py-2 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-700 font-semibold uppercase mr-2">
                                                        {{ substr($expense->user->name, 0, 1) }}
                                                    </div>
                                                    <span class="text-sm text-gray-700">{{ $expense->user->name }}</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{$expenses->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
