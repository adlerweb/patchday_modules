<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_GoogleChrome extends PD_check {

    private $meta_module = 'GoogleChrome';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://omahaproxy.appspot.com/all?csv=1');
        $version_st = $this->preg_match_singlearg('!win,stable,([\d\.]+),!', $windows);
	$version_be = $this->preg_match_singlearg('!win,beta,([\d\.]+),!', $windows);
	$version_dv = $this->preg_match_singlearg('!win,dev,([\d\.]+),!', $windows);

        if(!$version_st || !$version_be || !$version_dv ) {
            $this->fail('GoogleChrome Windows');
        }else{
            $this->setversion(53, $version_st, 'https://www.google.com/chrome');
            $this->setversion(54, $version_be, 'https://www.google.com/chrome/eula.html?extra=betachannel');
            $this->setversion(55, $version_dv, 'https://www.google.com/chrome/eula.html?extra=devchannel');
        }
    }
}

$check = new PD_check_GoogleChrome;
$check->check();



?>
