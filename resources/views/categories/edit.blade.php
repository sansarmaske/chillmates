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

                    <h2 class="font-bold text-lg mb-10">Edit Category</h2>

                    <form action="{{route('categories.update', $category->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-4">
                            <label for="title" class="sr-only"">Title</label>
                            <input type="text" name="name" id="name" placeholder="Name" class="bg-gray-100 w-full p-4 rounded-sm @error('name') border-red-500 @enderror" value="{{$category->name}}">

                            @error('name')
                                <div class="text-red-500 mt-2 text-sm">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-3 rounded font-medium w-full">Update Category</button>
                        </div>



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
