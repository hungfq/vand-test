<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::query()->limit(10)->get()->pluck('id')->toArray();

        return [
            'owner_id' => $userIds[array_rand($userIds)],
            'name' => $this->faker->name(),
            'description' => $this->faker->text(100),
//            'created_by' => 1,
//            'updated_by' => 1,
        ];
    }
}
