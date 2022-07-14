<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\GoogleIndexCheckerClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class GoogleIndexChecker extends Component
{

    public $link;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.google-index-checker');
    }

    public function onGoogleIndexChecker(){

        $this->validate([
            'link' => 'required|url'
        ]);

        $this->data = null;

        try {

            $output = new GoogleIndexCheckerClass();

            $this->data = $output->get_data( $this->link );

            if ( !empty($this->data) ) {
                
            } else {
                
            }
            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Google Index Checker';
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
    }
    //
}
