<?php

namespace App\Livewire\User;

use App\Mail\FeedbackReceived;
use App\Models\EmailNotification;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Renderless;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Contact extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $email;
    #[Validate('required|min:10')]
    public $phone;
    #[Validate('required')]
    public $message;

    
    public function feedback()
    {
        $this->validate();
        $emailNotification = new EmailNotification();
        $emailNotification->name = $this->name;
        $emailNotification->email = $this->email;
        $emailNotification->phone = $this->phone;
        $emailNotification->message = $this->message;
        $emailNotification->save();
        $this->dispatch('swalsuccess', [
            'title' => 'Thanks!',
            'text' => 'Thank you to feedback us !',
            'icon' => 'success',
        ]);
        Mail::to($this->email)->send(new FeedbackReceived($this->name));
        $this->reset(['name', 'email', 'phone','message']);
    }
    public function render()
    {
        return view('livewire.user.contact');
    }
}
