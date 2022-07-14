<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;
use App\Classes\SSTClass;
use Iodev\Whois\Factory as Whois;

class HostingCheckerClass {

	public function get_data($link)
	{
        try {
            
            $domain = str_ireplace("www.", "", parse_url( $link, PHP_URL_HOST));

            $response = Http::get('http://ip-api.com/json/' . $domain);

            //
            $sst = new SSTClass();

            $domain = $sst->get_domain_name($link);

            $whois = Whois::get()->createWhois();

            $info = $whois->loadDomainInfo( $domain );

            if ( !empty($response) && !empty($info) ) {

                $data['link']            = $link;
                $data['domain']          = $domain;
                $data['hosting']         = $response['as'];
                $data['ip']              = $response['query'];
                $data['creation_date']   = ( $info->creationDate ) ? $info->creationDate : 0;
                $data['updated_date']    = ( $info->updatedDate ) ? $info->updatedDate : 0;
                $data['expiration_date'] = ( $info->expirationDate ) ? $info->expirationDate : 0;
                $data['registrar']       = $info->registrar;

                return $data;
                
            } else{
                session()->flash('status', 'error');
                session()->flash('message', __( 'Whoops! Something went wrong.'));
                return;
            }
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()) );
            return;
        }

	}
    //

}