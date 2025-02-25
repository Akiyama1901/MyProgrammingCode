<?php
session_start();

// 检查是否登录，未登录跳转到登录页面
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 获取用户名
$username = $_SESSION['username'];

// 数据库连接配置
$server_name = "localhost";
$username_db = "root";
$password = "123456";
$db_name = "mydb";
$port = "3306";

// 创建数据库连接
$conn = new mysqli($server_name, $username_db, $password, $db_name, $port);
if ($conn->connect_error) {
    echo "连接失败: " . $conn->connect_error;
    exit();
}

// 获取用户的权限等级
$sql_permission = "SELECT permission FROM user WHERE username = '$username'";
$result_permission = $conn->query($sql_permission);
$user_permission = 0;  // 默认为普通用户

if ($result_permission && $result_permission->num_rows > 0) {
    $user_permission = $result_permission->fetch_assoc()['permission'];
}

// 获取要删除的用户 ID
if (isset($_POST['id'])) {
    $user_id = $_POST['id'];

    // 查询该用户的权限等级
    $sql = "SELECT permission, username FROM user WHERE id = '$user_id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $user_to_delete = $result->fetch_assoc();

        // 确保最高管理员或管理员不能删除自己
        if ($user_to_delete['username'] == $username) {
            echo "<script>alert('您不能删除自己！'); window.location.href='management_user.php';</script>";
            exit();
        }

        // 确保管理员（权限为1）只能删除权限为0的用户
        if ($user_permission == 1 && $user_to_delete['permission'] != 0) {
            echo "<script>alert('您没有权限删除此用户！'); window.location.href='management_user.php';</script>";
            exit();
        }

        // 删除用户
        $delete_sql = "DELETE FROM user WHERE id = '$user_id'";
        if ($conn->query($delete_sql) === TRUE) {
            echo "<script>alert('用户删除成功！'); window.location.href='management_user.php';</script>";
        } else {
            echo "<script>alert('删除用户失败！'); window.location.href='management_user.php';</script>";
        }
    } else {
        echo "<script>alert('用户不存在！'); window.location.href='management_user.php';</script>";
    }
} else {
    echo "<script>alert('无效的请求！'); window.location.href='management_user.php';</script>";
}

$conn->close();