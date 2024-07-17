<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class ResetPassword extends Component
{
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;

    public function reset_pass()
    {
        $this->validate([
            'email' => 'required|email',
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'The email must be a valid email address.',
            'current_password.required' => 'Current password is required.',
            'password.required' => 'New password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);
        
    
            // Check if the email matches the current user's email
            if ($this->email !== Auth::user()->email) {
                $this->addError('email', 'Email does not match the current account.');
                return;
            }
    
            // Check if the current password is correct
            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $this->addError('current_password', 'The current password is incorrect.');
                return;
            }
    
            // Update the new password
            Auth::user()->update([
                'password' => Hash::make($this->password),
            ]);
    
            // Success message
            session()->flash('message', 'Password has been successfully updated.');
    
            // Reset form fields
            $this->reset(['current_password', 'password', 'password_confirmation']);
    }
    public function render()
    {
        return view('livewire.reset-password');
    }
}
