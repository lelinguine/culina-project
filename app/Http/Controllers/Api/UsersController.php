<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    /**
     * Get all users
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Get a user by id
     */
    public function show($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        return response()->json($user);
    }

    /**
     * Delete a user
     */
    public function delete($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        $user->delete();
        return response()->json(['message' => 'Utilisateur supprimé']);
    }

    /**
     * Update a user
     */
    public function patch(Request $request, $user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        $user->update($request->all());
        return response()->json($user);
    }

    /**
     * Get comments from a user
     */
    public function comments($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }
        return response()->json($user->comments);
    }

    /**
     * Get recipes from a user
     */
    public function recipes($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $recipes = $user->recipes()->with([
            'comments' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        return response()->json($recipes);
    }

    /**
     * Get favoris from a user
     */
    public function favoris($user_id)
    {
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'Utilisateur non trouvé'], 404);
        }

        $favoris = $user->favoris()->with([
            'recipe.comments' => function ($query) {
                $query->where('status', 'published');
            }
        ])->get();

        return response()->json($favoris);
    }
}