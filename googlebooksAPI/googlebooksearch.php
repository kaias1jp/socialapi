<?php header('Content-Type: text/txt; charset=utf-8');?>
<?php
include './googlebooksAPI.php';

if (isset($_GET['keyword'])) {
    $ret = GoogleBooksAPI($_GET);
} else {
    $ret = "このAPIの使い方\n";
    $ret .= "パラメータ\n";
    $ret .= "keyword:検索するキーワードを指定。複数指定する場合は半角スペースで区切る\n";
    $ret .= "orderBy:出版年月が新しい順にする場合は「newest」を指定\n";
    $ret .= "lang:言語を指定。英語の書籍を検索する場合は「en」\n";
    $ret .= "mode:検索範囲を指定。「title」：書名で検索。「author」：著者で検索\n";
    $ret .= "op:検索キーワードの組み合わせ方法。「or」：またはで検索\n";
    $ret .= "index:40件以上の結果を表示したい場合に指定。40件ごとに1つ増やす。最初は0\n";
}
echo $ret;
