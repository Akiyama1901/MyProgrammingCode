<?php
session_start();

$server_name = "localhost";
$username_db = "root";
$password_db = "123456";
$db_name = "mydb";
$port = "3306";

// 创建数据库连接
$conn = new mysqli($server_name, $username_db, $password_db, $db_name, $port);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['captcha'])) {
    // 获取验证码
    $captcha = $_POST['captcha'];
    if (empty($_SESSION['captcha'])) {
        echo "<script>alert('验证码已经过期，请重新登录。'); window.location.href='../html/login.html';</script>";
        exit();
    }

    $true_captcha = $_SESSION['captcha'];
    if (strtolower($captcha) !== strtolower($true_captcha)) {
        echo "<script>alert('验证码不正确！请重新输入。'); window.location.href='../html/login.html';</script>";
        exit();
    }

    unset($_SESSION['captcha']); // 清除验证码

    // 获取用户名和密码
    $username = $_POST['username'];
    $password = base64_encode($_POST['password']);  // 密码加密

    // 查询数据库验证账号和密码
    $sql = "SELECT id, password FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // 如果没有找到该用户名
    if ($result->num_rows === 0) {
        echo "<script>alert('用户名不存在，请注册！'); window.location.href='../html/register.html';</script>";
        exit();
    } else {
        $user = $result->fetch_assoc();
        // 校验密码是否正确
        if ($user['password'] !== $password) {
            echo "<script>alert('密码错误，请重新输入。'); window.location.href='../html/login.html';</script>";
            exit();
        } else {
            // 密码正确，设置 session
            $_SESSION['username'] = $username;
            echo "<script>alert('登录成功'); window.location.href='../php/index.php';</script>";
            exit();
        }
    }
}

$conn->close();