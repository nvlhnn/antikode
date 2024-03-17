<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Brand::factory(3)->create();
        \App\Models\Outlet::factory(5)->create();
        \App\Models\Product::factory(5)->create();
    }
}
