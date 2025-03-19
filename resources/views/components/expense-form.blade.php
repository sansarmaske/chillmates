@props(['action', 'method' => 'POST', 'expense' => null, 'categories' => [], 'submitText' => 'Save'])

<form action="{{ $action }}" method="POST" class="space-y-6">
    @csrf
    @if($method !== 'POST')
        @method($method)
    @endif

    <x-form-section>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Date -->
            <x-input-group :label="__('Date')" for="expense_date" :error="$errors->get('expense_date')">
                <x-text-input 
                    id="expense_date" 
                    name="expense_date" 
                    type="date" 
                    class="block w-full rounded-lg cursor-pointer transition duration-150 ease-in-out"
                    value="{{ old('expense_date', $expense ? $expense->expense_date->toDateString() : now()->toDateString()) }}" 
                />
            </x-input-group>

            <!-- Category -->
            <x-input-group :label="__('Category')" for="category" :error="$errors->get('category')">
                <select 
                    name="category" 
                    id="category"
                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 ease-in-out"
                >
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option 
                            value="{{ $category->id }}"
                            {{ old('category', $expense?->category_id) == $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </x-input-group>
        </div>
    </x-form-section>

    <x-form-section>
        <!-- Title -->
        <x-input-group :label="__('Title')" for="title" :error="$errors->get('title')">
            <x-text-input 
                id="title" 
                name="title" 
                class="block w-full rounded-lg transition duration-150 ease-in-out" 
                value="{{ old('title', $expense?->title) }}" 
                placeholder="Enter expense title"
            />
        </x-input-group>

        <!-- Amount -->
        <x-input-group :label="__('Amount')" for="amount" :error="$errors->get('amount')">
            <div class="relative rounded-lg shadow-sm">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <span class="text-gray-500 sm:text-sm">$</span>
                </div>
                <x-text-input 
                    id="amount" 
                    name="amount" 
                    class="pl-7 block w-full rounded-lg transition duration-150 ease-in-out" 
                    value="{{ old('amount', $expense?->amount) }}" 
                    type="number" 
                    step="0.01"
                    placeholder="0.00"
                />
            </div>
        </x-input-group>

        <!-- Description -->
        <x-input-group :label="__('Description')" for="description" :error="$errors->get('description')" :helpText="__('Add any additional details about this expense.')">
            <x-text-input 
                :textarea="true" 
                name="description" 
                id="description"
                class="block w-full rounded-lg transition duration-150 ease-in-out"
                placeholder="Enter expense details"
            >{{ old('description', $expense?->description) }}</x-text-input>
        </x-input-group>
    </x-form-section>

    <!-- Submit Button -->
    <div class="pt-4">
        <x-button type="submit" variant="primary" size="lg" :fullWidth="true">
            {{ $submitText }}
        </x-button>
    </div>
</form> 
