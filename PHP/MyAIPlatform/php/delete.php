<?php
// 数据库连接配置
$server_name = "localhost";
$username = "root";
$password = "123456";
$db_name = "mydb";
$port = "3306";

// 创建数据库连接
$conn = new mysqli($server_name, $username, $password, $db_name, $port);
if ($conn->connect_error) {
    echo "连接失败: " . $conn->connect_error;
}

// 检查是否接收到 ID
if (isset($_POST['id']) && is_numeric($_POST['id']))
{
    $id = $_POST['id'];

    $sql = "DELETE FROM applications WHERE id = $id";
    if ($conn->query($sql) === TRUE)
    {
        header("Location: manage.php");
        exit();
    }
    else
    {
        echo "删除失败: " . $conn->error;
    }
}
else
{
    echo "无效的 ID";
}
$conn->close();
