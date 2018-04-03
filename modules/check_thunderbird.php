<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_thunderbird extends PD_check {

    private $meta_module = 'thunderbird';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('https://www.mozilla.org/en-US/thunderbird/all.html');
	
        $version32 = $this->preg_match_singlearg('$"https://download.mozilla.org/\?product=thunderbird-([\d\.]+)(-SSL)?&amp;os=win&amp;lang=en-US"$', $windows);
        $download32 = $this->preg_match_singlearg('$"(https://download.mozilla.org/\?product=thunderbird-[\d\.]+(-SSL)?&amp;os=win&amp;lang=en-US)"$', $windows);

        if(!$version32 || !$download32) {
            $this->fail('Thunderbird Windows');
        }else{
            $this->setversion(50, $version32, $download32);
        }
    }
}

$check = new PD_check_thunderbird;
$check->check();



?>
