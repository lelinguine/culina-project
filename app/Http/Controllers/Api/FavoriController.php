<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Favori;

class FavoriController extends Controller
{
    /**
     * Show favori
     */
    public function show(Request $request)
    {
        $user = $request->user();
        $favoris = Favori::where('recipe_id', $request->recipe_id)
            ->where('user_id', $user->id)
            ->get();

        return response()->json($favoris);
    }

    /**
     * Add a recipe to favoris
     */
    public function add(Request $request)
    {
        $user = $request->user();
        $recipe = Recipe::find($request->recipe_id);

        if (!$recipe) {
            return response()->json([
                'message' => 'Recipe not found'
            ], 404);
        }

        $favori = Favori::where('user_id', $user->id)
            ->where('recipe_id', $recipe->id)
            ->first();

        if ($favori) {
            return response()->json([
                'message' => 'Recipe already in favoris'
            ], 400);
        }

        $favori = new Favori();
        $favori->user_id = $user->id;
        $favori->recipe_id = $recipe->id;
        $favori->save();

        return response()->json([
            'message' => 'Recipe added to favoris'
        ], 201);
    }

    /**
     * Remove a recipe from favoris
     */
    public function remove(Request $request, $recipe_id)
    {
        $user = $request->user();
        $recipe = Recipe::find($recipe_id);

        if (!$recipe) {
            return response()->json([
                'message' => 'Recipe not found'
            ], 404);
        }

        $favori = Favori::where('user_id', $user->id)
            ->where('recipe_id', $recipe->id)
            ->first();

        if (!$favori) {
            return response()->json([
                'message' => 'Recipe not in favoris'
            ], 400);
        }

        $favori->delete();

        return response()->json([
            'message' => 'Recipe removed from favoris'
        ], 200);
    }
}