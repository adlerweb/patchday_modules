<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_terminals extends PD_check {

    private $meta_module = 'terminals';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('https://github.com/Terminals-Origin/Terminals/releases');
	
	#$windows = $this->strcrop($windows, '<a id="download_button"', 'date</span>');
	
        $version = $this->preg_match_singlearg('$>Release ([\d\.]+)</a>$', $windows);
        //$download32 = $this->preg_match_singlearg('$ href="(http://terminals.codeplex.com/downloads/get/\d+)">download$', $windows);
	$download32 = 'https://github.com/Terminals-Origin/Terminals/releases';
        if(!$version || !$download32) {
            $this->fail('terminals Windows');
        }else{
            $this->setversion(51, $version, $download32);
        }
    }
}

$check = new PD_check_terminals;
$check->check();



?>
