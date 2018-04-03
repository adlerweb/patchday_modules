<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_gimp extends PD_check {

    private $meta_module = 'libreoffice';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.libreoffice.org/download/libreoffice-fresh/');
	
	#$windows = $this->strcrop($windows, 'Selected: LibreOffice ', ' for Windows');
	
        $version = $this->preg_match_singlearg('$Selected: LibreOffice ([\d\.]+) for Windows$', $windows);
        $download32 = 'http://www.libreoffice.org/download/libreoffice-fresh/';
        if(!$version || !$download32) {
            var_dump($version, $download32);
            $this->fail('libreoffice Windows');
        }else{
            $this->setversion(66, $version, $download32);
        }
    }
}

$check = new PD_check_gimp;
$check->check();



?>
