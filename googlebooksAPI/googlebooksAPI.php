<?php
function GoogleBooksAPI($param)
{
    $keyword = "";
    if (isset($param['keyword'])) {
        $keyword = explode(' ', $param['keyword']);
    }

    $orderBy = "relevance";
    if (isset($param['orderBy'])) {
        $orderBy = $param['orderBy'];
    }

    $lang = "ja";
    if (isset($param['lang'])) {
        $lang = $param['lang'];
    }

    $index="0";
    if (isset($param['index'])) {
        $index = $param['index'];
    }

    $mode = "";
    if (isset($param['mode'])) {
        switch ($param['mode']) {
            case 'title':
                $mode = "intitle:";
                break;
            case 'subject':
                $mode = "subject:";
                break;
            case 'author':
                $mode = "inauthor:";
                break;
        }
    }

    $operator = "+";
    if (isset($param['op'])) {
        switch ($param['op']) {
            case 'and':
                $operator = "+";
                break;
            case 'or':
                $operator = "|";
                break;
        }
    }

    foreach ($keyword as $key => $value) {
        if (strlen($q) > 0) {
            $q = $q . $operator;
        }
        $q = $q . $mode.$value;
    }

    $query = array('orderBy'=>$orderBy,'q'=>$q, 'Country'=>'JP', 'maxResults'=>'40',
      'startIndex'=>$index, 'langRestrict'=>$lang);
    $jsonUrl = "https://www.googleapis.com/books/v1/volumes?".http_build_query($query);
    $json = file_get_contents($jsonUrl);
    $obj = json_decode($json, true);
    //echo $json;
    $ret = "キーワード：";
    foreach ($keyword as $key => $value) {
        $ret .= $value.",";
    }
    $ret .= "\n";
    $ret .= "検索結果:".$obj["totalItems"]."\n";
    $ret .= "検索条件：".$orderBy." ".$lang." ".$mode." ".$operator."\n";
    $count = (int)$index*40+1;
    $ret .= "出力範囲：".(string)$count."-".(string)($count+40-1)."\n";
    foreach ($obj["items"] as $key => $val) {
        $volumeInfo = $val["volumeInfo"];
        $ret .= "[".(string)$count."]---\n";
        $ret .= "書名：".$volumeInfo["title"]."\n";
        if (count($volumeInfo["authors"])>0) {
            $ret .= "著者：";
            foreach ($volumeInfo["authors"] as $key => $value) {
                $ret .= $value.", ";
            }
            $ret .= "\n";
        }
        $ret .= "出版社：".$volumeInfo["publisher"] ."\n";
        $ret .= "出版日：".$volumeInfo["publishedDate"] ."\n";
        foreach ($volumeInfo["industryIdentifiers"] as $key => $value) {
            if ($value["type"] == "ISBN_13") {
                $ret .= "ISBN：".$value["identifier"]."\n";
            }
        }
        $count++;
    }
    return $ret;
}
