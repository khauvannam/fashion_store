<?php

namespace Database\Factories\Articles;

use App\Models\Articles\Article;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    protected $model = Article::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'img_url' => $this->faker->imageUrl(),
            'short_description' => $this->faker->sentence(50),
            'content' => $this->faker->paragraphs(10, true),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
