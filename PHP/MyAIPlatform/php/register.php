<?php
session_start();

// 数据库连接
$server_name = "localhost";
$username_db = "root";
$password_db = "123456";
$db_name = "mydb";
$port = "3306";

// 创建数据库连接
$conn = new mysqli($server_name, $username_db, $password_db, $db_name, $port);
if ($conn->connect_error) {
    echo "连接失败: " . $conn->connect_error;
    exit();
}

// 判断表单提交数据是否存在
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['password_confirm']) && isset($_POST['email'])) {
    // 获取用户输入的注册信息
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $email = $_POST['email'];
    $address = isset($_POST['address']) ? $_POST['address'] : '';

    // 检查是否有空字段
    if (empty($username) || empty($password) || empty($password_confirm) || empty($email)) {
        echo "<script>alert('用户名、密码或邮箱不能为空。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    // 检查用户名首字符是否为英文字母
    $first = ord($username[0]);
    if (!(($first >= ord('a') && $first <= ord('z')) || ($first >= ord('A') && $first <= ord('Z')))) {
        echo "<script>alert('用户名必须以英文字母开头。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    // 检查用户名长度是否符合要求
    $length = strlen($username);
    if ($length < 6 || $length > 10) {
        echo "<script>alert('用户名长度必须在6到10个字符之间。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    // 检查密码长度是否符合要求，并且两次密码一致
    if (strlen($password) < 6 || strlen($password) > 8) {
        echo "<script>alert('密码长度必须在6到8个字符之间。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    if ($password !== $password_confirm) {
        echo "<script>alert('两次密码输入不一致，请重新输入。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    // 检查邮箱是否包含 @ 符号
    if (strstr($email, '@') === false) {
        echo "<script>alert('邮箱格式不正确，请重新输入。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    // 检查用户名是否已存在
    $select = "SELECT username FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $select);
    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('该用户名已存在，请选择其他用户名。'); window.location.href='../html/register.html';</script>";
        exit();
    }

    // 插入新用户信息到数据库
    $password_hashed = base64_encode($password); // 对密码进行加密存储
    $insert = "INSERT INTO user(username, password, email, address, permission) VALUES ('$username', '$password_hashed', '$email', '$address', 0)";
    if (mysqli_query($conn, $insert)) {
        echo "<script>alert('注册成功！请登录。'); window.location.href='../html/login.html';</script>";
        exit();
    } else {
        echo "<script>alert('注册失败，请重试。'); window.location.href='../html/register.html';</script>";
        exit();
    }
}

$conn->close();