<?PHP

class PD_check {

    private $meta_module = 'Unnamed';
    private $meta_author = 'modmaster@patchday.net';

    public function preg_match_singleline($regex, $string) {
        if(!preg_match($regex, $string, $match)) return false;
        unset($match[0]);
        return $match;
    }

    public function preg_match_singlearg($regex, $string) {
        $return = $this->preg_match_singleline($regex, $string);
        if($return) return $return[1];
        return false;
    }
    
    public function setversion($id, $version, $url='') {
        //LOCAL TEST VERSION
    	echo 'SOFTWAREVERSION GESETZT - Software: '.$id.' - Version: '.$version.' - Download: '.$url."\n";
	return true;
    }

    public function fail($str) {
    	echo 'Module failed: '.$this->meta_author.' - '.$str."\n";
    }
    
    public function strcrop($str, $start=false, $stop=false) {
        if($start) {
            $str = explode($start, $str);
            if(count($str) == 1) trigger_error('String not found', E_USER_ERROR);
            if(count($str) > 2) trigger_error('Too many srtings found', E_USER_ERROR);
            $str = $str[1];
        }
        
        if($stop) {
            $str = strstr($str, $stop, true);
        }
        
        return $str;
    }
}
?>
