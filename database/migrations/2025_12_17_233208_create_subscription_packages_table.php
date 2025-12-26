<?php

use App\Models\PackageDescription;
use App\Models\Payment;
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
        Schema::create('subscription_packages', function (Blueprint $table) {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->foreignIdFor(User::class)
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor(PackageDescription::class)
                ->constrained()
                ->nullOnDelete();
            $table->integer('no_of_properties');
            $table->integer('no_of_support_team');
            $table->string('status');
            $table->datetime('effective_date');
            $table->datetime('expiry_date');
            $table->timestamps();
        });
    }
};
