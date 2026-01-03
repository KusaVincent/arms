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
        Schema::create('contacts', function (Blueprint $table): void {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->string('label');
            $table->string('icon');
            $table->string('link');
            $table->string('link_text');
            $table->smallInteger('section');
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
