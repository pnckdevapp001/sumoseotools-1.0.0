<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use App\Classes\PageAuthorityCheckerClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class PageAuthorityChecker extends Component
{

    public $link;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.page-authority-checker');
    }

    public function onPageAuthorityChecker(){

        $this->validate([
            'link' => 'required|url'
        ]);

        $this->data = null;

        try {

            $output = new PageAuthorityCheckerClass();

            $this->data = $output->get_data( $this->link );

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Page Authority Checker';
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
