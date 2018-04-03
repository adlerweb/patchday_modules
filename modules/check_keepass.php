<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_keepass extends PD_check {

    private $meta_module = 'keepass';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://keepass.info/download.html');
	
	$classic = $this->strcrop($windows, '<th colspan="2">KeePass 1', '</td>');
	$pro = $this->strcrop($windows, '<th colspan="2">KeePass 2', '</td>');
	
	unset($windows);
	
        $version = $this->preg_match_singlearg('$Installer \(([\d\.]+)\)$', $classic);
        //$download32 = $this->preg_match_singlearg('$<a href="(http://downloads.sourceforge.net/keepass/KeePass-[\d\.]+-Setup.exe)"$', $classic);
	$download32 = $this->preg_match_singlearg('$<a href="(https://sourceforge.net/projects/keepass/files/KeePass\%201\.x[^"]+)"$', $classic);

        if(!$version || !$download32) {
            $this->fail('keepass Windows');
	    var_dump($version, $download32);
        }else{
            $this->setversion(17, $version, $download32);
	}
      	
        $version = $this->preg_match_singlearg('$Installer \(([\d\.]+)\)$', $pro);
        //$download32 = $this->preg_match_singlearg('$<a href="(http://downloads.sourceforge.net/keepass/KeePass-[\d\.]+-Setup.exe)"$', $pro);
	$download32 = $this->preg_match_singlearg('$<a href="(https://sourceforge.net/projects/keepass/files/KeePass\%202\.x[^"]+)"$', $pro);
        if(!$version || !$download32) {
            $this->fail('keepass Windows');
	    var_dump($version, $download32);
        }else{
            $this->setversion(18, $version, $download32);
        }
    }
}

$check = new PD_check_keepass;
$check->check();



?>
