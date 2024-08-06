<?php

namespace Database\Factories;

use App\Models\Factory;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Factory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'logo' => $this->faker->word,
        'big_image' => $this->faker->word,
        'small_image01' => $this->faker->word,
        'small_image02' => $this->faker->word,
        'small_image03' => $this->faker->word,
        'is_featured' => $this->faker->randomDigitNotNull,
        'is_actived' => $this->faker->randomDigitNotNull,
        'user_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
