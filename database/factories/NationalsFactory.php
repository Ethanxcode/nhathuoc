<?php

namespace Database\Factories;

use App\Models\Nationals;
use Illuminate\Database\Eloquent\Factories\Factory;

class NationalsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Nationals::class;

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
        'stt' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
