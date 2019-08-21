
<?php
// setlocale(LC_ALL, 'zh_CN');
// header("Content-Type: text/html;charset=utf-8");
echo chr(109);
$file = fopen("test.csv","r");
while($data = fgets($file)){
    var_dump(explode(",",$data));
    echo "<br />";
}