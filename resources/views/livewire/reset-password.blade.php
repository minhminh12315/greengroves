@extends('livewire.index')
@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Password and Security</h1>
        <div class="btn-showAsideSetting d-lg-none d-block">
            <span class="material-symbols-outlined">
                menu
            </span>
        </div>
    </div>
    <form wire:submit.prevent="reset_pass" class="needs-validation">
        <div class="d-flex flex-column align-items-start justify-content-start">
            <label for="email" class="form-label">Email*</label>
            <input wire:model="email" id="email" type="email" name="email" autocomplete="off" placeholder="Enter your email" required autofocus>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-column align-items-start justify-content-start">
            <label for="current_password" class="form-label">Current Password*</label>
            <input wire:model.live.debounce.250s="current_password" id="current_password" type="password" autocomplete="off" placeholder="Enter your current password" name="current_password" required>
            @error('current_password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-column align-items-start justify-content-start">
            <label for="password" class="form-label">New Password*</label>
            <input wire:model.live.debounce.250s="password" id="password" type="password" name="password" autocomplete="off" placeholder="Enter your new password" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex flex-column align-items-start justify-content-start">
            <label for="password_confirmation" class="form-label">Confirm Password*</label>
            <input wire:model.live.debounce.250s="password_confirmation" id="password_confirmation" type="password" autocomplete="off" placeholder="Confirm your new password" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn_success {{!($email && $current_password && $password && $password_confirmation ) ? 'cursor-not-allowed' : ''}}" @if(!($email && $current_password && $password && $password_confirmation )) disabled @endif >Reset Password</button>

    </form>
</div>
@endsection