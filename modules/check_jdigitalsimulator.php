<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_jdigitalsimulator extends PD_check {

    private $meta_module = 'jdigitalsimulator';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('https://github.com/kristian/JDigitalSimulator/releases');
        $version = $this->preg_match_singlearg('$<span class="css-truncate-target">([\d\.]+)</span>$', $windows);
        $download32 = 'https://github.com/kristian/JDigitalSimulator/releases';
        if(!$version || !$download32) {
            $this->fail('jdigitalsimulator Windows');
        }else{
            $this->setversion(16, $version, $download32);
        }
    }
}

$check = new PD_check_jdigitalsimulator;
$check->check();



?>
