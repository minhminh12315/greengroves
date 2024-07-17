<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Image;

class About extends Component
{
    public $section_1;
    public $section_2;
    public $section_3;
    public $section_4;
    public $section_5;

    public function mount()
    {
        $this->section_1 = Image::where('type', 'About')
                                      ->where('description', 'About_section_1')
                                      ->pluck('path')
                                      ->toArray();

        $this->section_2 = Image::where('type', 'About')
                                      ->where('description', 'About_section_2')
                                      ->pluck('path')
                                      ->toArray();

        $this->section_3 = Image::where('type', 'About')
                                      ->where('description', 'About_section_3')
                                      ->pluck('path')
                                      ->toArray();

        $this->section_4 = Image::where('type', 'About')
                                      ->where('description', 'About_section_4')
                                      ->pluck('path')
                                      ->toArray();

    }

    public function render()
    {
        return view('livewire.user.about', [
            'section_1' => $this->section_1,
            'section_2'=> $this->section_2,
            'section_3'=>$this->section_3,
            'section_4'=>$this->section_4,
            'section_5'=>$this->section_5,
        ]);
    }
}
