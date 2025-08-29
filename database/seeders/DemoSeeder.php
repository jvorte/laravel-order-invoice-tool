<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Invoice;

class DemoSeeder extends Seeder
{
    public function run()
    {
        // Διαγραφή παλιών records με delete() για να αποφύγουμε foreign key errors
        Invoice::query()->delete();
        Order::query()->delete();
        Customer::query()->delete();

        // Δημιουργία demo customer
        $customer = Customer::firstOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo Customer',
                'phone' => '1234567890',
                'address' => 'Demo Address'
            ]
        );

        $statuses = ['pending', 'completed', 'cancelled'];

        for ($i = 1; $i <= 10; $i++) {
            $status = $statuses[array_rand($statuses)];
            $total = rand(50, 500); // τυχαίο total ανά παραγγελία

            $order = Order::create([
                'customer_id' => $customer->id,
                'status' => $status,
                'total' => $total
            ]);

            // Δημιουργία demo invoice μόνο για completed orders
            if ($status === 'completed') {
                Invoice::create([
                    'order_id' => $order->id,
                    'file_path' => "invoices/demo-invoice-{$i}.pdf"
                ]);
            }
        }

        $this->command->info('Demo data seeded successfully!');
    }
}
