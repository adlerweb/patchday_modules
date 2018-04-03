<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_FlashPlayer extends PD_check {

    private $meta_module = 'FlashPlayer';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        //Adobe has a nice JSON-Interface ... blocked for standard HTTP-requests m(
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://get.adobe.com/flashplayer/webservices/json/?platform_type=Windows&platform_dist=XP&platform_arch=x86-32&platform_misc=&browser_arch=&browser_type=&browser_vers=&browser_dist=&eventname=flashplayerotherversions");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:22.0) Gecko/20100101 Firefox/22.0 PatchDay/1.0",
            "Accept: *//*",
            "Accept-Language: en-us,en",
            "X-Requested-With: XMLHttpRequest",
            "Referer: http://get.adobe.com/de/flashplayer/otherversions/" //US-URL anyone?
            ));
        
        $return = curl_exec($ch);
            
        
        //Try to extract some parseable JSON...
        $return = str_replace('\\', '', $return); //We hate backslashes, right?
        
        $return = json_decode($return);
        
        $version_ie  = 0;
        $version_oth = 0;
        
        foreach($return as $v) {
            if(strpos($v->Name, 'Internet Explorer') !== false && $version_ie <= (float)$v->Version) {
                $version_ie = $v->Version;
                $url_ie = $v->download_url;
            }elseif(strpos($v->Name, 'Internet Explorer') === false && $version_oth <= (float)$v->Version) {
                $version_oth = $v->Version;
                $url_oth = $v->download_url;
            }
        }
    
        if(!$version_ie || !$url_ie || !$version_oth || !$url_oth) {
            $this->fail('Adobe Flash x86');
        }else{
            $this->setversion(9, $version_ie, $url_ie);
            $this->setversion(10, $version_oth, $url_oth);
        }
    }
}

$check = new PD_check_FlashPlayer;
$check->check();



?>
