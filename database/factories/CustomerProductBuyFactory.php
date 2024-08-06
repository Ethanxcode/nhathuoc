<?php

namespace Database\Factories;

use App\Models\CustomerProductBuy;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerProductBuyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerProductBuy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'product_id' => $this->faker->word,
        'points' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
