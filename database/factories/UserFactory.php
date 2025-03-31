<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = [
            [
                'name' => 'Admin',
                'auth' => 'admin',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password123'),
            ],
            [
                'name' => 'John Doe',
                'auth' => 'user',
                'email' => 'john@example.com',
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('password123'),
            ],
            [
                'name' => 'Jane Smith',
                'auth' => 'user',
                'email' => 'jane@example.com',
                'email_verified_at' => null,
                'password' => static::$password ??= Hash::make('password123'),
            ],
        ];

        static $users_index = 0;
        $user = $users[$users_index];
        $users_index = ($users_index + 1) % count($users);

        return [
            'name' => $user['name'],
            'auth' => $user['auth'],
            'email' => $user['email'],
            'email_verified_at' => $user['email_verified_at'],
            'password' => $user['password'],
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
