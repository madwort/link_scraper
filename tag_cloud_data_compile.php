<?php

require __DIR__ . '/vendor/autoload.php';
use PHPHtmlParser\Dom;

$urls = [
  'http://www.rodrigoconstanzo.com/thesis-introduction/',
  'http://www.rodrigoconstanzo.com/2015/04/making-decisions-in-time/',
  'http://www.rodrigoconstanzo.com/2015/06/cut-glove/',
  'http://www.rodrigoconstanzo.com/thesis-conclusion/',
  'http://www.rodrigoconstanzo.com/2013/09/com-pieces/',
  'http://www.rodrigoconstanzo.com/2013/02/strikethrough-me-you-battle-pieces/',
  'http://www.rodrigoconstanzo.com/2015/11/dfscore-2/',
  'http://www.rodrigoconstanzo.com/analysis-guide/',
  'http://www.rodrigoconstanzo.com/2013/10/everything-at-once/',
  'http://www.rodrigoconstanzo.com/2014/03/everything-everything-at-once-once-2/',
  'http://www.rodrigoconstanzo.com/2015/02/everything-everything-at-once-once-3/',
  'http://www.rodrigoconstanzo.com/the-party-van/',
  'http://www.rodrigoconstanzo.com/2015/05/karma/',
  'http://www.rodrigoconstanzo.com/combine/',
  'http://www.rodrigoconstanzo.com/grassi-box/'
];

$keywords["composition"] = ["composed", "compose", "composer", "composing", "composition", "compositions"];
$keywords["improvisation"] = ["improv", "improvised", "improviser", "improvising"];
$keywords["performance"] = ["performer", "performed", "performers"];
$keywords["meta"] = ["meta", "meta-creative"];
$keywords["diy"] = ["diy", "DIY", "luthier", "build", "instrument"];
$keywords["software"] = ["software"];
$keywords["dfscore"] = ["dfscore", "dfs", "networked score", "network score"];
$keywords["controller"] = ["controller", "controllers", "gamepad", "gamepads", "monome"];
$keywords["gamepad"] = ["controller", "controllers", "gamepad"];
$keywords["mapping"] = ["mapping", "mapped", "map"];
$keywords["gesture"] = ["gesture", "gestures"];
$keywords["form"] = ["form", "formal"];
$keywords["memory"] = ["memory", "memories"];
$keywords["interaction"] = ["interaction", "interactions", "interact", "interacted"];
$keywords["behavior"] = ["behavior", "behaviors"];
$keywords["game"] = ["game", "games", "etude", "etudes", "battle", "battles", "challenge", "challenges"];
$keywords["battle"] = ["battle", "battles", "game", "etude", "etudes", "challenge", "challenges"];
$keywords["analysis"] = ["analysis", "analyses", "analyzed", "analysed"];
$keywords["video"] = ["video", "videos", "film", "filmed"];
$keywords["drums"] = ["drums", "drum", "percussion"];
$keywords["feedback"] = ["feedback"];

echo "tag,term,text,url\r\n";

foreach ($urls as $url_key => $url) {
  // old string method
  // $url = $urls[$url_key];
  // $html = file_get_contents($url);

  // new method
  $dom = new Dom;
  $dom->loadFromUrl($url);
  $html_dom = $dom->find('#colLeft');
  $html = (string)$html_dom;
  if(mb_detect_encoding($html, 'UTF-8, ISO-8859-1') != 'UTF-8') {
    $html = str_replace(chr(0xC2),'',$html);
    $html = iconv('ISO-8859-1', 'UTF-8', $html);
  }
  // var_dump((string)$html);

  $html_no_scripts = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);
  $clean_html = html_entity_decode(strip_tags($html_no_scripts));

  foreach ($keywords as $keyword => $keyword_alternatives) {
    foreach ($keyword_alternatives as $keyword_alt_id => $keyword_alternative) {
      // var_dump("keyword:" . $keyword_alternative);
      // var_dump("clean html:" . $clean_html);
      preg_match_all('/.{0,15}\b' . $keyword_alternative .
                     '\b.{0,15}/u', $clean_html, $matches
                    );
      // var_dump($matches);
      foreach ($matches[0] as $key => $match) {
        // if (htmlspecialchars($match, ENT_QUOTES, "UTF-8") == "") {
        //   var_dump($match);
        //   var_dump(htmlspecialchars($match, ENT_QUOTES, "UTF-8"));
        // }
        echo $keyword.",".
          $keyword_alternative.",\"".
          str_replace('"','""',$match)."\",\"".
          $url."#".
          $keyword_alternative.
          ",".$key."\""."\r\n";
      }
    }
  }
  // die();
}

?>
