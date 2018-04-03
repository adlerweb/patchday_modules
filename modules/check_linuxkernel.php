<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_LinuxKernel extends PD_check {

    private $meta_module = 'LinuxKernel';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('https://www.kernel.org/');
        $version_ml = $this->preg_match_singlearg('!<td>mainline:</td>.+?<td><strong>([\w\-\d\.]+)</strong></td>!s', $windows);
	$version_st = $this->preg_match_singlearg('!<td>stable:</td>.+?<td><strong>([\w\-\d\.]+)</strong></td>!s', $windows);
	$version_lt = $this->preg_match_singlearg('!<td>longterm:</td>.+?<td><strong>([\w\-\d\.]+)</strong></td>!s', $windows);

        $download32 = 'https://www.kernel.org/';
        if(!$version_ml || !$version_st || !$version_lt || !$download32) {
            $this->fail('LinuxKernel Windows');
        }else{
            $this->setversion(28, $version_ml, $download32);
            $this->setversion(29, $version_st, $download32);
            $this->setversion(30, $version_lt, $download32);
        }
    }
}

$check = new PD_check_LinuxKernel;
$check->check();



?>
