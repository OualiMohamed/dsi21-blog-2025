<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\User;
use App\Models\Category;
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
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'user_id' => User::get('id')->random(),
            'category_id' => Category::get('id')->random(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function ($post) {
            $tags = Tag::inRandomOrder()->limit(3)->get(); // Get 3 random tags
            $post->tags()->sync($tags); // Attach the tags to the post
            // Alternatively, you can use the following line to create and attach new tags
            // $post->tags()->attach(Tag::factory()->count(3)->create());
            // This will create 3 new tags and attach them to the post
        });
    }
}
