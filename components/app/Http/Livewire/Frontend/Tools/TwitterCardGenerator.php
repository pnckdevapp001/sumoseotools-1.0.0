<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class TwitterCardGenerator extends Component
{

    public $title;
    public $site_username = '@';
    public $app_name;
    public $iphone_app_id;
    public $ipad_app_id;
    public $google_play_app_id;
    public $app_country;
    public $type          = 'app';
    public $description;

    public $data   = [];
    public $inputs = [];
    public $images = [];
    public $i      = 1;

    public function render()
    {
        return view('livewire.frontend.tools.twitter-card-generator');
    }

    public function onAddImage($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);

    }

    public function onDeleteImage($i)
    {
        unset($this->inputs[$i]);
    }

    public function onTwitterCardGenerator(){

        $this->data = null;

        try {

            $this->data .= ($this->type != "") ? '<meta name="twitter:card" content="' . $this->type . '">' . PHP_EOL : null;

            $this->data .= ($this->site_username != "") ? '<meta name="twitter:site" content="' . $this->site_username . '">' . PHP_EOL : null;

            $this->data .= ($this->description != "") ? '<meta name="twitter:description" content="' . $this->description . '">' . PHP_EOL : null;

            $this->data .= ($this->app_name != "") ? '<meta name="twitter:app:name:iphone" content="' . $this->app_name . '">' . PHP_EOL . '<meta name="twitter:app:name:ipad" content="' . $this->app_name . '">' . PHP_EOL . '<meta name="twitter:app:name:googleplay" content="' . $this->app_name . '">' . PHP_EOL : null;

            $this->data .= ($this->iphone_app_id != "") ? '<meta name="twitter:app:id:iphone" content="' . $this->iphone_app_id . '">' . PHP_EOL : null;

            $this->data .= ($this->ipad_app_id != "") ? '<meta name="twitter:app:id:ipad" content="' . $this->ipad_app_id . '">' . PHP_EOL : null;

            $this->data .= ($this->google_play_app_id != "") ? '<meta name="twitter:app:id:googleplay" content="' . $this->google_play_app_id . '">' . PHP_EOL : null;

            $this->data .= ($this->app_country != "") ? '<meta name="twitter:app:country" content="' . $this->app_country . '">' . PHP_EOL : null;

            if ( $this->images != null) {

                foreach ($this->images as $key => $value) {

                    $this->data .= '<meta name="twitter:image" content="'.$value.'">' . PHP_EOL;
                }

            }
            $this->render();
        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Twitter Card Generator';
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
