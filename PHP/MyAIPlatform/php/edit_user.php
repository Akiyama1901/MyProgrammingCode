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

// 获取当前登录的用户名
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// 获取当前用户的权限
$sql_permission = "SELECT permission FROM user WHERE username = '$username'";
$result_permission = $conn->query($sql_permission);
$user_permission = 0;

if ($result_permission && $result_permission->num_rows > 0) {
    $user_permission = $result_permission->fetch_assoc()['permission'];
}

// 获取要编辑的用户 ID
$user_id = isset($_POST['id']) ? $_POST['id'] : (isset($_GET['id']) ? $_GET['id'] : 0);

if ($user_id == 0) {
    echo "<script>alert('用户不存在。'); window.location.href='management_user.php';</script>";
    exit();
}

// 查询用户信息
$sql_user = "SELECT * FROM user WHERE id = '$user_id'";
$result_user = $conn->query($sql_user);
$user = $result_user->fetch_assoc();

if (!$user) {
    echo "<script>alert('未找到用户信息。'); window.location.href='management_user.php';</script>";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>编辑用户</title>
    <link rel="stylesheet" href="../css/manage.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            width: 250px;
            background-color: cornflowerblue;
            color: white;
            position: fixed;
            height: 100%;
            padding-top: 40px;
            padding-left: 20px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .nav-menu {
            list-style: none;
            padding: 0;
        }

        .nav-item {
            padding: 12px 20px;
            color: white;
            text-decoration: none;
            display: block;
            margin-bottom: 8px;
            border-radius: 5px;
        }

        .nav-item:hover,
        .nav-item.active {
            background-color: cornflowerblue;
        }

        .main-content {
            margin-left: 280px;
            padding: 40px;
            max-width: 1200px;
            margin-top: 40px;
        }

        .top-bar {
            background-color: cornflowerblue;
            color: white;
            padding: 12px;
            font-size: 22px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .content-wrapper {
            background-color: white;
            padding: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table td,
        table th {
            padding: 12px;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #f4f6f9;
            text-align: left;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        button {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 16px;
        }

        button {
            background-color: cornflowerblue;
            color: white;
            cursor: pointer;
            margin-top: 20px;
        }

        button:hover {
            background-color: cornflowerblue;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: cornflowerblue;
            outline: none;
        }

        .form-actions {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>

<body>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>人工智能应用平台</h3>
    </div>
    <nav class="nav-menu">
        <a href="index.php" class="nav-item">
            <span class="nav-icon">🏠</span>应用展示
        </a>
        <a href="manage.php" class="nav-item">
            <span class="nav-icon">🤖</span>应用管理
        </a>
        <a href="profile.php" class="nav-item">
            <span class="nav-icon">👤</span>个人信息
        </a>
        <a href="management_user.php" class="nav-item active">
            <span class="nav-icon">👥</span>用户管理
        </a>
    </nav>
</div>

<div class="main-content">
    <div class="top-bar">
        编辑用户: <?php echo $user['username']; ?>
    </div>

    <div class="content-wrapper">
        <form method="POST" action="update_user.php">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

            <table>
                <tr>
                    <th>用户名:</th>
                    <td><input type="text" id="username" name="username" value="<?php echo $user['username']; ?>" required></td>
                </tr>
                <tr>
                    <th>密码:</th>
                    <td><input type="password" id="password" name="password" placeholder="输入新密码" required></td>
                </tr>
                <tr>
                    <th>邮箱:</th>
                    <td><input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required></td>
                </tr>
                <tr>
                    <th>地址:</th>
                    <td><input type="text" id="address" name="address" value="<?php echo $user['address']; ?>"></td>
                </tr>
            </table>

            <div class="form-actions">
                <button type="submit" class="btn save-btn">保存修改</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>
