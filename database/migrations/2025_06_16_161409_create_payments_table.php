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
            $table->foreignIdFor(LeaseAgreement::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(PaymentMethod::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->date('payment_date');
            $table->decimal('payment_amount', 10);
            $table->timestamps();
        });
    }
};
