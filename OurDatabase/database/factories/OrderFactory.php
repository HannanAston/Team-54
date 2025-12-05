<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $subtotal = $this->faker->randomFloat(2, 10, 200);
        $discount = $this->faker->randomFloat(2, 0, $subtotal * 0.1);
        $total = $subtotal - $discount;

        return [
            'user_id' => User::factory(),
            'subtotal' => $subtotal,
            'total' => $total,
            'discount' => $discount,
            'status' => 'completed',
        ];
    }
}
