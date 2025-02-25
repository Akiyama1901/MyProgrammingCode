<?php
session_start();

// 获取用户名
$username = $_SESSION['username'];

// 数据库连接
$server_name = "localhost";
$username_db = "root";
$password_db = "123456";
$db_name = "mydb";
$port = "3306";

$conn = new mysqli($server_name, $username_db, $password_db, $db_name, $port);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

// 查询用户信息
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $user = $result->fetch_assoc(); // 获取用户数据
} else {
    echo "<script>alert('用户信息加载失败，请重试！'); window.location.href='login.php';</script>";
    exit();
}

// 处理表单提交
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $new_email = $_POST['email'];
    $new_password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];
    $new_address = $_POST['address'];

    // 更新用户信息
    $updateQuery = "UPDATE user SET email = '$new_email', password = '$new_password', address = '$new_address' WHERE username = '$username'";
    if ($conn->query($updateQuery)) {
        echo "<script>alert('个人信息更新成功！'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('更新失败，请重试！');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>个人信息管理</title>
    <style>
        body{
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .main-content {
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            display: grid;
            grid-gap: 15px;
            grid-template-columns: 1fr;
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
            margin: 5px 0;
            box-sizing: border-box;
        }

        button {
            background-color: #3498db;
            color: white;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #2980b9;
        }

    </style>
</head>
<body>

<div class="main-content">
    <h3>个人信息</h3>
    <form method="POST">
        <label for="username">用户名：</label>
        <input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" disabled><br>

        <label for="email">邮箱：</label>
        <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required><br>

        <label for="password">密码（留空表示不更改）：</label>
        <input type="password" id="password" name="password" placeholder="输入新密码"><br>

        <label for="address">地址：</label>
        <input type="text" id="address" name="address" value="<?php echo $user['address']; ?>" placeholder="请输入您的地址"><br>
        <button class="btn" type="submit" name="update">更新信息</button>
    </form>
</div>

</body>
</html>
