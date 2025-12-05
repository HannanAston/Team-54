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
        $total = $this->faker->randomFloat(2, 10, 200);
        $discount = $this->faker->randomFloat(2, 0, $total * 0.3);
        $final = $total - $discount;

        return [
            'user_id' => User::factory(),
            'subtotal' => $total,
            'total' => $total,
            'discount' => $discount,
            'status' => 'completed',
        ];
    }
}
