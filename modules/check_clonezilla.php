<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_CloneZilla extends PD_check {

    private $meta_module = 'CloneZilla';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://clonezilla.org/downloads.php');
	$version_st = $this->preg_match_singlearg('!<b>stable</b>.+?- <font color=red>([\d\.\-]+)!', $html);
	$version_dv = $this->preg_match_singlearg('!<b>testing</b>.+?- <font color=red>([\d\.\-]+|NOT_RELEASED_YET|NOT_RELEASED|NOT_AVAILABLE|_NOT|_not|not|NOT|N/A)!', $html);
        $download32 = 'http://clonezilla.org/downloads.php';

	if(strpos(strtoupper($version_dv), 'NOT') !== false || strpos(strtoupper($version_dv), 'N/A') !== false) $version_dv = $version_st;

	if(!$version_st || !$version_dv || !$download32) {
            $this->fail($this->meta_module);
	    var_dump($version_st, $version_dv, $download32);
        }else{
            $this->setversion(36, $version_st, $download32);
            $this->setversion(37, $version_dv, $download32);
        }
    }
}

$check = new PD_check_CloneZilla;
$check->check();



?>
