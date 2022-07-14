<?php

namespace App\Http\Livewire\Frontend\Tools;

use Livewire\Component;
use App\Models\Admin\History;
use Illuminate\Support\Facades\Http;
use App\Classes\CreditCardValidatorClass;
use DateTime;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

class CreditCardValidator extends Component
{

    public $type = 'visa';
    public $code;
    public $data = [];

    public function render()
    {
         return view('livewire.frontend.tools.credit-card-validator');
    }

    public function onCreditCardValidator(){

        $this->validate([
            'code' => 'required'
        ]);

        try {

            $output = new CreditCardValidatorClass();

            switch ($this->type) {
                case 'amex':
                        if ( $output->Validator( $this->code )['type'] == 'amex') {

                            session()->flash('status', 'success');
                            session()->flash('message', __( 'Credit card number is Valid' ));
                            return;

                        } else {

                            session()->flash('status', 'error');
                            session()->flash('message', __( 'Credit card number is Invalid.' ));
                            return;

                        }
                    break;

                case 'diners':
                        if ( $output->Validator( $this->code )['type'] == 'diners') {

                            session()->flash('status', 'success');
                            session()->flash('message', __( 'Credit card number is Valid' ));
                            return;

                        } else {

                            session()->flash('status', 'error');
                            session()->flash('message', __( 'Credit card number is Invalid.' ));
                            return;

                        }
                    break;

                case 'discover':
                        if ( $output->Validator( $this->code )['type'] == 'discover') {

                            session()->flash('status', 'success');
                            session()->flash('message', __( 'Credit card number is Valid' ));
                            return;

                        } else {

                            session()->flash('status', 'error');
                            session()->flash('message', __( 'Credit card number is Invalid.' ));
                            return;

                        }
                    break;

                case 'jcb':
                        if ( $output->Validator( $this->code )['type'] == 'jcb') {

                            session()->flash('status', 'success');
                            session()->flash('message', __( 'Credit card number is Valid' ));
                            return;

                        } else {

                            session()->flash('status', 'error');
                            session()->flash('message', __( 'Credit card number is Invalid.' ));
                            return;

                        }
                    break;

                case 'mastercard':
                        if ( $output->Validator( $this->code )['type'] == 'mastercard') {

                            session()->flash('status', 'success');
                            session()->flash('message', __( 'Credit card number is Valid' ));
                            return;

                        } else {

                            session()->flash('status', 'error');
                            session()->flash('message', __( 'Credit card number is Invalid.' ));
                            return;

                        }
                    break;

                default:
                        if ( $output->Validator( $this->code )['type'] == 'visa') {

                            session()->flash('status', 'success');
                            session()->flash('message', __( 'Credit card number is Valid' ));
                            return;

                        } else {

                            session()->flash('status', 'error');
                            session()->flash('message', __( 'Credit card number is Invalid.' ));
                            return;

                        }
                    break;
            }

            

        } catch (\Exception $e) {

            $this->addError('error', __($e->getMessage()));
        }

        //Save History
        $history             = new History;
        $history->tool_name  = 'Credit Card Validator';
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
