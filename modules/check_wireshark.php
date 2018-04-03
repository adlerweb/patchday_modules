<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_Wireshark extends PD_check {

    private $meta_module = 'Wireshark';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://www.wireshark.org/download.html');
        $version_st = $this->preg_match_singlearg('!>Stable Release \(([\d\.]+)\)!', $html);
	$version_os = $this->preg_match_singlearg('!>Old Stable Release \(([\d\.]+)\)!', $html);
	$version_dv = $this->preg_match_singlearg('!>Development Release \(([\w\d\.\-rc]+)\)!', $html);

#	var_dump($version_st, $version_dv);

        $download32 = 'http://www.wireshark.org/download.html';
#	if(!$version_st || !$version_os || !$version_dv || !$download32) {
	if(!$version_st || !$download32) {
            $this->fail($this->meta_module);
	    print_r($this);
        }else{
	   if($version_dv) {
		$this->setversion(42, $version_dv, $download32);
	   }else{
	   #	echo 'No DV';
	   }

	   if($version_os) {
	   	$this->setversion(41, $version_os, $download32);
	   }
           $this->setversion(40, $version_st, $download32);
           #$this->setversion(41, $version_os, $download32);
           #$this->setversion(42, $version_dv, $download32);
        }
    }
}

$check = new PD_check_Wireshark;
$check->check();



?>
