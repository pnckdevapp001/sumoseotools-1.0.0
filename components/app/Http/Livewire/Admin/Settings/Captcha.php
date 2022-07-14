<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\Captcha as Captchas;
use DateTime;

class Captcha extends Component
{
    public $status;
    public $site_key;
    public $secret_key;

    public function mount()
    {
        $captcha           = Captchas::findOrFail(1);
        $this->status      = $captcha->status;
        $this->site_key  = $captcha->site_key;
        $this->secret_key = $captcha->secret_key;
    }

    public function render()
    {
        return view('livewire.admin.settings.captcha');
    }

    public function onUpdateCaptcha()
    {
        try {

            $captcha             = Captchas::findOrFail(1);
            $captcha->status     = $this->status;
            $captcha->site_key   = $this->site_key;
            $captcha->secret_key = $this->secret_key;
            $captcha->updated_at = new DateTime();
            $captcha->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }
}
