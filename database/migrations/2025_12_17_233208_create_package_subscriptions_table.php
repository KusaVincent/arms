<?php

use App\Models\Operator;
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
        Schema::create('package_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->foreignIdFor(Operator::class)
                ->constrained()
                ->nullOnDelete();
            $table->foreignIdFor(PackageDescription::class)
                ->constrained()
                ->nullOnDelete();
            $table->integer('package_price');
            $table->integer('negotiated_price')
                ->nullable();
            $table->integer('no_of_properties');
            $table->integer('no_of_support_team');
            $table->string('status');
            $table->string('remarks')
                ->nullable();
            $table->datetime('effective_date');
            $table->datetime('expiry_date');
            $table->timestamps();
        });
    }
};
