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
		$ikurimoMetai = $this->faker->numberBetween(1980, 2025);
		$city = \App\Models\City::inRandomOrder()->first() ?? \App\Models\City::factory()->create();
		$cityId = str_pad($city->id, 2, '0', STR_PAD_LEFT); // Jei ID vienženklis, prideda nulį
		$randomPart = str_pad((string)rand(0, 999), 3, '0', STR_PAD_LEFT);
        $companyCode = $cityId . $ikurimoMetai . $randomPart;
		
		return [
			'name' => $companyName,
			'ikurimo_metai' =>$ikurimoMetai, 
            'company_code' =>$companyCode,
            'director' => $this->faker->name,
			'phone' => $this->faker->phoneNumber,
			'adresas' => $this->faker->unique()->address,
			'city_id' => $city->id,
        ];
    }
}
