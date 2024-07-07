<?php

namespace App\Livewire\User;

use App\Models\Image;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class About extends Component
{
    public $about_firstline_image;
    public function mount()
    {
        $this->about_firstline_image = Image::where('type', 'about line 1 6 anh')->pluck('path')->toArray();
        Log::info($this->about_firstline_image);
    }

    public function render()
    {
        return view('livewire.user.about');
    }
}
