<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(3)->create();

        Auth::login(User::find(1));
         \App\Models\Store::factory(10)->create();
         \App\Models\Product::factory(30)->create();
    }
}
