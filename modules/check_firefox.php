<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_firefox extends PD_check {

    private $meta_module = 'firefox';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.mozilla.org/en-US/firefox/all/');
	
        #version32 = $this->preg_match_singlearg('$"https://download.mozilla.org/\?product=firefox-([\d\.]+)&amp;os=win&amp;lang=en-US"$', $windows);
        #download32 = $this->preg_match_singlearg('$"(https://download.mozilla.org/\?product=firefox-[\d\.]+&amp;os=win&amp;lang=en-US)"$', $windows);

	$version32 = $this->preg_match_singlearg('|data-latest-firefox="([\d\.]+)"|', $windows);
	$download32 = 'http://www.mozilla.org/en-US/firefox/all/';

        if(!$version32 || !$download32) {
            $this->fail('Firefox Windows');
        }else{
            $this->setversion(8, $version32, $download32);
        }
    }
}

$check = new PD_check_firefox;
$check->check();



?>
