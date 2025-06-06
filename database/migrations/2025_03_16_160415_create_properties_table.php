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
            $table->string('slug')
                ->unique()
                ->index()
                ->nullable();
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
            $table->boolean('available')
                ->index();
            $table->boolean('negotiable');
            $table->timestamps();
        });
    }
};
