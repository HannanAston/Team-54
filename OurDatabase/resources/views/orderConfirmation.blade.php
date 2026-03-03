<x-app-layout>
    <h1>Order Confirmation</h1>
    <p>{{$message}}</p>
    <p><strong>Customer:</strong> {{ $order->user->name }}</p>
    <p><strong>Email:</strong> {{ $order->user->email }}</p>

    <p><strong>Subtotal:</strong> £{{$order->subtotal}}</p>
    <p><strong>Discount:</strong> £{{$order->discount}}</p>
    <p><strong>Total:</strong> £{{ $order->total }}</p>
    @if (isset($error))
        <p>{{ $error }}</p>
    @endif
</x-app-layout>
