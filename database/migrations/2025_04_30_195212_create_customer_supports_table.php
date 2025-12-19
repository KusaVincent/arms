<?php

declare(strict_types=1);

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
        Schema::create('customer_supports', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->string('email');
            $table->text('message');
            $table->string('subject');
            $table->string('phone_number');
            $table->text('reply')->nullable();
            $table->foreignIdFor(User::class)
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }
};
