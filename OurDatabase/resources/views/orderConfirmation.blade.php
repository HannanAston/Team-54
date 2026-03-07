<x-app-layout>
    <h1>Order Confirmation</h1>
    <p>{{$message}}</p>
    <p><strong>Customer:</strong> {{ $order->user->name ?? 'Guest' }}</p>
    @if(isset($order->user))
    <p><strong>Email:</strong> {{ $order->user->email ?? $order->guest_email ?? 'guest@example.com' }}</p>
    @endif

    <p><strong>Subtotal:</strong> £{{$order->subtotal}}</p>
    <p><strong>Discount:</strong> £{{$order->discount}}</p>
    <p><strong>Total:</strong> £{{ $order->total }}</p>
    @if (isset($error))
        <p>{{ $error }}</p>
    @endif
</x-app-layout>
