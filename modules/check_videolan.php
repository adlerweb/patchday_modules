<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_videolan extends PD_check {

    private $meta_module = 'Videolan';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
        //VLC Windows x86
        $windows = file_get_contents('http://www.videolan.org/vlc/download-windows.html');
        $version = $this->preg_match_singlearg('#//get.videolan.org/vlc/([\d\.]+)/win32/vlc-[\d\.]+-win32.exe#', $windows);
        $download = 'http:////get.videolan.org/vlc/'.$version.'/win32/vlc-'.$version.'-win32.exe';
	#'$this->preg_match_singlearg('$id=\'downloadButton\' href=\'//(get.videolan.org/vlc/[\d\.]+/win32/vlc-.*?.exe)\'>$', $windows);
    
        if(!$version || !$download) {
            $this->fail('VLC Windows x86');
        }else{
            $this->setversion(1, $version, 'http://'.$download);
        }
    }
}

$check = new PD_check_videolan;
$check->check();



?>
