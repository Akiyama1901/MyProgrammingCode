<?php
session_start();
header('Content-Type: image/png');

$num = 4;
$width = 100;
$height = 40;
$code = '';

// 生成验证码字符
for ($i = 0; $i < $num; $i++) {
    switch (rand(0, 2)) {
        case 0:
            $code .= chr(rand(48, 57)); // 数字
            break;
        case 1:
            $code .= chr(rand(65, 90)); // 大写字母
            break;
        case 2:
            $code .= chr(rand(97, 122)); // 小写字母
            break;
    }
}
$_SESSION["captcha"] = $code;

// 创建图片资源
$image = imagecreate($width, $height);
$bg_color = imagecolorallocate($image, 255, 255, 255); // 背景色

// 绘制验证码字符
for ($i = 0; $i < $num; $i++) {
    $char_color = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255)); // 随机颜色
    $x = ($width / $num) * $i + 10; // 设置字符 x 坐标
    $y = rand(5, $height - 15); // 设置字符 y 坐标
    imagestring($image, 5, $x, $y, $code[$i], $char_color); // 绘制字符
}

// 输出图片并释放资源
imagepng($image);
imagedestroy($image);