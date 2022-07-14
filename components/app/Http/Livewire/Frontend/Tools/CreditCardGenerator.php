<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\CreditCardGeneratorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class CreditCardGenerator extends Component
{

    public $type = 'visa';
    public $data = [];

    public function render()
    {
        return view('livewire.frontend.tools.credit-card-generator');
    }

    public function onCreditCardGenerator(){

        $this->data = null;

        try {

            $output = new CreditCardGeneratorClass();

            switch ($this->type) {
                case 'amex':
                        $this->data['code'] = $output->get_amex();
                    break;

                case 'diners':
                        $this->data['code'] = $output->get_diners();
                    break;

                case 'discover':
                        $this->data['code'] = $output->get_discover();
                    break;

                case 'jcb':
                        $this->data['code'] = $output->get_jcb();
                    break;

                case 'mastercard':
                        $this->data['code'] = $output->get_mastercard();
                    break;

                default:
                        $this->data['code'] = $output->get_visa();
                    break;
            }

            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        if ( !empty($this->data) ) {

            $history             = new History;
            $history->tool_name  = 'Credit Card Generator';
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
