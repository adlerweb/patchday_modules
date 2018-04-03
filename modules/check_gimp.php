<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_gimp extends PD_check {

    private $meta_module = 'gimp';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.gimp.org/downloads/');
	
	$windows = $this->strcrop($windows, 'id=\'win\'', '</h3>');
	
#        $version = $this->preg_match_singlearg('$Download GIMP ([\d\.]+)$', $windows);
	$version = $this->preg_match_singlearg('#//download.gimp.org/mirror/pub/gimp/v[\d\.]+/windows/gimp-([\d\.]+)-setup[\-0-9]*.exe#', $windows);
        $download32 = 'http://www.gimp.org/downloads/';
        if(!$version || !$download32) {
            var_dump($version, $download32, $windows);
            $this->fail('gimp Windows');
        }else{
            $this->setversion(12, $version, $download32);
        }
    }
}

$check = new PD_check_gimp;
$check->check();



?>
