<?php

namespace Database\Factories;

use App\Models\Provinces;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvincesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provinces::class;

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
        'parent_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
