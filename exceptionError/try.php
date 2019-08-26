<?php
$data = ["C", "F"];
try {
    if (!is_numeric($data[1])) {
        throw new \Exception("this line is not valid: line", 985);
    }
    echo "FF";
} catch (\Exception $e) {
    echo $e->getMessage();
}

$a = "abcde";
