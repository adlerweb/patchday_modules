<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_totalcmd extends PD_check {

    private $meta_module = 'totalcmd';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.ghisler.com/amazons3.php');
	
        $version = $this->preg_match_singlearg('$<p>Download Total Commander ([\d\w\.]+) $', $windows);
        $download32 = 'http://www.ghisler.com/amazons3d.php';
	
        if(!$version || !$download32) {
	#	var_dump($version, $windows);
	#	print_r($windows);
            $this->fail('totalcmd Windows');
        }else{
            $this->setversion(56, $version, $download32);
        }
    }
}

$check = new PD_check_totalcmd;
$check->check();



?>
