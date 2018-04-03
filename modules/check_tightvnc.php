<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_tightvnc extends PD_check {

    private $meta_module = 'tightvnc';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://tightvnc.com/download.php');
        $version = $this->preg_match_singlearg('!TightVNC ([\d\.]+)!', $windows);
        $download32 = 'http://tightvnc.com/download.php';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(33, $version, $download32);
        }
    }
}

$check = new PD_check_tightvnc;
$check->check();



?>
