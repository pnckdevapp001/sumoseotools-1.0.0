<?php 

namespace App\Classes;
use App\Models\Admin\Proxy;
use DOMDocument;

class SSTClass {

    public $STATUS_CODES = array(
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing', // WebDAV; RFC 2518
        103 => 'Early Hints', // RFC 8297
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information', // since HTTP/1.1
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content', // RFC 7233
        207 => 'Multi-Status', // WebDAV; RFC 4918
        208 => 'Already Reported', // WebDAV; RFC 5842
        226 => 'IM Used', // RFC 3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // Previously "Moved temporarily"
        303 => 'See Other', // since HTTP/1.1
        304 => 'Not Modified', // RFC 7232
        305 => 'Use Proxy', // since HTTP/1.1
        306 => 'Switch Proxy',
        307 => 'Temporary Redirect', // since HTTP/1.1
        308 => 'Permanent Redirect', // RFC 7538
        400 => 'Bad Request',
        401 => 'Unauthorized', // RFC 7235
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required', // RFC 7235
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed', // RFC 7232
        413 => 'Payload Too Large', // RFC 7231
        414 => 'URI Too Long', // RFC 7231
        415 => 'Unsupported Media Type', // RFC 7231
        416 => 'Range Not Satisfiable', // RFC 7233
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot', // RFC 2324, RFC 7168
        421 => 'Misdirected Request', // RFC 7540
        422 => 'Unprocessable Entity', // WebDAV; RFC 4918
        423 => 'Locked', // WebDAV; RFC 4918
        424 => 'Failed Dependency', // WebDAV; RFC 4918
        425 => 'Too Early', // RFC 8470
        426 => 'Upgrade Required',
        428 => 'Precondition Required', // RFC 6585
        429 => 'Too Many Requests', // RFC 6585
        431 => 'Request Header Fields Too Large', // RFC 6585
        451 => 'Unavailable For Legal Reasons', // RFC 7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates', // RFC 2295
        507 => 'Insufficient Storage', // WebDAV; RFC 4918
        508 => 'Loop Detected', // WebDAV; RFC 5842
        510 => 'Not Extended', // RFC 2774
        511 => 'Network Authentication Required', // RFC 6585
        103 => 'Checkpoint',
        218 => 'This is fine', // Apache Web Server
        419 => 'Page Expired', // Laravel Framework
        420 => 'Method Failure', // Spring Framework
        420 => 'Enhance Your Calm', // Twitter
        430 => 'Request Header Fields Too Large', // Shopify
        450 => 'Blocked by Windows Parental Controls', // Microsoft
        498 => 'Invalid Token', // Esri
        499 => 'Token Required', // Esri
        509 => 'Bandwidth Limit Exceeded', // Apache Web Server/cPanel
        526 => 'Invalid SSL Certificate', // Cloudflare and Cloud Foundry's gorouter
        529 => 'Site is overloaded', // Qualys in the SSLLabs
        530 => 'Site is frozen', // Pantheon web platform
        598 => 'Network read timeout error', // Informal convention
        440 => 'Login Time-out', // IIS
        449 => 'Retry With', // IIS
        451 => 'Redirect', // IIS
        444 => 'No Response', // nginx
        494 => 'Request header too large', // nginx
        495 => 'SSL Certificate Error', // nginx
        496 => 'SSL Certificate Required', // nginx
        497 => 'HTTP Request Sent to HTTPS Port', // nginx
        499 => 'Client Closed Request', // nginx
        520 => 'Web Server Returned an Unknown Error', // Cloudflare
        521 => 'Web Server Is Down', // Cloudflare
        522 => 'Connection Timed Out', // Cloudflare
        523 => 'Origin Is Unreachable', // Cloudflare
        524 => 'A Timeout Occurred', // Cloudflare
        525 => 'SSL Handshake Failed', // Cloudflare
        526 => 'Invalid SSL Certificate', // Cloudflare
        527 => 'Railgun Error', // Cloudflare
    );

