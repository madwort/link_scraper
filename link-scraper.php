<?php
/*
Name: rconstanzo's Thesis Link Scraper
URI: http://www.rodrigoconstanzo.com/thesis/
Description: Extract all <a> links from a bunch of WP posts
Version: 0.3
Author: MADWORT
Author URI: http://www.madwort.co.uk
*/

require __DIR__ . '/vendor/autoload.php';
use PHPHtmlParser\Dom;

$urls = [
  'http://www.rodrigoconstanzo.com/thesis-introduction/',
  'http://www.rodrigoconstanzo.com/2015/04/making-decisions-in-time/',
  'http://www.rodrigoconstanzo.com/2015/06/cut-glove/',
  'http://www.rodrigoconstanzo.com/thesis-conclusion/',
  'http://www.rodrigoconstanzo.com/2013/09/com-pieces/',
  'http://www.rodrigoconstanzo.com/combine/',
  'http://www.rodrigoconstanzo.com/grassi-box/',
  'http://www.rodrigoconstanzo.com/2013/10/everything-at-once/',
  'http://www.rodrigoconstanzo.com/2014/03/everything-everything-at-once-once-2/',
  'http://www.rodrigoconstanzo.com/2015/02/everything-everything-at-once-once-3/',
  'http://www.rodrigoconstanzo.com/2013/02/strikethrough-me-you-battle-pieces/',
  'http://www.rodrigoconstanzo.com/the-party-van/',
  'http://www.rodrigoconstanzo.com/2015/05/karma/',
  'http://www.rodrigoconstanzo.com/2013/12/an-amplifier/'
];

?>
<html>
<body>
<h1>Rod's Thesis link scraper</h1>
<?php

$my_links = "\n";
$my_video_links = "\n";

foreach ($urls as $url_key => $url) {
  // $html = file_get_contents($url);
  $dom = new Dom;
  $dom->loadFromUrl($url);
  // echo $dom->innerHtml;
  // $html = $dom->find('#colLeft')[0];
  $a = $dom->find('#colLeft a');
  foreach ($a as $key => $my_a) { 
    if ($my_a->href == "") { continue; }
    $this_link = 
      "    <dt><b>".$my_a->text."</b></dt><dd style=\"padding-left: 10px;\">".
      "<a href=\"".$my_a->href."\" target=\"_blank\">-".$my_a->href."</a></dd>\n"; 
    if (strstr($my_a->href,'youtube') || 
        strstr($my_a->href,'vimeo')) 
    {
      $my_video_links .= $this_link;
    } else {
      $my_links .= $this_link;
    }
  }
}   ?>
<h3>Links</h3>
<dl style="padding-left: 30px;"><?php echo $my_links; ?></dl>
<h3>Videos</h3>
<dl style="padding-left: 30px;"><?php echo $my_video_links; ?></dl>
</body>
</html>
