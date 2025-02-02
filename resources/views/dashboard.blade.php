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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class=" text-gray-900">
                    {{ __("You're logged in!") }}
                </div>



                <form action="{{route('groups.store')}}" method="POST">

                    @csrf
                    <input type="hidden" name="type" value="family">

                    <div class="flex justify-end ">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition">Enable
                            Family</a>
                    </div>
                </form>

            </div>
        </div>
</x-app-layout>
