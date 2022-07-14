<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class AuthPages extends Component
{

    public $email;
    public $token;
    public $fullname;

    public $page;
    public $homeTitle;
    public $general;
    public $profile;
    public $menus;
    public $header;
    public $footer;
    public $captcha;
    public $notice;
    public $advanced;
    public $advertisement;
    public $socials;
    public $twitter;

    public function mount()
    {
        $page            = $this->page;
        $homeTitle       = $this->homeTitle;
        $general         = $this->general;
        $profile         = $this->profile;
        $menus           = $this->menus;
        $header          = $this->header;
        $footer          = $this->footer;
        $captcha         = $this->captcha;
        $notice          = $this->notice;
        $advanced        = $this->advanced;
        $advertisement   = $this->advertisement;
        $socials         = $this->socials;
        $twitter         = $this->twitter;
        $this->token     = request()->route('token');
        $this->email     = old('email', request()->email);
        $this->fullname  = auth()->user()->fullname ?? null;
    }
    
    public function render()
    {
        return view('livewire.frontend.auth-pages');
    }
}
