<?php

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
        Schema::create('payment_methods', function (Blueprint $table): void {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->string('name')
                ->unique();
            $table->string('color')
                ->nullable();
            $table->timestamps();
        });
    }
};
