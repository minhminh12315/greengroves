<?php

namespace App\Livewire\Admin;

use App\Models\EmailNotification;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class FeedBack extends Component
{
    public $feed_backs;
    public function mount()
    {
        $this->feed_backs = EmailNotification::all();
        Log::info('Feed Backs', ['feed_backs' => $this->feed_backs]);
    }
    public function render()
    {
        return view('livewire.admin.feed-back');
    }
}
