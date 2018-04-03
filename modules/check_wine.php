<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_wine extends PD_check {

    private $meta_module = 'wine';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.winehq.org/');

	$version_st = $this->strcrop($windows, 'Stable:', '</span>');
	$version_st = $this->preg_match_singlearg('!Wine&nbsp;([\d\.]+)!', $version_st);
        
	$version_dv = $this->strcrop($windows, 'Development:', '</span>');
	$version_dv = $this->preg_match_singlearg('!Wine&nbsp;([\d\.]+)!', $version_dv);

	$download32 = 'http://www.winehq.org/download/';

	if(!$version_st || !$version_dv || !$download32) {
            $this->fail('wine');
        }else{
            $this->setversion(31, $version_st, $download32);
            $this->setversion(32, $version_dv, $download32);
        }
    }
}

$check = new PD_check_wine;
$check->check();



?>
