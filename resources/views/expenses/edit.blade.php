<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h2 class="font-bold text-lg mb-10">Edit </h2>

                    <form action="{{ route('expenses.update', $expense->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <x-input-label for="expense_date" :value="__('Date')" />
                            <x-text-input id="expense_date" name="expense_date" type="date"
                                class="w-full cursor-pointer" value="{{ $expense->expense_date->toDateString() }}" />
                            <x-input-error :messages="$errors->get('expense_date')" class="mt-2" />
                        </div>
                        <div class="mb-4">
                            <label for="category" class="sr-only">Category</label>
                            <select name="category" id="category"
                                class="bg-gray-100 w-full p-4 rounded-sm @error('category') border-red-500 @enderror">
                                <option value="">Select Category</option>
                                @foreach ($expense->group->categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id === $expense->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}</option>)
                                @endforeach
                            </select>

                            @error('category')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" class="w-full" value="{{ $expense->title }}" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="amount" :value="__('Amount')" />
                            <x-text-input id="amount" name="amount" class="w-full" value="{{ $expense->amount }}"
                                type="number" />
                            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Description')" /> <!-- Updated label value -->
                            <x-text-input :textarea="true" name="description" id="description"
                                class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ $expense->description }}</x-text-input>

                            @error('description')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit"
                                class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update
                                Expense</button>
                        </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
