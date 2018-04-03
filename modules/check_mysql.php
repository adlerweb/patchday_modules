<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_MySQL extends PD_check {

    private $meta_module = 'MySQL';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://dev.mysql.com/downloads/mysql/');
        $version = $this->preg_match_singlearg('!<h1>MySQL Community Server ([\d\.\-]+)!', $html);
        $download32 = 'http://dev.mysql.com/downloads/mysql/';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(38, $version, $download32);
        }
    }
}

$check = new PD_check_MySQL;
$check->check();



?>
