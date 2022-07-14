<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Http;

class WhatIsMyIpClass {

	public function get_data($ip)
	{
        $response = Http::get('http://ip-api.com/json/'.$ip.'?fields=status,message,country,countryCode,regionName,city,zip,lat,lon,timezone,currency,isp,org,as');

        if ( $response['status'] == 'success' ) {

			$data['country']     = $response['country'];
			$data['countryCode'] = $response['countryCode'];
			$data['regionName']  = $response['regionName'];
			$data['city']        = $response['city'];
			$data['zip']         = $response['zip'];
			$data['lat']         = $response['lat'];
			$data['lon']         = $response['lon'];
			$data['timezone']    = $response['timezone'];
			$data['currency']    = $response['currency'];
			$data['isp']         = $response['isp'];
			$data['as']          = $response['as'];

        } else {

			$data['country']     = 'N/a';
			$data['countryCode'] = 'N/a';
			$data['regionName']  = 'N/a';
			$data['city']        = 'N/a';
			$data['zip']         = 'N/a';
			$data['lat']         = 'N/a';
			$data['lon']         = 'N/a';
			$data['timezone']    = 'N/a';
			$data['currency']    = 'N/a';
			$data['isp']         = 'N/a';
			$data['as']          = 'N/a';
        }

        return $data;

	}
}