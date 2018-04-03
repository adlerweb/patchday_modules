<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_knoppix extends PD_check {

    private $meta_module = 'knoppix';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.knopper.net/knoppix-mirrors/');
	
        $version = $this->preg_match_singlearg('$KNOPPIX ([\d\.]+) Release Notes$', $windows);
        $download32 = 'http://www.knopper.net/knoppix-mirrors/';
	if(!$version || !$download32) {
            $this->fail('knoppix Windows');
        }else{
            $this->setversion(52, $version, $download32);
        }
    }
}

$check = new PD_check_knoppix;
$check->check();



?>