    /**
     * -------------------------------------------------------------------------------
     *  formatNumber
     * -------------------------------------------------------------------------------
    **/
    function formatNumber($count, $precision = 2) {
        if ($count < 1000000) {
            // Anything less than a million
            $n_format = number_format($count / 1000) . 'K';
        } else if ($count < 1000000000) {
            // Anything less than a billion
            $n_format = number_format($count / 1000000, $precision) . 'M';
        } else {
            // At least a billion
            $n_format = number_format($count / 1000000000, $precision) . 'B';
        }
        return $n_format;
    }

    /**
     * -------------------------------------------------------------------------------
     *  url_get_contents
     * -------------------------------------------------------------------------------
    **/
    function url_get_contents($url)
    {
        $process = curl_init($url); 
        curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'); 
        curl_setopt($process, CURLOPT_TIMEOUT, 60); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($process, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($process, CURLOPT_PROXYTYPE, $this->get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($process, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($process, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    /**
     * -------------------------------------------------------------------------------
     *  wp_post_contents
     * -------------------------------------------------------------------------------
    **/
    function wp_post_contents($url, $data) {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');
        curl_setopt($process, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
            'referer: https://whatwpthemeisthat.com/'
        ));
        curl_setopt($process, CURLOPT_TIMEOUT, 60);
        curl_setopt($process, CURLOPT_POST, TRUE);
        curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($process, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($process, CURLOPT_PROXYTYPE, $this->get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($process, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($process, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy

        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    /**
     * -------------------------------------------------------------------------------
     *  url_get_headers
     * -------------------------------------------------------------------------------
    **/
    function url_get_headers($url)
    {
            $ch = curl_init();

              curl_setopt($ch, CURLOPT_URL, $url);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_HEADER, 1);

              $response = curl_exec($ch);
              
              // Retudn headers seperatly from the Response Body
              $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
              $headers = substr($response, 0, $header_size);
              $body = substr($response, $header_size);
              
            curl_close($ch);

            return $headers;
    }

    /**
     * -------------------------------------------------------------------------------
     *  get_proxy_type
     * -------------------------------------------------------------------------------
    **/
    function get_proxy_type($type)
    {
        switch ($type) {
            case 'https':
                $type = CURLPROTO_HTTPS;
                break;
            case 'socks4':
                $type = CURLPROXY_SOCKS4;
                break;
            case 'socks5':
                $type = CURLPROXY_SOCKS5;
                break;
            default:
                $type = CURLPROXY_HTTP;
                break;
        }
        return $type;
    }

    /**
     * -------------------------------------------------------------------------------
     *  get_domain_name
     * -------------------------------------------------------------------------------
    **/
    function get_domain_name($url) { 

       $parseUrl = parse_url(trim($url));

       if(isset($parseUrl['host']))
       {
           $host = $parseUrl['host'];
       }
       else
       {
            $path = explode('/', $parseUrl['path']);
            $host = $path[0];
       }
       
       $host = str_ireplace("www.", "", $host);
       
       return trim($host); 
    }

    /**
     * -------------------------------------------------------------------------------
     *  get_index_status
     * -------------------------------------------------------------------------------
    **/
    function get_index_status($url) {
        $url = 'https://webcache.googleusercontent.com/search?q=cache:' . urlencode($url);
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch, CURLOPT_NOBODY, false);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1) ;
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json; charset=UTF-8"
        )) ;
        //curl_setopt($ch, CURLOPT_USERAGENT, 'Chrome 10');
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return $code;
    }

    /**
     * -------------------------------------------------------------------------------
     *  url_get_status
     * -------------------------------------------------------------------------------
    **/
    function url_get_status($url)
    {
        $process = curl_init($url);
        curl_setopt($process, CURLOPT_TIMEOUT,30);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($process);
        $http_code = curl_getinfo($process, CURLINFO_HTTP_CODE);
        curl_close($process);
        return $http_code;
    }

    /**
     * -------------------------------------------------------------------------------
     *  convert_to_age
     * -------------------------------------------------------------------------------
    **/
    function convert_to_age($value){
        date_default_timezone_set('UTC');
        $time  = time() - $value;
        $years = floor($time / 31556926);
        $days  = floor(($time % 31556926) / 86400);
        if ($years == "1") {
            $y = "1 year";
        } else {
            $y = $years . " years";
        }
        if ($days == "1") {
            $d = "1 day";
        } else {
            $d = $days . " days";
        }
        return "$y, $d";
    }

    /**
     * -------------------------------------------------------------------------------
     *  query_whois_server
     * -------------------------------------------------------------------------------
    **/
    function query_whois_server($whoisserver, $domain)
    {
        $port    = 43;
        $timeout = 10;
        $fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
        //if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
        fputs($fp, $domain . "\r\n");
        $out = "";
        while (!feof($fp)) {
            $out .= fgets($fp);
        }
        fclose($fp);
        
        $res = "";
        if ((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
            $rows = explode("\n", $out);
            foreach ($rows as $row) {
                $row = trim($row);
                if (($row != '') && ($row[0] != '#') && ($row[0] != '%')) {
                    $res .= $row . "\n";
                }
            }
        }
        return $res;
    }

    /**
     * -------------------------------------------------------------------------------
     *  get_meta_tags
     * -------------------------------------------------------------------------------
    **/
    function get_meta_tags($url, $tags = array ('description', 'keywords'), $timeout = 10) {
        
        $html = $this->url_get_contents($url, $timeout);
        if (!$html) {
            return false;
        }

        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $nodes = $doc->getElementsByTagName('title');

        // Get and display what you need:
        
        $ary = [];
        
        $ary['title'] = $nodes->item(0)->nodeValue;
        $metas = $doc->getElementsByTagName('meta');
        
        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
            
            foreach($tags as $tag) {
                if ($meta->getAttribute('name') == $tag) {
                    $ary[$tag] = $meta->getAttribute('content');
                }
            }
        }
        return $ary;
    }

    /**
     * -------------------------------------------------------------------------------
     *  get_open_graph_tags
     * -------------------------------------------------------------------------------
    **/
    function get_open_graph_tags($url, $tags = array ('og:title', 'og:description'), $timeout = 10) {
        
        $html = $this->url_get_contents($url, $timeout);
        if (!$html) {
            return false;
        }

        $doc = new DOMDocument();
        @$doc->loadHTML($html);
        $ary = [];
        $metas = $doc->getElementsByTagName('meta');
        
        for ($i = 0; $i < $metas->length; $i++) {
            $meta = $metas->item($i);
            
            foreach($tags as $tag) {
                if ($meta->getAttribute('property') == $tag) {
                    $ary[$tag] = $meta->getAttribute('content');
                }
            }
        }
        return $ary;
    }

    /**
     * -------------------------------------------------------------------------------
     *  format_size
     * -------------------------------------------------------------------------------
    **/
    function format_size($bytes, $force_unit = null, $format = null, $si = true)
    {
        // Format string
        $format = ($format === null) ? '%01.2f %s' : (string) $format;
     
        if (($si == false) || (strpos($force_unit, 'i') !== false)) {
            // IEC prefixes (binary)
            $units = array('B', 'KiB', 'MiB', 'GiB', 'TiB', 'PiB');
            $mod   = 1024;
        } else {
            // SI prefixes (decimal)
            $units = array('B', 'kB', 'MB', 'GB', 'TB', 'PB');
            $mod   = 1000;
        }
     
        // Determine unit to use
        if (($power = array_search((string) $force_unit, $units)) === false) {
            $power = ($bytes > 0) ? floor(log($bytes, $mod)) : 0;
        }
     
        return sprintf($format, $bytes / pow($mod, $power), $units[$power]);
    }

}