<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_rstudio extends PD_check {

    private $meta_module = 'rstudio';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $windows = file_get_contents('http://www.rstudio.com/products/rstudio/download/');
	
        #$version = $this->preg_match_singlearg('$Download RStudio Desktop v([\d\.]+)$', $windows);
	$version = $this->preg_match_singlearg('$<strong>RStudio Desktop ([\d\.]+)</strong>$', $windows);
        $download32 = 'http://www.rstudio.com/products/rstudio/download/';
	
        if(!$version || !$download32) {
            $this->fail('rstudio Windows');
        }else{
            $this->setversion(64, $version, $download32);
        }
    }
}

$check = new PD_check_rstudio;
$check->check();



?>
