<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\KeywordDensityCheckerClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class KeywordDensityChecker extends Component
{

    public $link;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.keyword-density-checker');
    }

    public function onKeywordDensityChecker(){

        $this->validate([
            'link' => 'required|url'
        ]);

        $this->data = null;

        try {

            $output = new KeywordDensityCheckerClass();

            $output->domain =  $this->link;

            $resdata = $output->get_data(); 

            if ( $resdata ) {

                $this->data['total'] = count($resdata);

                $i = 0;

                foreach ($resdata as $value) {

                    if( !empty( $value['keyword'] ) ){
                        $this->data['keywords'][$i]['keyword'] = $value['keyword'];
                        $this->data['keywords'][$i]['count']   = $value['count'];
                        $this->data['keywords'][$i]['percent'] = $value['percent'];
                        $i++;
                    }
                }

            } else $this->addError('error', __('Invalid request!'));


        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Keyword Density Checker';
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
