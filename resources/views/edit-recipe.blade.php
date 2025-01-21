<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Recipe') }}
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-medium mb-4">Edit Recipe</h3>
            <form method="POST" action="{{ route('recipes.update', $recipe->id) }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label for="name" class="block text-gray-700">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $recipe->name) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>


                    <div>
                        <label for="ingredients" class="block text-gray-700">Ingredients</label>
                        <input type="text" id="text" name="ingredients" value="{{ old('ingredients', $recipe->ingredients) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>


                    <div>
                        <label for="steps" class="block text-gray-700">Steps</label>
                        <input type="text" id="text" name="steps" value="{{ old('steps', $recipe->steps) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>


                    <div>
                        <label for="image" class="block text-gray-700">Image</label>
                        <input type="file" id="image" name="image" value="{{ old('image', $recipe->image) }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Recipe
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
