<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_R extends PD_check {

    private $meta_module = 'R';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://cran.r-project.org/bin/windows/base/');
	
        $version = $this->preg_match_singlearg('$Download R ([\d\.]+) for Windows$', $windows);
        $download32 = 'http://cran.r-project.org/bin/windows/base/';
	
        if(!$version || !$download32) {
            $this->fail('R Windows');
        }else{
            $this->setversion(63, $version, $download32);
        }
    }
}

$check = new PD_check_R;
$check->check();



?>
