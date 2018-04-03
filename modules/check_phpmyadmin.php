<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_phpMyAdmin extends PD_check {

    private $meta_module = 'phpMyAdmin';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://www.phpmyadmin.net/home_page/downloads.php');
        $version = $this->preg_match_singlearg('!<h2>phpMyAdmin ([\d\.]+)!', $html);
        $download32 = 'http://www.phpmyadmin.net/home_page/downloads.php';
	if(!$version || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(43, $version, $download32);
        }
    }
}

$check = new PD_check_phpMyAdmin;
$check->check();



?>
