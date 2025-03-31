<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Comment;

use Illuminate\Support\Facades\Storage;

class RecipesController extends Controller
{
    /**
     * Get all recipes
     */
    public function index()
    {
        $recipes = Recipe::with(['user', 'comments' => function ($query) {
            $query->where('status', 'published');
        }])->get();

        return response()->json($recipes, 200);
    }

    /**
     * Show a recipe with user & published comments
     */
    public function show($recipe_id)
    {
        $recipe = Recipe::with([
            'user', 
            'comments' => function ($query) {
                $query->where('status', 'published')->with('user');
            }
        ])->find($recipe_id);

        if (!$recipe) {
            return response()->json(['message' => 'Recette non trouvée'], 404);
        }

        return response()->json($recipe, 200);
    }

    /**
     * Create a recipe
     */
    public function create(Request $request)
    {
        $recipe = Recipe::create($request->all());

        return response()->json($recipe, 201);
    }

    /**
     * Delete a recipe
     */
    public function delete($recipe_id)
    {
        $recipe = Recipe::find($recipe_id);
        if (!$recipe) {
            return response()->json(['message' => 'Recette non trouvée'], 404);
        }
        $recipe->delete();
        return response()->json(['message' => 'Recette supprimée']);
    }

    /**
     * Update a recipe
     */
    public function patch(Request $request, $recipe_id)
    {
        $recipe = Recipe::find($recipe_id);
        if (!$recipe) {
            return response()->json(['message' => 'Recette non trouvée'], 404);
        }
        $recipe->update($request->all());
        return response()->json($recipe, 200);
    }
}