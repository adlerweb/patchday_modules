<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_freepdf extends PD_check {

    private $meta_module = 'freepdf';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://freepdfxp.de/xpDownload.html');
	
	#$windows = $this->strcrop($windows, '<big>2.</big>', 'oder');
	
        $version = $this->preg_match_singlearg('/FreePDF([\d\.]+)\.EXE/i', $windows);
        $download32 = 'http://freepdfxp.de/'.$this->preg_match_singlearg('$href="FreePDF([\d\.]+).EXE"$', $windows);
        if(!$version || !$download32) {
            $this->fail('freepdf Windows');
        }else{
            $this->setversion(11, $version, $download32);
        }
    }
}

$check = new PD_check_freepdf;
$check->check();



?>
