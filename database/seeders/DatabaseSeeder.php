<?php
namespace Database\Seeders;

use App\Models\City;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
		
    Company::factory(10)->create();
	
	$this->call([
            ProductSeeder::class,
        ]);
    }
}
