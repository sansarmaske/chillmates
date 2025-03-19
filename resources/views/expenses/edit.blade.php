<x-app-layout>
    <x-slot name="header">
        <x-page-header 
            title="{{ __('Expenses') }}"
            :action="route('expenses', ['group_id' => $expense->group_id])"
            actionText="Back to List"
            actionIcon='<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>'
        />
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-card :title="__('Edit Expense')">
                <x-expense-form 
                    :action="route('expenses.update', $expense->id)" 
                    method="PATCH"
                    :expense="$expense"
                    :categories="$expense->group->categories" 
                    :submitText="__('Update Expense')"
                />
            </x-card>
        </div>
    </div>
</x-app-layout>
