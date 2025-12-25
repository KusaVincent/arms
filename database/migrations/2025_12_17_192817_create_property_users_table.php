<?php

use App\Models\Operator;
use App\Models\Property;
use App\Models\User;
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
        Schema::create('operator_property', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Operator::class)
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor(Property::class)
                ->constrained()
                ->nullOnDelete();
            $table->string('relationship');
            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamps();

            $table->unique(['operator_id', 'property_id']);
        });
    }
};
