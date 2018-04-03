<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_pidgin extends PD_check {

    private $meta_module = 'pidgin';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.pidgin.im/download/windows/');
        $version = $this->preg_match_singlearg('$<a class="sourceforge_accelerator_link" href="http://sourceforge.net/projects/pidgin/files/Pidgin/([\d\.]+)/pidgin-[\d\.]+.exe/download">Download Now</a>$', $windows);
        $download32 = $this->preg_match_singlearg('$<a class="sourceforge_accelerator_link" href="(http://sourceforge.net/projects/pidgin/files/Pidgin/[\d\.]+/pidgin-[\d\.]+.exe/download)">Download Now</a>$', $windows);
        if(!$version || !$download32) {
            $this->fail('pidgin Windows');
        }else{
            $this->setversion(21, $version, $download32);
        }
    }
}

$check = new PD_check_pidgin;
$check->check();



?>
