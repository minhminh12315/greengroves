@extends('livewire.index')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <h1 class="mt-3">Order Detail</h1>
            <h5 class="mt-3">Name: {{ $this->order->name }}</h5>
            <h5 class="mt-3">Phone: {{ $this->order->phone }}</h5>
            <h5 class="mt-3">Address: {{ $this->order->address }} -  {{ $this->order->street }} - {{ $this->order->city }}</h5>
            <h5 class="mt-3">Date: {{ $this->order->created_at }}</h5>
        </div>
        <div class="col-6 w-100 text-end">
            <a href="{{ route('list_order') }}" class="btn btn-primary">Back</a>
            
        </div>
    </div>
    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($this->order->orderDetails as $orderDetail)
        <tr>
            <td>{{ $orderDetail->productVariant->product->name }}</td>
            <td>{{ $orderDetail->quantity }}</td>
            <td>{{ number_format($orderDetail->price, 2) }}</td>
            <td>{{ number_format($orderDetail->total, 2) }}</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="3" class="text-right font-weight-bold">Total</td>
            <td>{{ number_format($this->order->total, 2) }}</td>
        </tr>
    </tbody>
</table>
</div>
@endsection