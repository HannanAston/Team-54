<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Order;
use App\Models\User;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10, 200);
        $discount = $this->faker->randomElement([0, round($subtotal * 0.10, 2)]);
        $total    = $subtotal - $discount;

        return [
            'user_id'  => User::factory(),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total'    => $total,
            'status'   => 'completed',
        ];
    }
}
