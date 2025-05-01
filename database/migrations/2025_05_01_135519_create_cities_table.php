<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
			$table->string('name')->unique();
            $table->timestamps();
        });
		
		DB::table('cities')->insert([
        ['name' => 'Vilnius', 'created_at' => now()],
        ['name' => 'Kaunas', 'created_at' => now()],
        ['name' => 'Klaipėda', 'created_at' => now()],
		['name' => 'Šiauliai', 'created_at' => now()],
		['name' => 'Panevėžys', 'created_at' => now()],
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
