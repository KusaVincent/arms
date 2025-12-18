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
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->foreignIdFor(PropertyType::class)
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor(Location::class)
                ->constrained()
                ->nullOnDelete();
            $table->string('name');
            $table->text('description');
            $table->text('property_image');
            $table->integer('rent');
            $table->integer('deposit');
            $table->smallInteger('available')->default(1);
            $table->smallInteger('negotiable')->default(0);
            $table->timestamps();
        });
    }
};
