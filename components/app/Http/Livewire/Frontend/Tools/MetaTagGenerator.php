<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class MetaTagGenerator extends Component
{

    public $title; 
    public $description; 
    public $keywords; 
    public $robots_index = 'index'; 
    public $robots_links = 'follow'; 
    public $content_type = 'text/html; charset=utf-8'; 
    public $language; 
    public $revisit_days; 
    public $author;
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.meta-tag-generator');
    }

    public function onMetaTagGenerator(){

        $this->data = null;

        try {

            $this->data .= ($this->title != "") ? '<meta name="title" content="' . $this->title . '">' . PHP_EOL : null;

            $this->data .= ($this->description != "") ? '<meta name="description" content="' . $this->description . '">' . PHP_EOL : null;

            $this->data .= ($this->keywords != "") ? '<meta name="keywords" content="' . $this->keywords . '">' . PHP_EOL : null;

            $this->data .= '<meta name="robots" content="' . $this->robots_index . ', '.$this->robots_links.'">' . PHP_EOL;

            $this->data .= ($this->content_type != "") ? '<meta http-equiv="Content-Type" content="' . $this->content_type . '">' . PHP_EOL : null;

            $this->data .= ($this->revisit_days != "") ? '<meta name="revisit-after" content="' . $this->revisit_days . '">' . PHP_EOL : null;

            $this->data .= ($this->language != "") ? '<meta name="description" content="' . $this->language . '">' . PHP_EOL : null;

            $this->data .= ($this->author != "") ? '<meta name="author" content="' . $this->author . '">' . PHP_EOL : null;

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Meta Tag Generator';
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
