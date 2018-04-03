<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_inkscape extends PD_check {

    private $meta_module = 'inkscape';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('https://inkscape.org/en/');

        $version = $this->preg_match_singlearg('$Current stable version: ([\d\.]+)</span>$', $windows);
	    $download32 = 'http://inkscape.org/en/download/windows/';

        if(!$version || !$download32) {
            $this->fail('inkscape Windows');
        }else{
            $this->setversion(13, $version, $download32);
        }
    }
}

$check = new PD_check_inkscape;
$check->check();

?>
