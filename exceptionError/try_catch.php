<?php

// typeError demo
function foo(): int
{
    return 'hello world';
}



try {
    // foo();
    // echo strlen('hello world', 233);
    fbac();
} catch (\ErrorException $errorException) {
    // 捕获错误异常
    echo 'ErrorException: ' . $errorException . PHP_EOL;
} catch (\Exception $exception) {
    // 捕获异常
    echo 'Exception: ' . $exception . PHP_EOL;
} catch (\TypeError $typeError) {
    // 捕获类型错误 返回值/参数不正确
    echo 'Type Error1: ' . $typeError . PHP_EOL;
} catch (\ParseError $parseError) {
    // 捕获解析错误 语法错误
    echo 'Parse Error: ' . $parseError . PHP_EOL;
} catch (\DivisionByZeroError $divisionByZeroError) {
    // 除 0 无法捕获 但 除 0 取余可以捕获 = = 很无奈
    echo 'Division By Zero Error: ' . $divisionByZeroError . PHP_EOL;
} catch (\Error $error) {
    // 基本错误
    echo 'Error: ' . $error . PHP_EOL;
} catch(\Exception $e){
    echo 'warning123: '.$e->getMessage();
}