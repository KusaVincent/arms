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
            $table->integer('properties');
            $table->integer('support_team');
            $table->integer('monthly_package_price');
            $table->integer('annual_package_price');
            $table->string('status');
            $table->string('published');
            $table->datetime('published_from')->nullable();
            $table->datetime('published_until')->nullable();
            $table->timestamps();
        });
    }
};
