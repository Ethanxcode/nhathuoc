<?php

namespace Database\Factories;

use App\Models\IndustrialArea;
use Illuminate\Database\Eloquent\Factories\Factory;

class IndustrialAreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IndustrialArea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name_vi' => $this->faker->word,
        'name_jp' => $this->faker->word,
        'image' => $this->faker->word,
        'stt' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
