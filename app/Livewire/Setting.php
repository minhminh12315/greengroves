<?php

namespace App\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Setting extends Component
{
    use WithFileUploads;
    public $name;
    public $fullname;
    public $email;
    public $phone;
    public $address;
    public $street;
    public $city;
    public $password;
    public $avatar;
    public $hasChange;
    public $new_avatar;

    public $original_fullname;
    public $original_name;
    public $original_email;
    public $original_phone;
    public $original_address;
    public $original_street;
    public $original_city;

    public $showMain=false;

    public function updated($propertyName)
    {
        try {
            $this->validateOnly($propertyName,[
                'new_avatar' => 'image|mimes:jpg,jpeg,png,gif',
            ], [
                'new_avatar.image' => 'The file must be an image (jpg, jpeg, png, gif)',
                'new_avatar.mimes' => 'The file must be a file of type: jpg, jpeg, png, gif',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->reset('new_avatar');
            throw $e;
        }
    }
    public function update_information()
    {
        try{
            
        $user = User::find(auth()->user()->id);
        if ($this->fullname) {
            $user->fullname = $this->fullname;
        }
        if ($this->phone) {
            $user->phone = $this->phone;
        }
        if ($this->address) {
            $user->address = $this->address;
        }
        if ($this->street) {
            $user->street = $this->street;
        }
        if ($this->city) {
            $user->city = $this->city;
        }

        // Chỉ cập nhật avatar nếu có upload mới
        if ($this->new_avatar) {
            $imageName = time() . '_' . $this->new_avatar->getClientOriginalName();
            $imagePath = $this->new_avatar->storeAs('public/assets/images', $imageName);
            $publicPath = 'assets/images/' . $imageName;
            $user->avatar = $publicPath;
        }
        $user->save();
        $this->dispatch('swalsuccess', [
            'title' => 'Congartulation!',
            'text' => 'You have successfully changed your information !',
            'icon' => 'success',
        ]);
        } catch (Exception $e) {
            toast()->error('Something went wrong!');
        }
    }
    public function mount()
    {
        $user = User::find(auth()->user()->id);
        $this->name = $user->name;
        $this->fullname = $user->fullname;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->address = $user->address;
        $this->street = $user->street;
        $this->city = $user->city;
        if ($user->avatar != null) {
            $this->avatar = $user->avatar;
        }
        Log::info($this->avatar);

        $this->original_fullname = $this->fullname;
        $this->original_name = $this->name;
        $this->original_email = $this->email;
        $this->original_phone = $this->phone;
        $this->original_address = $this->address;
        $this->original_street = $this->street;
        $this->original_city = $this->city;
    }
    public function render()
    {
        return view('livewire.setting');
    }
}
