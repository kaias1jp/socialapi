<?php
include './instanceticker-json-function.php';
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
