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
        Schema::create('amenities', function (Blueprint $table): void {
            $table->id();
            $table->string('amenity_name');
            $table->string('amenity_icon')->nullable();
            $table->text('amenity_description')->nullable();
            $table->string('amenity_icon_color')->nullable();
            $table->timestamps();

            $table->unique(['amenity_name', 'amenity_description']);
        });
    }
};
