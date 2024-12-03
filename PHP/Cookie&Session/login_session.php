<?php
session_start();
function Input($username, $password) {

    $first = ord($username[0]);
    if(!(($first >= ord('a') and $first <= ord('z'))
        or ($first >= ord('A') and $first <= ord('Z')))) {
        return "用户名必须以字母开头";
    }

    if (strlen($username) < 6 || strlen($username) > 10) {
        return "用户名长度必须在6-10位之间";
    }

    if (strlen($password) < 6 || strlen($password) > 10) {
        return "密码长度必须在6-10位之间";
    }
    return true;
}
if (isset($_SESSION['logged'])) {
    $username = $_SESSION['logged'];
    echo "<h2>您已经登录过了！</h2>";
    echo "<p>欢迎回来，{$username}！</p>";
}
else{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $validation = Input($username, $password);

    if ($validation === true) {
        $_SESSION['logged'] = $username;

        echo "<h2>您输入的用户名是：{$username}您输入的密码是：{$password}</h2>";
        echo "<h1>欢迎{$username}, 您已经登录成功！</h1>";
    } else {
        echo "<h2>登录失败：{$validation}</h2>";
    }
}