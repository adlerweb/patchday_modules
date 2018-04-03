<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_7zip extends PD_check {

    private $meta_module = '7Zip';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.7-zip.org/');
        $version = $this->preg_match_singlearg('/Download 7-Zip ([\d\.]+) \(/', $windows);
        $download32 = 'http://www.7-zip.org/download.html';
        $download64 = 'http://www.7-zip.org/download.html';
        if(!$version || !$download32 || !$download64) {
            $this->fail('7zip Windows');
        }else{
            $this->setversion(4, $version, $download32);
            $this->setversion(5, $version, $download64);
        }
    }
}

$check = new PD_check_7zip;
$check->check();



?>
