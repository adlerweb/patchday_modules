<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_putty extends PD_check {

    private $meta_module = 'putty';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.chiark.greenend.org.uk/~sgtatham/putty/');
        $version = $this->preg_match_singlearg('$The latest version is ([\d\.]+)\.$', $windows);
        $download32 = 'http://the.earth.li/~sgtatham/putty/latest/x86/putty.exe';
        if(!$version || !$download32) {
            $this->fail('putty Windows');
        }else{
            $this->setversion(22, $version, $download32);
        }
    }
}

$check = new PD_check_putty;
$check->check();



?>
