<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;


class RecipeController extends Controller
{

    public function store(Request $request)
    {
        //Validate the request
        $validated = $request->validate([
            'name' =>'required',
            'ingredients' =>'required',
            'steps' =>'required',
            'image' => 'required|mimes:jpeg,jpg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $filenameWithExtension = $request->file('image');

            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

            $extension = $request->file('image')->getClientOriginalExtension();

            $filenameToStore = $filename . '_' . time() . '.' . $extension;

            $request->file('image')->storeAs('img/recipe', $filenameToStore);

            $validated['image'] = $filenameToStore;

        }


        //Use the validated data to create a recipe
        $recipe=Recipe::create($validated);

        //Redirect back with success message
        return redirect()->route('dashboard')->with([
            'success' => 'Recipe added Successfully',
            'newRecipe' => $recipe,





        ]);
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
        return redirect()->route('dashboard')->with('success_delete', 'Recipe deleted successfully');
    }

    public function edit(Recipe $recipe)
    {
        return view('edit-recipe', compact('recipe'));
    }

    public function update(Request $request, string $id)
    {

        $recipe = Recipe::find($id);

        $validated = $request->validate([
            'name' => 'required',
            'ingredients' => 'required',
            'steps' => 'required',
            'image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

       if($recipe->save($validated)) {
        return redirect()->route('dashboard')->with('success', 'Recipe updated successfully.');
       }

       dd('something went wrong');

    }

}


