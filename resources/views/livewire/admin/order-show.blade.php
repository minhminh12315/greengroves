@extends('livewire.admin.index')
@section('content')
<div>
    <h1>Order Detail</h1>
    <div class="card">
        <div class="card-header">
            <h4>Order ID: {{ $this->order->id }}</h4>
        </div>
        <div class="card-body">
            <h5>Customer Name: {{ $this->order->user->name }}</h5>
            <h5>Customer Email: {{ $this->order->user->email }}</h5>
            <h5>Order total: {{ $this->order->total }}</h5>
            <h5>Order Date: {{ $this->order->created_at }}</h5>
            <h5>Order Status: {{ $this->order->status }}</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Detail</th>
                        <th>Product Name</th>
                        <th>Product Price</th>
                        <th>Product Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->orderDetails as $orderDetail)
                    <tr>
                        <td>{{ $orderDetail->id}}</td>
                        <td>{{ $orderDetail->productVariant->product->name }}</td>
                        <td>{{ $orderDetail->productVariant->price }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right font-weight-bold">Total</td>
                        <td>{{ $this->order->total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection