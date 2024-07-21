@extends('livewire.admin.index')
@section('content')
<div>
    <div class="d-flex align-items-center justify-content-between">
        <div class="mb-3">
            <h3 class="fw-bold">Feed Back List</h3>
            <p>Manage your feed back</p>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title text-center">Feed Back</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($feed_backs->isNotEmpty())

                    @foreach ($feed_backs as $feedBack)
                    @if($feedBack->message !== null)
                    <tr>
                        <td>{{ $feedBack->name }}</td>
                        <td>{{ $feedBack->email }}</td>
                        <td>{{ $feedBack->phone }}</td>
                        <td>{{ $feedBack->message }}</td>
                        <td>{{ $feedBack->created_at }}</td>
                    </tr>
                    @endif
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="
                            text-center
                            text-danger
                            fw-bold
                            fs-5
                        ">
                            No Feed Back Found
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection