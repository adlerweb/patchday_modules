<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_PHP extends PD_check {

    private $meta_module = 'PHP';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.php.net/downloads.php');
        $version_cs = $this->preg_match_singlearg('/<span class="release-state">Current Stable<\/span>.+?PHP ([\d\.]+)/is', $windows);
	$version_os = $this->preg_match_singlearg('/<span class="release-state">Old Stable<\/span>.+?PHP ([\d\.]+)/is', $windows);

	#$windows = $this->strcrop($windows, 'PHP '.$version_os);

	$version_ls = $this->preg_match_singlearg('/<span class="release-state">Old Stable<\/span>.+?PHP ([\d\.]+)/is', $windows);

        $download32 = 'http://php.net/downloads.php';

	if(!$version_cs || !$version_os || !$version_ls || !$download32) {
	    print_r($windows);
            $this->fail('PHP Windows');
        }else{
            $this->setversion(25, $version_cs, $download32);
            $this->setversion(26, $version_os, $download32);
            $this->setversion(27, $version_ls, $download32);
        }
    }
}

$check = new PD_check_PHP;
$check->check();



?>
