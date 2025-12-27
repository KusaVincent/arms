<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentMethods = [
            ['name' => 'Cash', 'color' => 'info'],
            ['name' => 'Card', 'color' => 'warning'],
            ['name' => 'M-Pesa', 'color' => 'success'],
            ['name' => 'Bank Transfer', 'color' => 'gray'],
        ];

        foreach ($paymentMethods as $paymentMethod) {
            PaymentMethod::create($paymentMethod);
        }
    }
}
