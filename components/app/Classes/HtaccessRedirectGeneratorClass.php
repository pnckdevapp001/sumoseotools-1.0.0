<?php 

namespace App\Classes;
use App\Classes\SSTClass;

class HtaccessRedirectGeneratorClass {

	public function get_data($domain, $type)
	{
        try {

            $sst = new SSTClass();

            $domain = $sst->get_domain_name($domain);

            switch ( $type ) {

                case 'nonwww':
                         $data['code'] = 'RewriteEngine On
RewriteCond %{HTTP_HOST} ^www.'.$domain.' [NC]
RewriteRule ^(.*)$ https://'.$domain.'/$1 [L,R=301]';
                    break;
                
                default:
                         $data['code'] = 'RewriteEngine On
RewriteCond %{HTTP_HOST} ^'.$domain.' [NC]
RewriteRule ^(.*)$ https://www.'.$domain.'/$1 [L,R=301]';
                    break;
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