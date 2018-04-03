<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_owncloud extends PD_check {

    private $meta_module = 'owncloud';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://owncloud.org/install/');
	
	#$part1 = $this->strcrop($windows, '<div id="instructions-server"', '<!--  Mask instructions ');
	#$part2 = $this->strcrop($windows, '<div id="tab-desktop"', '<!--  Mask instructions ');

        $version_ss = $this->preg_match_singlearg('$https://download.owncloud.org/community/owncloud-([\d\.]+).zip$', $windows);
	#version_st = $this->preg_match_singlearg('$Latest beta version: ([^&]+)$', $part1);
	$version_ds = $this->preg_match_singlearg('$https://download.owncloud.com/desktop/stable/ownCloud-([\d\.]+)-setup.exe$', $windows);

        $download32 = 'http://owncloud.org/install/';

        if(!$version_ss || !$version_ds || !$download32) {
            $this->fail('owncloud Windows');
        }else{
            $this->setversion(58, $version_ss, $download32);
            #f($version_st) $this->setversion(59, $version_st, $download32);
            $this->setversion(60, $version_ds, $download32);
        }
    }
}

$check = new PD_check_owncloud;
$check->check();



?>
