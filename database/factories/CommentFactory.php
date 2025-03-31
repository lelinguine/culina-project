<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Comment;
use App\Models\Recipe;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::inRandomOrder()->first();
        $recipe = Recipe::inRandomOrder()->first();
        $status = $this->faker->randomElement(['pending', 'published']);

        return [
            'user_id' => $user->id,
            'recipe_id' => $recipe->id,
            'content' => $this->faker->sentence(),
            'status' => $status,
        ];
    }
}
