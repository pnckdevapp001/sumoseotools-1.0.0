<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Header as HS;

class Header extends Component
{

	public $logo_light;
    public $logo_dark;
	public $favicon;
	public $sticky_header = true;
	protected $listeners = ['onSetLogoLight', 'onSetLogoDark', 'onSetFavicon'];

    public function mount()
    {
        $hs                  = HS::findOrFail(1);
        $this->logo_light    = $hs->logo_light;
        $this->logo_dark     = $hs->logo_dark;
        $this->favicon       = $hs->favicon;
        $this->sticky_header = $hs->sticky_header;
    }

    public function render()
    {
        return view('livewire.admin.settings.header');
    }

    public function onSetLogoLight($value)
    {
        $this->logo_light = $value;
    }

    public function onSetLogoDark($value)
    {
        $this->logo_dark = $value;
    }

    public function onSetFavicon($value)
    {
        $this->favicon = $value;
    }

    public function onUpdateHeader()
    {
        try {

            $hs                = HS::findOrFail(1);
            $hs->logo_light    = $this->logo_light;
            $hs->logo_dark     = $this->logo_dark;
            $hs->favicon       = $this->favicon;
            $hs->sticky_header = $this->sticky_header;
            $hs->updated_at    = new DateTime();
            $hs->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
