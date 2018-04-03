<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_notepadpp extends PD_check {

    private $meta_module = 'notepadpp';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://notepad-plus-plus.org/download/');
	
        $version = $this->preg_match_singlearg('$v([\d\.]+) - Current Version$', $windows);
        $download32 = 'https://notepad-plus-plus.org/download/';
	//$this->preg_match_singlearg('$"(https://notepad-plus-plus.org/repository/6.x/6.7.9.2/npp.6.7.9.2.Inhttp://download.tuxfamily.org/notepadplus/[\d\.]+/npp.[\d\.]+.Installer.exe)"$', $windows);
        if(!$version || !$download32) {
            $this->fail('notepadpp Windows');
        }else{
            $this->setversion(19, $version, $download32);
        }
    }
}

$check = new PD_check_notepadpp;
$check->check();



?>
