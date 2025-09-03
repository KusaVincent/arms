<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table): void {
            $table->id();
            $table->string('address');
            $table->string('town_city');
            $table->string('area')->nullable();
            $table->string('full_address')->unique();
            $table->text('map')->nullable();
            $table->timestamps();

            $table->unique(['address', 'town_city', 'area'], 'unique_address_town_city_area');
        });
    }
};
