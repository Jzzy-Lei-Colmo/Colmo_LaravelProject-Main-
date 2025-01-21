<?php

use App\Models\Recipe;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $recipes = Recipe::all();
    return view('dashboard',compact('recipes')) ;
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/recipe/store', [RecipeController::class, 'store']) -> name('recipe.store');
Route::delete('/recipe/{recipe}', [RecipeController::class, 'destroy']) -> name('recipe.destroy');
Route::get('/recipe/{recipe}/edit',[RecipeController::class, 'edit'])->name('recipe.edit');

Route::put('/recipe/{id}', [RecipeController::class, 'update'])->name('recipes.update');


require __DIR__.'/auth.php';
