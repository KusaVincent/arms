<?php

declare(strict_types=1);

use App\Models\Property;
use App\Models\Tenant;
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
        Schema::create('lease_agreements', function (Blueprint $table): void {
            $table->id();
            $table->string('mnemonic')
                ->unique()
                ->index();
            $table->foreignIdFor(Tenant::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignIdFor(Property::class)
                ->constrained()
                ->cascadeOnDelete();
            $table->date('lease_start_date');
            $table->date('lease_end_date');
            $table->decimal('rent_amount', 10);
            $table->decimal('deposit_amount', 10);
            $table->string('lease_term');
            $table->timestamps();
        });
    }
};
