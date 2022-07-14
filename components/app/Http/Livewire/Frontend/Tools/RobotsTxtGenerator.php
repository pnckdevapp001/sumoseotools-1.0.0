<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\RobotsTxtGeneratorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class RobotsTxtGenerator extends Component
{

    public $link;
    public $data          = [];
    public $inputs        = [];
    public $folders       = [];
    public $i             = 1;

    public $all_robots    = " ";
    public $delay         = null;
    public $sitemap       = null;
    public $google        = null;
    public $google_image  = null;
    public $google_mobile = null;
    public $msn_search    = null;
    public $yahoo         = null;
    public $yahoo_mm      = null;
    public $yahoo_blogs   = null;
    public $ask_teoma     = null;
    public $gigablast     = null;
    public $dmoz_checker  = null;
    public $nutch         = null;
    public $alexa         = null;
    public $baidu         = null;
    public $naver         = null;
    public $msb_picpearch = null;

    public function render()
    {
        return view('livewire.frontend.tools.robots-txt-generator');
    }

    public function onAddFolder($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);

    }

    public function onDeleteFolder($i)
    {
        unset($this->inputs[$i]);
    }

    public function onRobotsTxtGenerator(){

        $this->data = null;

        try {

            $this->data .= 'User-agent: *' . PHP_EOL . 'Disallow:' . $this->all_robots . PHP_EOL;

            $this->data .= ($this->delay != "") ? 'Crawl-delay: ' . $this->delay . PHP_EOL : null;

            $this->data .= ($this->sitemap != "") ? 'Sitemap: ' .  $this->sitemap . PHP_EOL : null;

            $this->data .= ($this->google != "") ? 'User-agent: Googlebot' . PHP_EOL . 'Disallow:' . $this->google . PHP_EOL : null;

            $this->data .= ($this->google_image != "") ? 'User-agent: googlebot-image' . PHP_EOL . 'Disallow:' . $this->google_image . PHP_EOL : null;

            $this->data .= ($this->google_mobile != "") ? 'User-agent: googlebot-mobile' . PHP_EOL . 'Disallow:' . $this->google_mobile . PHP_EOL : null;

            $this->data .= ($this->msn_search != "") ? 'User-agent: MSNBot' . PHP_EOL . 'Disallow:' . $this->msn_search . PHP_EOL : null;

            $this->data .= ($this->yahoo != "") ? 'User-agent: Slurp' . PHP_EOL . 'Disallow:' . $this->yahoo . PHP_EOL : null;

            $this->data .= ($this->yahoo_mm != "") ? 'User-agent: yahoo-mmcrawler' . PHP_EOL . 'Disallow:' . $this->yahoo_mm . PHP_EOL : null;

            $this->data .= ($this->yahoo_blogs != "") ? 'User-agent:  yahoo-blogs/v3.9' . PHP_EOL . 'Disallow:' . $this->yahoo_blogs . PHP_EOL : null;

            $this->data .= ($this->ask_teoma != "") ? 'User-agent: Teoma' . PHP_EOL . 'Disallow:' . $this->ask_teoma . PHP_EOL : null;

            $this->data .= ($this->gigablast != "") ? 'User-agent: Gigabot' . PHP_EOL . 'Disallow:' . $this->gigablast . PHP_EOL : null;

            $this->data .= ($this->dmoz_checker != "") ? 'User-agent: Robozilla' . PHP_EOL . 'Disallow:' . $this->dmoz_checker . PHP_EOL : null;

            $this->data .= ($this->nutch != "") ? 'User-agent: Nutch' . PHP_EOL . 'Disallow:' . $this->nutch . PHP_EOL : null;

            $this->data .= ($this->alexa != "") ? 'User-agent: ia_archiver' . PHP_EOL . 'Disallow:' . $this->alexa . PHP_EOL : null;

            $this->data .= ($this->baidu != "") ? 'User-agent: baiduspider' . PHP_EOL . 'Disallow:' . $this->baidu . PHP_EOL : null;

            $this->data .= ($this->naver != "") ? 'User-agent: naverbot' . PHP_EOL . 'User-agent: yeti' . PHP_EOL . 'Disallow:' . $this->naver . PHP_EOL : null;

            $this->data .= ($this->msb_picpearch != "") ? 'User-agent: psbot' . PHP_EOL . 'Disallow:' . $this->msb_picpearch . PHP_EOL : null;

            if ( $this->folders != null) {

                foreach ($this->folders as $key => $value) {

                    $this->data .= 'Disallow: ' . $value . PHP_EOL;
                }

            }


        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Robots.txt Generator';
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
    //
}
