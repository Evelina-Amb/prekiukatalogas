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
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
			$table->string('name')->unique();
            $table->timestamps();
        });
		
		DB::table('categories')->insert([
	['name' => 'Maistas','created_at' => now()],
    ['name' => 'Drabužiai','created_at' => now()],
	['name' => 'Elektronika','created_at' => now()],
    ['name' => 'Buitinė technika','created_at' => now()],
    ['name' => 'Baldai','created_at' => now()],
    ['name' => 'Sportas','created_at' => now()],
]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
