<?php 

namespace App\Classes;
use App\Classes\SSTClass;
use Iodev\Whois\Factory as Whois;

class WhoisDomainLookupClass {

	public function get_data($link)
	{
        try {

            $sst = new SSTClass();

            $domain = $sst->get_domain_name($link);

            $whois = Whois::get()->createWhois();

            $response = $whois->loadDomainInfo( $domain );

            if ($response) {
                
                $data['domainName']     = $response->domainName;
                $data['whoisServer']    = $response->whoisServer;
                $data['nameServers']    = $response->nameServers;
                $data['dnssec']         = $response->dnssec;
                $data['creationDate']   = ( $response->creationDate ) ? $response->creationDate : 0;
                $data['expirationDate'] = ( $response->expirationDate ) ? $response->expirationDate : 0;
                $data['updatedDate']    = ( $response->updatedDate ) ? $response->updatedDate : 0;
                $data['owner']          = $response->owner;
                $data['registrar']      = $response->registrar;
                $data['states']         = $response->states;

                return $data;

            } else {
                
                session()->flash('status', 'error');
                session()->flash('message', __( 'Invalid domain name. Please check again!' ));
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