@extends('livewire.admin.index')
@section('content')
<div>
    <h1>Order</h1>
    @if($this->orders)
    <div class="table-responsive">
        <table class="table" id="myTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Order total</th>
                    <th>Order Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($this->orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->user->email }}</td>
                    <td>{{ $order->total }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>
                        <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-primary text-center">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p>No orders</p>
    @endif
    <table></table>
</div>
@endsection