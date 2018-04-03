<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_IrfanView extends PD_check {

    private $meta_module = '7Zip';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.irfanview.net/64bit.htm');
        $version = $this->preg_match_singlearg('/Version (\d+\.\d+), /', $windows);
        $download32 = 'http://www.irfanview.net/64bit.htm';

        if(!$version || !$download32) {
            $this->fail('IrfanView Windows');
        }else{
            $this->setversion(65, $version, $download32);
        }
    }
}

$check = new PD_check_IrfanView;
$check->check();



?>
