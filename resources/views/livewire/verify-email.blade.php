<div class="container-fluid">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">
            <div class="card shadow">
                <div class="card-body p-4">
                    <h4 class="card-title text-center mb-4">Verify Your Account</h4>
                    <div class="alert alert-info mb-4" role="alert">
                        An OTP has been sent to your email. Enter the code to verify your account.
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-lg mb-3" wire:model="otp" placeholder="Enter OTP" aria-label="OTP">
                        <button class="btn btn-success btn-lg btn-block" type="button" wire:click="verifyMail">Verify</button>
                    </div>

                    @error('otp') 
                        <div class="alert alert-danger mt-3" role="alert">
                            {{ $message }}
                        </div>
                    @enderror

                    @if (session()->has('message'))
                        <div class="alert alert-success mt-3" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>