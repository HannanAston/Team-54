{{-- resources/views/orders/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details') }} #{{ $order->id }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Status:</strong> {{ $order->status }}</p>
                <p><strong>Total:</strong> £{{ number_format($order->final_total, 2) }}</p>

                <h3 class="mt-4 font-semibold">Items</h3>
                <ul>
                    @foreach ($order->orderItems as $item)
                        <li>
                            {{ $item->product->name ?? 'Unknown product' }}
                            – Qty: {{ $item->quantity }}
                            – £{{ number_format($item->price, 2) }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
