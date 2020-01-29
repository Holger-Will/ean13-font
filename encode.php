/*
 * EAN13 String Encoder written in PHP
 * 
 * @copyright  Yevhen Kulihin
 * @url        https://github.com/yevhen-kulihin
 */

function encode($txt) {

    $gug = ['LLLLLL','LLGLGG','LLGGLG','LLGGGL','LGLLGG','LGGLLG','LGGGLL','LGLGLG','LGLGGL','LGGLGL'];

    $strlen = strlen($txt);

    // Left Block
    $first = substr($txt, 0, 1);
    $enc   = '_' . $first . '*';
    $max   = $strlen < 7 ? $strlen : 7;

    for ($i = 1; $i < $max; $i++) {
        $enc .= $gug[$first][$i-1] . substr($txt,$i,1);
    }

    $enc .= '**';

    // Right Block
    $max = $strlen < 12 ? $strlen : 12;
    for ($i = 7; $i <  $max; $i++) {
      $enc .='R' . substr($txt, $i, 1);
    }

    // Checksum
    $pr = 0;
    for ($i = min([$strlen, 12]); $i >= 1; $i--) {
      $pr += substr($txt, $i - 1, 1) * ($i % 2 == 1 ? 1 : 3);
    }
    $pr   = (10 - ($pr % 10)) % 10;
    $enc .= 'R' . $pr;
    $enc .= '*';

    return $enc;
}
