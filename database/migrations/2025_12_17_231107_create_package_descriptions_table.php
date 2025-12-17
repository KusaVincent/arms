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
        Schema::create('package_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->string('name');
            $table->string('description');
            $table->integer('period_in_months');
            $table->integer('period_in_years');
            $table->string('status');
            $table->timestamps();
        });
    }
};
