{{-- resources/views/orders/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Orders') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @if ($orders->isEmpty())
                    <p>You have no orders yet.</p>
                @else
                    <ul>
                        @foreach ($orders as $order)
                            <li>
                                Order #{{ $order->id }} –
                                Total: £{{ number_format($order->final_total, 2) }}
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
