<?php

namespace Database\Factories;

use App\Models\FactoryInfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class FactoryInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FactoryInfo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'industrial_area_id' => $this->faker->randomDigitNotNull,
        'nationals' => $this->faker->randomDigitNotNull,
        'national_id' => $this->faker->randomDigitNotNull,
        'category_id' => $this->faker->randomDigitNotNull,
        'lang' => $this->faker->word,
        'title' => $this->faker->word,
        'description' => $this->faker->word,
        'short_description' => $this->faker->word,
        'company_name' => $this->faker->word,
        'representative_name' => $this->faker->word,
        'business_description' => $this->faker->word,
        'fax' => $this->faker->word,
        'website' => $this->faker->word,
        'establish_date' => $this->faker->word,
        'capital' => $this->faker->word,
        'parent_company' => $this->faker->word,
        'shareholder' => $this->faker->word,
        'employee' => $this->faker->word,
        'account_period' => $this->faker->word,
        'bank' => $this->faker->word,
        'iso' => $this->faker->word,
        'value_customer' => $this->faker->word,
        'infrastructure' => $this->faker->word,
        'product_information' => $this->faker->word,
        'factory_area' => $this->faker->word,
        'display_image' => $this->faker->word,
        'province_id' => $this->faker->randomDigitNotNull,
        'factory_id' => $this->faker->word,
        'main_client' => $this->faker->word,
        'head_office' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
