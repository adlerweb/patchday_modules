<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_fscapture extends PD_check {

    private $meta_module = 'fscapture';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
	/* Idiot seems to block everything not looking like a usual browser */

	$opts = array(
		'http'=>array(
			'method'=>"GET",
			'header'=>"Accept-language: en\r\n" .
			"Cookie: foo=bar\r\n" . 
			"User-Agent: Mozilla/5.0 (iPad; U; CPU OS 3_2 like Mac OS X; en-us) AppleWebKit/531.21.10 (KHTML, like Gecko) Version/4.0.4 Mobile/7B334b Safari/531.21.102011-10-16 20:23:10\r\n"
		)
	);
	$context = stream_context_create($opts);

        $windows = file_get_contents('http://www.faststone.org/FSCapturerDownload.htm', false, $context);
	
        $version = $this->preg_match_singlearg('$FastStone Capture ([\d\.]+)$', $windows);
        $download32 = 'http://www.faststone.org/FSCapturerDownload.htm';
	
        if(!$version || !$download32) {
            $this->fail('fscapture Windows');
        }else{
            $this->setversion(57, $version, $download32);
        }
    }
}

$check = new PD_check_fscapture;
$check->check();



?>
