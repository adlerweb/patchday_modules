<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_gcc extends PD_check {

    private $meta_module = 'gcc';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://gcc.gnu.org/');
    	$html = $this->strcrop($html, 'Releases</h2>', '</dl>');

    	preg_match_all('/<dt><span class="version">.+?<\/span>/s', $html, $match);

    	$first = true;
    	foreach($match[0] as $ver) {
    		$vers = $this->preg_match_singlearg('!GCC ([\d\.]+)!', $ver);
    		var_dump($ver);
    		if($first) {
    			$first = false;
    			$version_st = $vers;
    		}elseif(strpos(strtolower($ver), "development") !== false) {
    			$version_dv = $vers;
    		}elseif(!isset($version_os)){
    			$version_os = $vers;
    		}
    	}

        $download32 = 'http://gcc.gnu.org/';

	    if(!$version_st || !$version_os || !$download32) {
            $this->fail($this->meta_module);
        }else{
            $this->setversion(47, $version_st, $download32);
            $this->setversion(48, $version_os, $download32);
            if(isset($version_dv) && ($version_dv != '')) $this->setversion(49, $version_dv, $download32);
        }
    }
}

$check = new PD_check_gcc;
$check->check();
