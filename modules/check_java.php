<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_java extends PD_check {

    private $meta_module = 'java';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
	//JRE
        $windows = file_get_contents('http://www.java.com/en/download/manual.jsp');
	
	$version = $this->preg_match_singleline('$<h4 class="sub">Recommended Version ([\d\.]+) Update ([\d\.]+)\s*</h4>$', $windows);
	$version = '1.'.$version[1].'.0.'.$version[2];
	
        $download32 = 'http://www.java.com/en/download/manual.jsp#win';
	
        if(!$version || !$download32 || strpos($version, '..') !== false) {
#           $this->fail('java JRE Windows');
        }else{
            $this->setversion(14, $version, $download32);
	    #var_dump($version, $download32);
        }
	
	//JDK
        $windows = file_get_contents('http://www.oracle.com/technetwork/java/javase/downloads/index.html');
	
	$version = $this->preg_match_singleline('$<h3 id="javasejdk">.+?Java SE (\d+)(u(\d+))?.+?</h3>$', $windows);


	if(isset($version[1]) && isset($version[2])) $version = '1.'.$version[1].'.0.'.$version[2];
	if(is_array($version)) $version = $version[1];
	
        $download32 = 'http://www.oracle.com/technetwork/java/javase/downloads/index.html';
	
        if(!$version || !$download32) {
            $this->fail('java JDK Windows');
        }else{
            $this->setversion(15, $version, $download32);
        }
    }
}

$check = new PD_check_java;
$check->check();



?>
