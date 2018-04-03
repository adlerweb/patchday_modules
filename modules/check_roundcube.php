<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_Rondcube extends PD_check {

    private $meta_module = 'Rondcube';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://roundcube.net/');
        $version = $this->preg_match_singlearg('!Version ([^ ]+)</div>!', $html);
        $download32 = 'http://roundcube.net/download';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(46, $version, $download32);
        }
    }
}

$check = new PD_check_Rondcube;
$check->check();



?>
