<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_arduino extends PD_check {

    private $meta_module = 'arduino';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://arduino.cc/en/Main/Software');
	
        $version_s = $this->preg_match_singlearg('$<div class="blue-title">.+?ARDUINO ([\d\.]+).+?</div>$s', $windows);
	$version_t = $this->preg_match_singlearg('$<div class="blue-title">.+?ARDUINO ([\d\.]+) BETA.+?</div>$s', $windows);

        $download32 = 'http://arduino.cc/en/Main/Software';
	
        if(!$version_s || !$download32) {
            $this->fail('arduino Windows');
        }else{
            $this->setversion(61, $version_s, $download32);
        }

	if($version_t) {
            $this->setversion(62, $version_t, $download32);
	}
    }
}

$check = new PD_check_arduino;
$check->check();



?>
