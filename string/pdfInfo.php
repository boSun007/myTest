<?php
$f = "123321.pdf";
$stream = fopen($f, "r");
$content = fread ($stream, filesize($f));
echo $content;
exit;
if(!$stream || !$content)
    return 0;

$count = 0;
// Regular Expressions found by Googling (all linked to SO answers):
$regex  = "/\/Count\s+(\d+)/";
$regex2 = "/\/Page\W*(\d+)/";
$regex3 = "/\/N\s+(\d+)/";

if(preg_match_all($regex, $content, $matches))
    $count = max($matches);

var_dump($count);
