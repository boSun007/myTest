<?php
/**
 * 注意，这里的盐值是随机产生的。
 * 永远都不要使用固定盐值，或者不是随机生成的盐值。
 *
 * 绝大多数情况下，可以让 password_hash generate 为你自动产生随机盐值
 */
$options = [
    'cost' => 11,
    // 'salt' => random_bytes(60),
];
echo $password =  password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options);

$passwordInfo = password_get_info($password);

var_dump($passwordInfo);

$verify =  password_verify('rasmuslerdorf',$password);

var_dump($verify);


?>