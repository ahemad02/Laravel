<?php
namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(),
            'body'        => $this->faker->paragraph(),
            'user_id'     => User::factory(), // assigns a new user to each post
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
        ];
    }
}
