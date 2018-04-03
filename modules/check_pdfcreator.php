<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_pdfcreator extends PD_check {

    private $meta_module = 'pdfcreator';
    private $meta_author = 'modmaster@patchday.net';

    public function check() {
#        $windows = file_get_contents('http://www.pdfforge.org/pdfcreator/download');
	
#        $version = $this->preg_match_singlearg('$<h2 style="color:#d00">PDFCreator ([\d\.]+)</h2>$', $windows);
#        $download32 = 'http://download.pdfforge.org/download/pdfcreator/PDFCreator-stable';

	$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'http://download.pdfforge.org/download/pdfcreator/PDFCreator-stable?download');
        curl_setopt($curl, CURLOPT_FILETIME, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, false);
        $header = curl_exec($curl);
        curl_close($curl);

	$version = $this->preg_match_singlearg('$PDFCreator-([\d_]+)-Setup.exe$', $header);
	$version = str_replace('_', '.', $version);

	$download32 = 'http://download.pdfforge.org/download/pdfcreator/PDFCreator-stable';


        if(!$version || !$download32) {
            $this->fail('pdfcreator Windows');
        }else{
            $this->setversion(20, $version, $download32);
        }
    }
}

$check = new PD_check_pdfcreator;
$check->check();



?>
