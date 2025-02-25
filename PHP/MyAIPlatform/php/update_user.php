<?php
session_start();

// 数据库连接配置
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

// 获取表单数据
$user_id = isset($_POST['id']) ? $_POST['id'] : 0;
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';

// 验证表单数据
if (empty($username) || empty($password) || empty($email)) {
    echo "<script>alert('用户名、密码和邮箱不能为空。'); window.location.href='edit_user.php?id=$user_id';</script>";
    exit();
}

// 密码加密
$password_hashed = base64_encode($password);

// 更新用户信息
$sql_update = "UPDATE user SET username = '$username', password = '$password_hashed', email = '$email', address = '$address' WHERE id = '$user_id'";

if ($conn->query($sql_update) === TRUE) {
    echo "<script>alert('用户信息修改成功！'); window.location.href='management_user.php';</script>";
} else {
    echo "<script>alert('修改失败，请重试。'); window.location.href='edit_user.php?id=$user_id';</script>";
}

$conn->close();