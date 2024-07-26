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
        try {
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

            // Log the validation success
            Log::info('Validation successful', [
                'email' => $this->email,
                'current_password' => $this->current_password,
                'password' => $this->password,
            ]);

            // Check if the email matches the current user's email
            if ($this->email !== Auth::user()->email) {
                $this->addError('email', 'Email does not match the current account.');
                Log::error('Email does not match the current account', [
                    'input_email' => $this->email,
                    'user_email' => Auth::user()->email,
                ]);
                return;
            }

            // Check if the current password is correct
            if (!Hash::check($this->current_password, Auth::user()->password)) {
                $this->addError('current_password', 'The current password is incorrect.');
                Log::error('Current password is incorrect', [
                    'input_password' => $this->current_password,
                ]);
                return;
            }

            // Update the new password
            Auth::user()->update([
                'password' => Hash::make($this->password),
            ]);

            // Log the password update success
            Log::info('Password updated successfully', [
                'user_id' => Auth::user()->id,
            ]);

            // Success message
            $this->dispatch('swalsuccess', [
                'title' => 'Congartulation!',
                'text' => 'Reset Password Successfully !',
                'icon' => 'success',
            ]);
            toast()->success('Reset Password Successfully !');
            session()->flash('message', 'Password has been successfully updated.');
            $this->current_password = '';
            $this->password = '';
            $this->password_confirmation = '';
            $this->email = '';

            // Reset form fields
            $this->reset(['current_password', 'password', 'password_confirmation', 'email']);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error resetting password', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            // Display error message to the user
            $this->addError('general', 'An error occurred while resetting the password. Please try again later.');
        }
    }

    public function render()
    {
        return view('livewire.reset-password');
    }
}
