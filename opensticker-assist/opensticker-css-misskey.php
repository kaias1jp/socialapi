<?php header('Content-Type: text/css; charset=utf-8');?>
<?php
if (isset($_GET['domain'])) {
	$mydomain = $_GET['domain'];
} else {
	$mydomain = '';
}

$json_obj = json_decode(file_get_contents("https://socialapi.app/api/opensticker/json"), true);
$data = $json_obj["data"];
$default = $json_obj["default"];

echo "@charset 'utf-8';\n";
echo " .body:before{font-size:12px!important;height:16px!important;animation:fade 1s;";
echo "display:block!important;white-space:pre!important;text-overflow:ellipsis!important;}\n";
echo "@keyframes fade{0%{opacity:1;}1%{opacity:0.1;}96%,to{opacity:1;}}\n";

foreach ($data as $key => $val) {
	$type = $val["type"];

	if ($val['domain']==$mydomain) {
		$a_title = ":not([title*='@'])";
	} else {
		$a_title = "[title*='@".$val["domain"]."']";
	}

	if ($val["fontColor"]=="") {
		$fontColor = $default[$type]["fontColor"];
	} else {
		$fontColor = $val["fontColor"];
	}

	if ($val["bgColor"]=="") {
		$bgColor = $default[$type]["bgColor"][0];
	} else {
		$bgColor = $val["bgColor"][0];
	}

	$favicon = $val["favicon"];

	$name = $val["name"];

	echo " a[class*='eiwwqkts avatar']" . $a_title ;
	echo "+.main>.body:before{color:" . $fontColor . "!important;";
    echo "padding-left:16px!important;";
    echo "background:url('" . $favicon . "')";
	echo ",linear-gradient(to left,transparent," . $bgColor . " )!important; ";
	echo "background-repeat:no-repeat,no-repeat!important;";
	echo "background-size:auto 16px!important;";
	echo "content:'" . $name . "'!important;}\n";
}
