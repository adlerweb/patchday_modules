<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_ghostscript extends PD_check {

    private $meta_module = 'ghostscript';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.ghostscript.com/download/gsdnld.html');
        $version32 = $this->preg_match_singlearg('$\<a name="WIN32"\>\</a\>Ghostscript (.+) for Windows \(32 bit\)$', $windows);
        $version64 = $this->preg_match_singlearg('$\<a name="WIN64"\>\</a\>Ghostscript (.+) for Windows \(64 bit\)$', $windows);
        #$download32 = $this->preg_match_singlearg('$(http://downloads.ghostscript.com/public/gs.+w32.exe)">$', $windows);
        #$download64 = $this->preg_match_singlearg('$(http://downloads.ghostscript.com/public/gs.+w64.exe)">$', $windows);;
	$download32 = 'http://www.ghostscript.com/download/gsdnld.html';
	$download64 = $download32;
        if(!$version32 || !$version64 || !$download32 || !$download64) {
            $this->fail('GhostScript Windows');
        }else{
            $this->setversion(6, $version32, $download32);
            $this->setversion(7, $version64, $download64);
        }
    }
}

$check = new PD_check_ghostscript;
$check->check();



?>
