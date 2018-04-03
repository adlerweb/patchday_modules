<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_AdobeReader extends PD_check {

    private $meta_module = 'AdobeReader';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        //Adobe has a nice JSON-Interface ... blocked for standard HTTP-requests m(
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://get.adobe.com/de/reader/");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 6.2; WOW64; rv:22.0) Gecko/20100101 Firefox/40.0 PatchDay/1.0",
            "Accept: *//*",
            "Accept-Language: en-us,en",
            "Referer: http://get.adobe.com/de/" //US-URL anyone?
            ));
        
        $win = curl_exec($ch);

	//file_put_contents('test', $win);                                 
        
        //Try to extract some parseable JSON...
        /*$return = substr($return, 1, (strlen($return)-2)); //Remove array-tag
        $return = strstr($return, '},{', true).'}'; //Only first element
        $return = str_replace('\\', '', $return); //We hate backslashes, right?
        
        $return = json_decode($return);*/

	$version = $this->preg_match_singlearg('@<strong>Version ([\d\.]+)</strong>@', $win);
	//var_dump($version);
	//die();
        
        //$version = $return->Version;
        $download = 'https://get.adobe.com/de/reader/';
    
        if(!$version || !$download) {
            $this->fail('Adobe Reader x86');
        }else{
            $this->setversion(3, $version, $download);
        }
    }
}

$check = new PD_check_AdobeReader;
$check->check();



?>
