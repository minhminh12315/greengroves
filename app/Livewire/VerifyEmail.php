<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerifyEmail extends Component
{
    public $otp;
    public $userId;

    public function mount($id)
    {
        $this->userId = $id;
    }

    public function verifyMail()
    {
        $user = User::find($this->userId);

        if ($user->otp === $this->otp) {
            $user->status = 'active';
            $user->save();
            Auth::login($user);
            $this->dispatch('notify', 'Email verified successfully!');
            return redirect()->route('users.home');
        } else {
            $this->addError('otp', 'Invalid OTP. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.verify-email');
    }
}