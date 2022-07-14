<?php

namespace App\Http\Livewire\Frontend\AuthPages;

use Livewire\Component;
use App\Models\Admin\AuthPages;

class Login extends Component
{
    public $email;
    public $password;
    public $remember_me;
    public $forgot_password_status;
    public $register_status;

    public function mount()
    {
        $this->forgot_password_status = AuthPages::where('name', 'Forgot Password')->first()->status;
        $this->register_status        = AuthPages::where('name', 'Register')->first()->status;
    }

    public function render()
    {
        return view('livewire.frontend.auth-pages.login');
    }

    public function onLogin()
    {
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {

            return redirect('/');
            
        }
        else {
            $this->addError('401', __('The Email or Password is Incorrect!'));
        }

    }
}
