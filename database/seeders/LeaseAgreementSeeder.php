<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\LeaseAgreement;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Random\RandomException;

final class LeaseAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @throws RandomException
     */
    public function run(): void
    {
        LeaseAgreement::factory(5)->create()->each(function ($lease): void {
            $totalTarget = (int) $lease->lease_amount + (int) $lease->deposit_amount;

            $installments = random_int(1, 3);

            for ($i = 0; $i < $installments; $i++) {
                $alreadyPaid = Payment::where('payable_id', $lease->id)
                    ->where('payable_type', LeaseAgreement::class)
                    ->sum('payment_amount');

                $remainingBalance = $totalTarget - $alreadyPaid;

                if ($remainingBalance > 0) {
                    $amountToPay = ($i === $installments - 1)
                        ? $remainingBalance
                        : random_int(1, (int) $remainingBalance);

                    Payment::factory()->create([
                        'payable_id' => $lease->id,
                        'payment_amount' => $amountToPay,
                    ]);
                }
            }
        });
    }
}
