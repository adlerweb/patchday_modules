<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_mailstore extends PD_check {

    private $meta_module = 'mailstore';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
	$windows = file_get_contents('https://my.mailstore.com/Downloads?lang=de');
	$windows = 'obj = ['.$this->strcrop($windows, 'obj = [', '</script>');

	preg_match_all('/\{\s+"version": "([\d\.]+)",.+?\s+"product": "Server"/s', $windows, $match);

	$srv = 0;
	for($i=0; $i<count($match[1]); $i++) {
        if($match[1][$i] > $srv) $srv = $match[1][$i];
	}
	$version = $srv;

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
