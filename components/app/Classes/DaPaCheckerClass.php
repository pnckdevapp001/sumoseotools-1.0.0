<?php 

namespace App\Classes;
use App\Classes\SSTClass;
use App\Models\Admin\ApiKeys;

class DaPaCheckerClass {

	public function get_data($link)
	{

        $api_key = ApiKeys::findOrFail(1);

        if ( !empty($api_key->moz_access_id) && !empty($api_key->moz_secret_key) ) {

            try {

                // Get your access id and secret key here: https://moz.com/products/api/keys
                $accessID  = $api_key->moz_access_id;
                $secretKey = $api_key->moz_secret_key;

                // Set your expires times for several minutes into the future.
                // An expires time excessively far in the future will not be honored by the Mozscape API.
                $expires = time() + 300;

                // Put each parameter on a new line.
                $stringToSign = $accessID."\n".$expires;

                // Get the "raw" or binary output of the hmac hash.
                $binarySignature = hash_hmac('sha1', $stringToSign, $secretKey, true);

                // Base64-encode it and then url-encode that.
                $urlSafeSignature = urlencode(base64_encode($binarySignature));

                // Add up all the bit flags you want returned.
                // Learn more here: https://moz.com/help/guides/moz-api/mozscape/api-reference/url-metrics
                $cols = "103079233568";

                $sst = new SSTClass();

                $get_source = $sst->url_get_contents( "http://lsapi.seomoz.com/linkscape/url-metrics/".urlencode($link)."?Cols=".$cols."&AccessID=".$accessID."&Expires=".$expires."&Signature=".$urlSafeSignature );
                
                $deJson = json_decode($get_source, true);

                if ( !empty($deJson) ) {

                    $data['link']             = $link;
                    $data['domain_authority'] = ( $deJson['pda'] ) ? round($deJson['pda']) : 'None';
                    $data['page_authority'] = ( $deJson['upa'] ) ? round($deJson['upa']) : 'None';
                    $data['linking_domains']  = ( $deJson['ueid'] ) ? $sst->formatNumber($deJson['ueid']) : 'None';
                    $data['total_links']      = ( $deJson['uid'] ) ? $sst->formatNumber($deJson['uid']) : 'None';
                }

                return $data;
                
            } catch (\Exception $e) {

                session()->flash('status', 'error');
                session()->flash('message', __($e->getMessage()));
                return;
            }

        } else{

            session()->flash('status', 'error');
            session()->flash('message', 'Invalid API Keys!');
            return;
        }

	}
    //

}