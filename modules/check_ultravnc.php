<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_UltraVNC extends PD_check {

    private $meta_module = 'UltraVNC';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://www.uvnc.com/downloads/ultravnc.html');
        $version = $this->preg_match_singlearg('![Dd]ownload [Uu]ltra[Vv][Nn][Cc] ([\d\.]+)!', $html);
        $download32 = 'http://www.uvnc.com/downloads/ultravnc.html';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(34, $version, $download32);
        }
    }
}

$check = new PD_check_UltraVNC;
$check->check();



?>
