<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_SystemRescueCD extends PD_check {

    private $meta_module = 'SystemRescueCD';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://www.sysresccd.org/Download');
        $version = $this->preg_match_singlearg('!SystemRescueCd-x86-([\d\.]+)!', $html);
        $download32 = 'http://www.sysresccd.org/Download';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(35, $version, $download32);
        }
    }
}

$check = new PD_check_SystemRescueCD;
$check->check();



?>
