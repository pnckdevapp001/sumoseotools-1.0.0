<?php

namespace App\Http\Livewire\Frontend\AuthPages;

use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Artisan;

class ResetPassword extends Component
{

    public $email;
    public $password;
    public $password_confirmation;
    public $token;

    public function render()
    {
        return view('livewire.frontend.auth-pages.reset-password');
    }

    public function onResetPassword()
    {
        $this->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|required_with:password_confirmation|same:password_confirmation',
        ]);

        try {

            $status = Password::reset([
                    'email'                 => $this->email,
                    'password'              => $this->password,
                    'password_confirmation' => $this->password_confirmation,
                    'token'                 => $this->token
                ],
                function ($user, $password) {
                    $user->forceFill([
                        'password' => Hash::make($password)
                    ])->setRememberToken(Str::random(60));

                    $user->save();

                    event(new PasswordReset($user));
                }
            );

            if ( $status === Password::PASSWORD_RESET ) {

                session()->flash('status', 'success');
                session()->flash('message', __( $status ));
                Artisan::call('auth:clear-resets');

            } else $this->addError('401', __( $status ));

        } catch (\Exception $e) {
            session()->flash('status', 'error');
            session()->flash('message', __('Unable to update new password.'));
        }
    }

}
