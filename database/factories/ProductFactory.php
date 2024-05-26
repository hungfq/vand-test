<?php

namespace Database\Factories;

use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $stores = Store::query()->limit(10)->get()->toArray();

        return [
            'owner_id' => data_get($stores[array_rand($stores)], 'owner_id'),
            'store_id' => data_get($stores[array_rand($stores)], 'id'),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(100),
//            'created_by' => 1,
//            'updated_by' => 1,
        ];
    }
}
