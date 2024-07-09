<?php

namespace App\Livewire;

use App\Mail\FeedbackReceived;
use App\Mail\SendOtp;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Renderless;
use Illuminate\Support\Str;


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
    public $otp;

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
        $this->otp = Str::random(6);

        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->otp = $this->otp;
        $user->save();
        $userId = $user->id;
        Auth::login($user);

        Mail::to($this->email)->send(new SendOtp($this->otp));

        $this->reset(['name', 'email', 'password', 'password_confirmation', 'otp']);

        session()->flash('success', 'Register Successfully!');

        return redirect()->route('verify_mail', $userId);
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
