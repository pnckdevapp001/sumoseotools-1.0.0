<?php 

namespace App\Classes;
use App\Classes\SSTClass;
use Iodev\Whois\Factory as Whois;

class DomainAgeCheckerClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();

            $domain = $sst->get_domain_name($link);

            $whois = Whois::get()->createWhois();

            $response = $whois->loadDomainInfo( $domain );
            // dd($response->updatedDate);
            if ( $response ) {
                    $data['domain_name']     = $domain;
                    $data['age']             = $sst->convert_to_age($response->creationDate);
                    $data['creation_date']   = $response->creationDate ?? 0;
                    $data['updated_date']    = $response->updatedDate ?? 0;
                    $data['expiration_date'] = $response->expirationDate ?? 0;
            } else {
                
                session()->flash('status', 'error');
                session()->flash('message', __( 'Invalid domain name. Please check again!' ));
                return;
            }

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}
    //

}