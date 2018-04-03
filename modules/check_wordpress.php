<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_wordpress extends PD_check {

    private $meta_module = 'Wordpress';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://wordpress.org/download/');
        $version = $this->preg_match_singlearg('/<strong>Download&nbsp;WordPress&nbsp;([\d\.]+)<\/strong>/', $windows);
        $download32 = 'http://wordpress.org/latest.zip';
	if(!$version || !$download32) {
            $this->fail('wordpress Windows');
        }else{
            $this->setversion(24, $version, $download32);
        }
    }
}

$check = new PD_check_wordpress;
$check->check();



?>
