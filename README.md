# Patchday.net Check Modules

This repository contains software version scrapers for www.patchday.net. It also includes a wrapper to allow for local testing.

## Conventions

Scraping versions is usually not a fun thing. Whenever possible try to use URLs with machine readable version information like ones used for integrated update functions. If this is not possible using DOM or regex is another way, in this case the module must be adapted for every design change at the projects site. Try to keep the modules as simple as possible.

## Howto new Software

### Software-ID

Currently the site uses a numeric ID to identify each software. At the moment the corresponding list is not yet available in the GIT repository. To obtain an ID create an issue - include the following information:

* **Name** - ...of the software
* **Manufacturer** - ...or project name
* **Branch** - ...for exaple stable/dev
* **OS** - ...for example Windows, Linux, MacOS or All
* **Arch** - ...x86, x86-64, All
* **ProjURL** - URL to the projects website

### Scraper

Scrapers are written in PHP, there are several helpers to automate common tasks are available and can be used if desired. For every software-ID the currently available version and a URL for downloads must be submitted. Please refrain from linking the binary setup directly if the project doesn't explicitly allow hotlinking. A scraper can be used for multiple software IDs, for example if a software offers different OS-versions, stable/dev or multiple architectures.

```php
<?PHP

require_once('../config.php');
require_once('../lib/sql.php');
require_once('../lib/check.php');

class PD_check_7zip extends PD_check {

    private $meta_module = '7Zip'; //Freetext name used to inform the maintainer on malfunctions
    private $meta_author = 'modmaster@patchday.net'; //EMail of the maintainer

    public function check() {
        $windows = file_get_contents('http://www.7-zip.org/'); //Easy way to get the sites contents - CURL is also available for more complex tasks
        $version = $this->preg_match_singlearg('/Download 7-Zip ([\d\.]+) \(/', $windows);
        $download = 'http://www.7-zip.org/download.html';
        if(!$version || !$download) {
            $this->fail('7zip Windows'); //This informs the maintainer
        }else{
            $this->setversion(4, $version, $download); //4 is the Software-ID
        }
    }
}

$check = new PD_check_7zip;
$check->check();

?>
```

If you clone the repository you should be able to start the scrapers locally using ```php -f check_mymodule.php```. Please use local copies of the softwares website during tests to avoid unneccesary load at their site.

## Submit
If possible place your module inside the modules subdirectory and create a pull-request. Otherwise send your proposal to modmaster@patchday.net.

## Helpers

The following helpers might be used - see the example above.

### preg_match_singleline
``` preg_match_singleline($regex, $str)```
Pretty much like PHPs standard preg_match, but only returns the first regex-match.

```
str = "Hello my name is test. Pleased to meet you"
regex = "/ \w+\./"
return: " test."
```

### preg_match_singearg
``` preg_match_singearg($regex, $str)```
Returns the first match of the first regex group

```
str = "Hello my name is test. Pleased to meet you"
regex = "/ \(w+)\./"
return: "test"
```
### strcrop
```function strcrop($str, $s1=false, $s2=false)```
Returns the string between the first occurance of s1 and the following first occourence of s2. For example
```
str = "Hello my name is test. Pleased to meet you"
s1 = "name is "
s2 = ". Pleased"
Returns "test"
```

## If it doesn't work

If the scraper works in your test setup but not on our site the project most likely implements various ways of keeping "bots" out of their site. This is especially a problem for sites using hard-to-reach CDNs like Cloudflare, who make excessive use of CAPTCHAs for visitors. We do not support sites using these techniques, pleasy try to convince the site operator to switch to more sane ways of protecting his site. A single read-only-request from a bot poses usually no harm.

## @todo

These lists some planned changes
* Check if OS/arch still makes sense - most projects do not release different versions
* Move Software-ID-database to github
* Remove maintainer mail and change to github username for SPAM-reasons
* Fix this ugly, historic codebase
