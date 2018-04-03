<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_GPG4win extends PD_check {

    private $meta_module = 'GPG4win';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://gpg4win.org/download.html');
        $version_dv = $this->preg_match_singlearg('!<h2>Gpg4win ([\d\.]+)-beta!', $html);
	$version_st = $this->preg_match_singlearg('!<h2>Gpg4win ([\d\.]+) !', $html);

        $download32 = 'http://gpg4win.org/download.html';
	if(!$version_st || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(44, $version_st, $download32);
	    if($version_dv) $this->setversion(45, $version_dv, $download32);
        }
    }
}

$check = new PD_check_GPG4win;
$check->check();



?>
