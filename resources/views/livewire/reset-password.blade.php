@extends('livewire.index')
@section('content')
<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="reset_pass" class="needs-validation">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input wire:model="email" id="email" type="email" name="email" class="form-control" required autofocus>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input wire:model.lazy="current_password" id="current_password" type="password" name="current_password" class="form-control" required>
            @error('current_password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input wire:model.lazy="password" id="password" type="password" name="password" class="form-control" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input wire:model.lazy="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>
    </form>
</div>
@endsection