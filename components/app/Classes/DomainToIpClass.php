<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;

class DomainToIpClass {

    public function get_data($link)
    {
        try {
            
            $domain = str_ireplace("www.", "", parse_url( $link, PHP_URL_HOST));

            $response = Http::get('http://ip-api.com/json/' . $domain);

            if ( !empty($response) ) {

                $data['domain']  = $link;
                $data['ip']      = $response['query'];
                $data['country'] = $response['countryCode'];
                $data['isp']     = $response['isp'];

                return $data;
                
            } else{
                session()->flash('status', 'error');
                session()->flash('message', __( 'Whoops! Something went wrong.'));
                return;
            }
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

    }

}