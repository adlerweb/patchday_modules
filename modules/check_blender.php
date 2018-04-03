<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_Blender extends PD_check {

    private $meta_module = 'Blender';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        $html = file_get_contents('http://www.blender.org/download/');
        //$version = $this->preg_match_singlearg('!<h1 class="csc-firstHeader">Blender ([\d\w\.]+)</h1>!', $html);
	//$version = $this->preg_match_singlearg('!Blender ([\d\w\.\-]+) for Windows!', $html);
        //$version = $this->preg_match_singlearg('!<h2>Blender ([\d\w\.\-]+)</h2>!', $html);
	$version = $this->preg_match_singlearg('!Blender ([\d\w\.\-]+) was released!', $html);
        $download32 = 'http://www.blender.org/download/';
	if(!$version || !$download32) {
		var_dump($html, $version);
           $this->fail($this->meta_module);
        }else{
            $this->setversion(39, $version, $download32);
        }
    }
}

$check = new PD_check_Blender;
$check->check();



?>
