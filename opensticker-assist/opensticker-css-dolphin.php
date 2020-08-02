<?php header('Content-Type: text/css; charset=utf-8');?>
<?php
if (isset($_GET['mode'])) {
    $mode = $_GET['mode'];
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

$jsonUrl = "https://socialapi.app/api/opensticker/json";
$json = file_get_contents($jsonUrl);
$obj = json_decode($json, true);
$obj2 = $obj["data"];


echo "@charset 'utf-8';\n";
echo " .body:before{font-size:12px!important;height:16px!important;animation:fade 1s;";
echo "display:block!important;white-space:pre!important;text-overflow:ellipsis!important;}\n";
echo "@keyframes fade{0%{opacity:1;}1%{opacity:0.1;}96%,to{opacity:1;}}\n";
foreach ($obj2 as $key => $val) {
    echo " a[class*='dp-avatar avatar'][href*='" . $val["domain"] . "']";
    echo "+.main>.body:before{color:#ffffff!important;";
    echo "padding-left:16px!important;";
    
        
    
        echo "background:url('".$val["favicon"]."')";
    
    echo ",linear-gradient(to left,transparent,#0000ff )!important; ";
    echo "background-repeat:no-repeat,no-repeat!important;";
    echo "background-size:auto 16px!important;";
    echo "content:'" . $val["name"] . "'!important;}\n";
}
