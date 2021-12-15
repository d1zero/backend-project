<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Articles;

class ArticlesFactory extends Factory
{
    protected $model = Articles::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'short_desc' => $this->faker->text(),
            'dateTest' => $this->faker->date(),
        ];
    }
}
