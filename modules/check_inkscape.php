<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_inkscape extends PD_check {

    private $meta_module = 'inkscape';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://inkscape.org/en/download/windows/');

        $version = $this->preg_match_singlearg('$<h2>Latest stable version: Inkscape ([\d\.]+)</h2>$', $windows);
        //$download32 = $this->preg_match_singlearg('<a href="(http://downloads.sourceforge.net/inkscape/[^"]+)">', $windows);
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
