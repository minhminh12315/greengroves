<?php

namespace App\Livewire;

use App\Models\User;
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
    public function update_information()
    {
        Log::info('update_information');

        $user = User::find(auth()->user()->id);
        $hashedPassword = $user->password; // Lấy hash mật khẩu hiện tại từ cơ sở dữ liệu

        if (Hash::check($this->password, $hashedPassword)) { // Kiểm tra mật khẩu
            if ($this->name) {
                $user->name = $this->name;
            }
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
                $imageName = time() . '_' . $this->avatar->getClientOriginalName();
                $imagePath = $this->avatar->storeAs('public/assets/images', $imageName);
                $publicPath = 'assets/images/' . $imageName;
                $user->avatar = $publicPath;
            }

            $user->save();
            session()->flash('success', 'Information updated successfully');
        } else {
            session()->flash('errorPass', 'Password is incorrect');
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
        if ($user->avatar) {
            $this->avatar = $user->avatar;
        }
        Log::info($this->avatar);
    }
    public function render()
    {
        return view('livewire.setting');
    }
}
