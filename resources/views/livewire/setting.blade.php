<div>
    <h1>Setting Information</h1>
    <form wire:submit="update_information">
        <div class="form-group">
            <label for="name">Username</label>
            <input wire:model="name" type="text" class="form-control" id="name" placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label for="fullname">Fullname</label>
            <input wire:model="fullname" type="text" class="form-control" id="fullname" placeholder="Enter your fullname">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input disabled wire:model="email" type="email" class="form-control" id="email" placeholder="Enter your email">
        </div>
        <div class="form-group">
            <label for="avatar">Avatar</label>
            <input wire:model="new_avatar" type="file" class="form-control" id="avatar">
        </div>
        @if($new_avatar)
        <img src="{{ $new_avatar->temporaryUrl() }}" width="100" height="100" class="img-fluid" alt="Avatar">
        @else
        <img src="{{ Storage::url($avatar) }}" width="100" height="100" class="img-fluid" alt="Avatar">
        @endif

        <div class="form-group">
            <label for="phone">Phone</label>
            <input wire:model="phone" type="text" class="form-control" id="phone" placeholder="Enter your phone number">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input wire:model="address" type="text" class="form-control" id="address" placeholder="Enter your address">
        </div>
        <div class="form-group">
            <label for="street">Street</label>
            <input wire:model="street" type="text" class="form-control" id="street" placeholder="Enter your street">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input wire:model="city" type="text" class="form-control" id="city" placeholder="Enter your city">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input wire:model="password" type="password" class="form-control" id="password" placeholder="Enter your password">
        </div>
        @if(session()->has('errorPass'))
        <div class="alert alert-danger" role="alert">
            {{ session('errorPass') }}
        </div>
        @endif
        @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif
        @if($this->hasChange = true)
        <button type="submit" class="btn btn-primary">Save changes</button>
        @else
        <button type="submit" class="btn btn-primary" disabled>Save changes</button>
        @endif
    </form>
</div>