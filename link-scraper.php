<?php
/*
Name: rconstanzo's Thesis Link Scraper
URI: http://www.rodrigoconstanzo.com/thesis/
Description: Extract all <a> links from a bunch of WP posts
Version: 0.1
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

foreach ($urls as $url_key => $url) {
  // $html = file_get_contents($url);
  $dom = new Dom;
  $dom->loadFromUrl($url);
  ?><h2><?php echo $url; ?> - <?php echo $dom->find('title')->text; ?></h2>
    <ul>
<?php
    // echo $dom->innerHtml;
    // $html = $dom->find('#colLeft')[0];
    $a = $dom->find('#colLeft a');
    foreach ($a as $key => $my_a) { ?>
      <li><a href="<?php echo $my_a->href; ?>"><?php 
              echo $my_a->text; // "click here" ?> - <?php 
              echo $my_a->href; ?></a></li>
<?php } ?>
    </ul>
    <?php } ?>
<div>Written by <a href="http://madwort.co.uk">MADWORT</a></div>

</body>
</html>