<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Recipe') }}
        </h2>
    </x-slot>

    <!-- Recipe List Section -->
    <div class="mt-8 max-w-4xl mx-auto">
        <h3 class="text-lg font-medium mb-6 ml-4">Recipe List</h3>

        @foreach ($recipes as $key => $recipe)
            <div class="bg-white p-6 rounded-lg shadow-md mb-6 relative flex items-center">
                <div class="flex-shrink-0 mr-6">
                    <img src="{{ asset('storage/img/recipe/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="h-32 w-32 rounded object-cover cursor-pointer" onclick="toggleRecipeDetails({{ $key }})">
                </div>

                <div class="flex-grow">
                    <div class="flex items-center mb-4">
                        <p class="font-extrabold text-2xl">{{ Str::title($recipe->name) }}</p>
                    </div>

                    <div class="flex items-center mb-4">
                        <p class="font-normal text-lg">{{$recipe->description }}</p>
                    </div>
                </div>

                <div class="flex space-x-4">
                    <a href="{{ route('recipe.edit', $recipe->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                    <form method="POST" action="{{ route('recipe.destroy', $recipe->id) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Full-Screen Overlay for Recipe Details -->
    @foreach ($recipes as $key => $recipe)
        <div id="recipe-overlay-{{ $key }}" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white p-8 rounded-lg max-w-4xl w-full">
                <div class="mb-4">
                    <img src="{{ asset('storage/img/recipe/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="h-32 w-32 rounded object-cover mb-4">
                    <p><strong>Ingredients:</strong></p>
                    <p>{{ Str::title($recipe->ingredients) }}</p>
                    <p><strong>Steps:</strong></p>
                    <p>{{ Str::title($recipe->steps) }}</p>
                </div>
                <button class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600" onclick="closeRecipeDetails({{ $key }})">Close</button>
            </div>
        </div>
    @endforeach

    <script>
        // Toggle the visibility of the full-page recipe overlay
        function toggleRecipeDetails(index) {
            const overlayDiv = document.getElementById(`recipe-overlay-${index}`);
            overlayDiv.classList.toggle('hidden');
        }

        // Close the recipe details overlay
        function closeRecipeDetails(index) {
            const overlayDiv = document.getElementById(`recipe-overlay-${index}`);
            overlayDiv.classList.add('hidden');
        }
    </script>
</x-app-layout>
