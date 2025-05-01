<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */ 
	protected $model = Company::class;
	 
	 private static $companyNames = [
            'UAB Auksinis Kelias', 'UAB Baltas Švyturys', 'UAB Horizontas Investicijos',
            'UAB Gintarinė Banga', 'UAB Dangaus Ratas Logistika', 'UAB Taikos Vartai',
            'UAB Tamsos Grįžulys', 'UAB Saulėtekio Tiltas', 'UAB Tyras Vėjas',
            'UAB Tylus Takas'
        ];
	 
    public function definition(): array
    {
		
		$companyName = array_shift(self::$companyNames);
        
		return [
			'name' => $companyName,
            'company_code' => $this->faker->unique()->numerify('########'),
            'director' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'adresas' => $this->faker->unique()->address,
            'city_id' => \App\Models\City::inRandomOrder()->first()?->id ?? \App\Models\City::factory(),
        ];
    }
}
