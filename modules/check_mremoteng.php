<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_mremoteng extends PD_check {

    private $meta_module = 'mremoteng';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.mremoteng.org/download');
        $version = $this->preg_match_singlearg('$Stable <small>.+?v?([\d\.abc]+).+?</small>$s', $windows);
        $download32 = "http://www.mremoteng.org/download";
	if(!$version || !$download32) {
            $this->fail('mremoteng Windows');
        }else{
            $this->setversion(67, $version, $download32);
        }
    }
}

$check = new PD_check_mremoteng;
$check->check();



?>
