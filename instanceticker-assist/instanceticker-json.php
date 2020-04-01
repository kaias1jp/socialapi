<?php
include './instanceticker-json-function.php';
$expires = 86400;
header('Last-Modified: Fri Jan 01 2010 00:00:00 GMT');
header('Expires: ' . gmdate('D, d M Y H:i:s T', time() + $expires));
header('Cache-Control: private, max-age=' . $expires);
header('Pragma: ');
if (isset($_GET["mode"])) {
    $mode=$_GET["mode"];
    switch ($mode) {
        case "0":
        case "1":
        case "2":
            break;
        default:
            $mode="0";
    }
} else {
    $mode="0";
}
$jsonresult = csvtojson("https://wee.jp/tsv/".$mode, "\t");
header('content-type: application/json; charset=utf-8');
print $jsonresult;
