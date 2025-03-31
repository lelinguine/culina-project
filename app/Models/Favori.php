<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favori extends Model
{
    use HasFactory;

    /**
     * Get the user that owns the fav.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the recipe that owns the fav.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
