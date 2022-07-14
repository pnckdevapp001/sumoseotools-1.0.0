<?php 

namespace App\Classes;
use App\Classes\SSTClass;
use App\Models\Admin\Proxy;
use Html2Text\Html2Text;

class KeywordDensityCheckerClass {

    var $domain;

    /**
     * -------------------------------------------------------------------------------
     *  Save result page to string using curl
     * -------------------------------------------------------------------------------
    **/
    private function cURL() {
        $process = curl_init();
        curl_setopt($process, CURLOPT_URL, $this->domain);
        curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.141 Safari/537.36'); 
        curl_setopt($process, CURLOPT_TIMEOUT, 60); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($process, CURLOPT_REFERER, 'https://www.google.com/');
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    /**
     * -------------------------------------------------------------------------------
     *  Private Function to return result page as string
     * -------------------------------------------------------------------------------
    **/
    private function plainText() {

        $str = $this->cURL();

        $html = new Html2Text( $str );

        return strtolower($html->getText());
    }

    /**
     * -------------------------------------------------------------------------------
     *  Private Function to clean out the plain text
     * -------------------------------------------------------------------------------
    **/
    private function trim_replace($string) {
        $string = trim($string);
        return (string) str_replace(array("\r", "\r\n", "\n"), '', $string);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Private Function to calculate the keyword density from plain text
     * -------------------------------------------------------------------------------
    **/
    private function calcDensity() {
        // Prepare string
        $words = explode(" ", $this->plainText());
        $common_words = "i,he,she,it,and,me,my,you,the";
        $common_words = strtolower($common_words);
        $common_words = explode(",", $common_words);

        // Get keywords   
        $words_sum = 0;
        foreach ($words as $value) {
            $common = false;
            $value = $this->trim_replace($value);
            if (strlen($value) > 3) {
                foreach ($common_words as $common_word) {
                    if ($common_word == $value) {
                        $common = true;
                    }
                }
                if (true !== $common) {
                    if (!preg_match("/http/i", $value) && !preg_match("/mailto:/i", $value)) {
                        $keywords[] = $value;
                        $words_sum++;
                    }
                }
            }
        }

        // Do some maths and write array
        if ($keywords) {
            $keywords = array_count_values($keywords);
            arsort($keywords);
            $results = array();
            $results [] = array(
                'total words' => $words_sum
            );
            foreach ($keywords as $key => $value) {
                $percent = 100 / $words_sum * $value;
                $results [] = array(
                    'keyword' => trim($key),
                    'count' => $value,
                    'percent' => round($percent, 2)
                );
            }

            // Return array
            return $results;
        } else {
            return false;
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  contains_blacklist
     * -------------------------------------------------------------------------------
    **/
    public function contains_blacklist($str, array $arr)
    {
        foreach($arr as $a) {
            if (stripos($str, $a) !== false) return true;
        }
        return false;
    }

    /**
     * -------------------------------------------------------------------------------
     *  Public Function to return the keyword density result array
     * -------------------------------------------------------------------------------
    **/
	public function get_data()
	{
        try {

            $sst = new SSTClass();

            $source = $this->calcDensity();

            $data = array();

            foreach($source as $key => $value){

                if( !empty($value['keyword']) ) {
                   
                    $value['keyword'] = trim( $value['keyword'] );
                   
                    $blackLists = array('!','"','#','$','%','&','\'','(',')','*','+',',','-','.','/',':',';','<','=','>','?','@','[','\\',']','^','_','`','{','|','}','~');
                    
                    $status = $this->contains_blacklist($value['keyword'], $blackLists);
                    
                    if ( !preg_match('/[0-9]+/', $value['keyword']) ){

                        if(!$status){
                            array_push($data, array(
                                'keyword' => $value['keyword'],
                                'count'   => $value['count'],
                                'percent' => $value['percent']
                            ));
                        }

                    }
                 }
            }

            return $data;
            
        } catch (\Exception $e) {

            session()->flash('status', 'error');
            session()->flash('message', __($e->getMessage()));
            return;
        }

	}

}