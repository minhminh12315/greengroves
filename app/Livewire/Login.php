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
use Illuminate\Validation\ValidationException;

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


    public function render()
    {
        return view('livewire.login');
    }
    public function updated()
    {
        $this->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'login_username' => 'required',
            'login_password' => 'required',
        ], [
            'name.required' => 'Username is required!',
            'name.unique' => 'Username already exists!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email already exists!',
            'email.email' => 'Email is invalid!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password must be at least 6 characters!',
            'password_confirmation.required' => 'Confirm Password is required!',
            'password_confirmation.min' => 'Confirm Password must be at least 6 characters!',
            'password_confirmation.same' => 'Password does not match!',
            'login_username.required' => 'Username is required!',
            'login_password.required' => 'Password is required!',
        ]);
    }
    #[Renderless]
    public function register()
    {
        $this->validate([
            'name' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ], [
            'name.required' => 'Username is required!',
            'name.unique' => 'Username already exists!',
            'email.required' => 'Email is required!',
            'email.unique' => 'Email already exists!',
            'email.email' => 'Email is invalid!',
            'password.required' => 'Password is required!',
            'password.min' => 'Password must be at least 6 characters!',
            'password_confirmation.required' => 'Confirm Password is required!',
            'password_confirmation.min' => 'Confirm Password must be at least 6 characters!',
            'password_confirmation.same' => 'Password does not match!',
        ]);
        try {
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
        } catch (\Exception $e) {
            session()->flash('error', 'Registration failed. Please try again later.');
            Log::error('Registration failed: ' . $e->getMessage());
            return back();
        }
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
        $user = User::where('name', $this->login_username)->first();

        if (Auth::attempt($credentials, $this->rememberMe)) {
            if (Auth::user()->status == 'inactive') {
                Auth::logout();
                return redirect()->route('verify_mail', $user->id);
            } else {
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.index');
                }
                return redirect()->intended('/');
            }
        } else {
            $this->addError('login_failed', 'Invalid username or password. Please try again!');
            $this->login_password = '';
        }
    }
}
