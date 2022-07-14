<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class ScreenResolutionSimulator extends Component
{
    public $link;
    public $data       = [];
    public $resolution = '160x160';

    public function render()
    {
        return view('livewire.frontend.tools.screen-resolution-simulator');
    }

    public function onScreenResolutionSimulator(){

        $this->validate([
            'link' => 'required|url'
        ]);

        $this->data = null;

        $resolution = explode('x', $this->resolution);

        try {

            $this->dispatchBrowserEvent('onSetScreenResolution', ['link' => $this->link, 'resolution' => $this->resolution, 'width' => $resolution[0], 'height' => $resolution[1]]);

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Screen Resolution Simulator';
        $history->client_ip  = request()->ip();

        require app_path('Classes/geoip2.phar');

        $reader = new Reader( app_path('Classes/GeoLite2-City.mmdb') );

        try {

            $record           = $reader->city( request()->ip() );

            $history->flag    = strtolower( $record->country->isoCode );
            
            $history->country = strip_tags( $record->country->name );

        } catch (AddressNotFoundException $e) {

        }

        $history->created_at = new DateTime();
        $history->save();
    }
    //
}
