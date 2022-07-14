<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\HtaccessRedirectGeneratorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class HtaccessRedirectGenerator extends Component
{
    public $domain = 'example.com';
    public $type = 'www';
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.htaccess-redirect-generator');
    }

    public function onHtaccessRedirectGenerator(){

        $this->validate([
            'domain' => 'required',
            'type'   => 'required'
        ]);

        $this->data = null;

        try {

            $output = new HtaccessRedirectGeneratorClass();

            $this->data = $output->get_data( $this->domain, $this->type );

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Htaccess Redirect Generator';
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
