<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Attributes\Renderless;

class Login extends Component
{
    public $name;
    public $password;
    public $email;
    public $password_confirmation;
    public $login_username;
    public $login_password;
    public $rememberMe = false;
    public $verification_code;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|unique:users',
            'email' => 'required|email|regex:/(.*)@(gmail|protonmail)\.com/i|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ];
    }

    protected $validationAttributes = [
        'login_username' => 'name',
        'login_password' => 'password',
    ];

    public function render()
    {
        return view('livewire.login');
    }
    #[Renderless]
    public function register()
    {
        // $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        Auth::login($user);
        $this->reset(['name', 'email', 'password', 'password_confirmation']);

        session()->flash('success', 'Register Successfully!');

        return redirect()->route('verification.notice');
    }

    public function login()
    {
        $this->validate([
            'login_username' => 'required',
            'login_password' => 'required',
        ]);

        $credentials = [
            'name' => $this->login_username,
            'password' => $this->login_password,
        ];

        if (Auth::attempt($credentials, $this->rememberMe)) {
            return redirect()->intended('/');
        } else {
            $this->addError('login_failed', 'Invalid username or password. Please try again!');
            $this->login_password = '';
        }
    }
    
}
