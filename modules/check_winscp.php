<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_WinSCP extends PD_check {

    private $meta_module = 'WinSCP';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://winscp.net/eng/download.php');
        #$version = $this->preg_match_singlearg('#\<h1\>WinSCP ([\d\.]+) Download\<\/h1\>#', $windows);
	$version = $this->preg_match_singlearg('#WinSCP-([\d\.]+)-Setup.exe#', $windows);
	$download = $this->preg_match_singlearg('/href="\/(download\/[W|w]in[S|s][C|c][P|p][\-]?[\d\.]+[\-]?[Ss]etup.exe)"/', $windows);
   
        if(!$version || !$download) {
	    var_dump($windows, $version, $download);
            $this->fail('WinSCP Windows x86');
        }else{
            $this->setversion(2, $version, 'http://winscp.net/'.$download);
        }
    }
}

$check = new PD_check_WinSCP;
$check->check();



?>
