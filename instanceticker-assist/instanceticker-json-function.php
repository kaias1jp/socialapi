<?php
function file_get_contents_cache($url)
{
    $cachePath = "./cache/".md5($url);
    if (file_exists($cachePath) == false) {
        $contents = file_get_contents($url);
        file_put_contents($cachePath, $contents);
    }

    $timestamp = filemtime($cachePath);
    $nowtime = time();
    if ($nowtime-$timestamp > 86400) {
        $contents = file_get_contents($url);
        file_put_contents($cachePath, $contents);
    }

    return $cachePath;
}

function csvtojson($url, $delimiter)
{
    $file=file_get_contents_cache($url);
    if (($handle = fopen($file, "r")) == true) {
	    $csvHeaders = fgetcsv($handle, 4000, $delimiter);
	    $csvHeaders[2] = "ServerName";
	    $csvHeaders[3] = "FontColor";
	    $csvHeaders[6] = "ImgWidth";
	    $csvHeaders[5] = "ImgPath";
	    $csvHeaders[4] = "BGColor";
	    $csvHeaders[1] = "ScreenName";
        $csvJson = array();

        while ($row = fgetcsv($handle, 4000, $delimiter)) {
            $csvJson[] = array_combine($csvHeaders, $row);
        }

        fclose($handle);
        return json_encode($csvJson);
    }
}
