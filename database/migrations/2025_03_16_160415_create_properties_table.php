<?php

declare(strict_types=1);

use App\Models\Location;
use App\Models\PropertyType;
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
        Schema::create('properties', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(PropertyType::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Location::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->text('property_image');
            $table->integer('rent');
            $table->integer('deposit');
            $table->boolean('available')->default(true);
            $table->boolean('negotiable')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
