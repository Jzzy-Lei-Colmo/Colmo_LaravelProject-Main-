<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                <!-- Add Recipe Form -->
                <div class="mb-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ session('success') }}</strong>
                            <span class="block sm:inline">Recipe has been added successfully</span>
                        </div>
                    @elseif(session('success_delete'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">{{ session('success_delete') }}</strong>
                            <span class="block sm:inline">Recipe has been deleted successfully</span>
                        </div>
                    @endif

                    <h3 class="text-lg font-medium mb-4">Add New Recipe</h3>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('recipe.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-gray-700">Name</label>
                                <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="ingredients" class="block text-gray-700">Ingredients</label>
                                <input type="text" id="ingredients" name="ingredients" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="steps" class="block text-gray-700">Steps</label>
                                <input type="text" id="steps" name="steps" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>

                            <div>
                                <label for="image" class="block text-gray-700">Image</label>
                                <input type="file" id="image" name="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Add Recipe
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Recipe List Table -->
                <div class="mt-8">
                    <h3 class="text-lg font-medium mb-4">Recipe List</h3>
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="py-2 border-b">#</th>
                                <th class="py-2 border-b">Name</th>
                                <th class="py-2 border-b">Ingredients</th>
                                <th class="py-2 border-b">Steps</th>
                                <th class="py-2 border-b">Image</th>
                                <th class="py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recipes as $key => $recipe)
                                <tr>
                                    <td class="py-2 border-b px-4">{{ $key + 1 }}</td>
                                    <td class="py-2 border-b px-4">{{ $recipe->name }}</td>
                                    <td class="py-2 border-b px-4">{{ $recipe->ingredients }}</td>
                                    <td class="py-2 border-b px-4">{{ $recipe->steps }}</td>
                                    <td class="py-2 border-b px-4">
                                        <img src="{{ asset('storage/public/img/recipe/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="h-5px w-5px">
                                    </td>
                                    <td class="py-2 border-b px-4">
                                        <a href="{{ route('recipe.edit', $recipe->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <form method="POST" action="{{ route('recipe.destroy', $recipe->id) }}" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>
