<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_mailstore extends PD_check {

    private $meta_module = 'mailstore';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
	$windows = file_get_contents('https://my.mailstore.com/Downloads?lang=de');
	#ä$windows = file_get_contents('test');
	$windows = 'obj = ['.$this->strcrop($windows, 'obj = [', '</script>');

	#var_dump($windows);
	#var_dump($windows);
	#$windows = json_decode($windows);
	#var_dump($windows);

	preg_match_all('/\s+"version": "([\d\.]+)",.+?\s+"product": "Server"/s', $windows, $match);
	#print_r($match);

	$srv = 0;
	for($i=0; $i<count($match[1]); $i++) {
		if($match[1][$i] > $srv) $srv = $match[1][$i];
	}
	$version = $srv;
	#var_dump($srv);

	#exit(0);

	//Clean until we get parseable JSON
	#$windows = substr(trim($windows), 10, strlen($windows)-11);
	
	#$windows = json_decode($windows);
	
#	$version=false;
	
	#for($i=count($windows)-1; $i>0; $i--) {
#		if(isset($windows[$i]->product) && $windows[$i]->product == 'Server') {
#			$version = $windows[$i]->version;
#			break;
#		}
#	}
	
	$download32 = 'https://my.mailstore.com/Downloads?lang=de';
        if(!$version || !$download32 || $version <= 0) {
            $this->fail('mailstore Windows');
        }else{
            $this->setversion(23, $version, $download32);
        }
    }
}

$check = new PD_check_mailstore;
$check->check();



?>
