<?php

declare(strict_types=1);

use App\Models\Property;
use App\Models\Tenant;
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
        Schema::create('maintenances', function (Blueprint $table): void {
            $table->id();
            $table->foreignIdFor(Property::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Tenant::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->text('description');
            $table->enum('status',
                ['Pending', 'In Progress', 'Completed']);
            $table->date('request_date');
            $table->date('completion_date')->nullable();
            $table->timestamps();
        });
    }
};
