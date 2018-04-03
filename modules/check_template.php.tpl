<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_PROG extends PD_check {

    private $meta_module = 'PROG';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://www.google.com/');
        $version = $this->preg_match_singlearg('!([\d\.]+)!', $html);
        $download32 = '';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(0, $version, $download32);
        }
    }
}

$check = new PD_check_PROG;
$check->check();



?>
