@extends('livewire.index')
@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>List Of Ordered Products</h1>
        <div class="btn-showAsideSetting d-lg-none d-block">
            <span class="material-symbols-outlined">
                menu
            </span>
        </div>
    </div>
    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Order Date</th>
                    <th>Order Address</th>
                    <th>Order Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->name }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->address }} - {{ $order->street }} - {{ $order->city }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                        <a href="{{ route('order.detail', $order->id) }}" class="btn btn-primary">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
@endsection