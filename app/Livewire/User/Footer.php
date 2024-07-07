<?php

namespace App\Livewire\User;

use Livewire\Attributes\Validate;
use App\Models\EmailNotification;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;


class Footer extends Component
{
    #[Validate('required|min:5|email')]
    public $emailNotificationToSend;

    public function subcribe()
    {
        $this->validate();

        $emailNotification = new EmailNotification();
        $emailNotification->email = $this->pull('emailNotificationToSend');
        $emailNotification->save();

        $this->dispatch('swalsuccess', [
            'title' => 'Subscribed!',
            'text' => 'You have successfully subscribed to our newsletter.',
            'icon' => 'success',
        ]);

    }
    public function render()
    {
        return view('livewire.user.footer');
    }
}
