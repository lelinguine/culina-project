<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Recipe;

use Database\Seeders\UserSeeder;
use Database\Seeders\RecipeSeeder;
use Database\Seeders\CommentSeeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(RecipeSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
