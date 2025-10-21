<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('model_reference_counters', function (Blueprint $table): void {
            $table->id();
            $table->string('key')
                ->unique()
                ->nullable();
            $table->unsignedBigInteger('value')
                ->default(0);
            $table->timestamps();
        });
    }
};
