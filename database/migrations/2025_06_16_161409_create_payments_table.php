<?php

declare(strict_types=1);

use App\Models\LeaseAgreement;
use App\Models\PaymentMethod;
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
        Schema::create('payments', function (Blueprint $table): void {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->nullableMorphs('payable');
            $table->foreignIdFor(PaymentMethod::class)
                ->constrained()
                ->nullOnDelete();
            $table->date('payment_date');
            $table->integer('payment_amount');
            $table->timestamps();
        });
    }
};
