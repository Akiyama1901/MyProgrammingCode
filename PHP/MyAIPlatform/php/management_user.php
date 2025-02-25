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

// 查询所有用户
$sql = "SELECT id, username, permission FROM user";
$result = $conn->query($sql);

$users = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>用户管理</title>
    <link rel="stylesheet" href="../css/manage.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: cornflowerblue;
            color: white;
            position: fixed;
            height: 100%;
            padding-top: 30px;
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
            background-color: rgba(255, 255, 255, 0.1);;
        }

        .main-content {
            margin-left: 270px;
            padding: 40px;
            flex: 1;
        }

        .top-bar {
            background-color: cornflowerblue;
            color: white;
            padding: 12px;
            font-size: 20px;
            text-align: center;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        .user-info {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }

        .content-wrapper {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .user-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .user-table th,
        .user-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .user-table th {
            background-color: #f4f6f9;
            color: #333;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }

        .edit-btn {
            background-color: #3498db;
            color: white;
        }

        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .edit-btn:hover {
            background-color: #2980b9;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        .btn:focus {
            outline: none;
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
        <a href="management_user.php" class="nav-item active">
            <span class="nav-icon">👥</span>用户管理
        </a>
        <a href="profile.php" class="nav-item">
            <span class="nav-icon">👤</span>个人信息
        </a>
        <a href="logout.php" class="nav-item">
            <span class="nav-icon">🚪</span>退出登录
        </a>
    </nav>
</div>

<div class="main-content">
    <div class="top-bar">
        <a href="profile.php" class="user-info">欢迎，<?php echo $username; ?></a>
    </div>

    <div class="content-wrapper">
        <table class="user-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>权限</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($users)): ?>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['username']; ?></td>
                        <td>
                            <?php echo $user['permission'] == 2 ? '最高权限' : ($user['permission'] == 1 ? '管理员' : '普通用户'); ?>
                        </td>
                        <td>
                            <?php if ($user_permission == 2): // 最高管理员可以操作权限为 0 或 1 的用户 ?>
                                <?php if ($user['permission'] != 2): // 不操作自己，且不操作最高管理员 ?>
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn edit-btn">编辑</a>
                                    <form method="POST" action="delete_user.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button class="btn delete-btn" type="submit" onclick="return confirm('确定要删除这个用户吗？');">删除</button>
                                    </form>
                                <?php else: ?>
                                    <span>无法操作</span>
                                <?php endif; ?>
                            <?php elseif ($user_permission == 1): // 管理员只能操作权限为 0 的用户 ?>
                                <?php if ($user['permission'] == 0 && $user['username'] != $username): // 管理员不能删除自己 ?>
                                    <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="btn edit-btn">编辑</a>
                                    <form method="POST" action="delete_user.php" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                                        <button class="btn delete-btn" type="submit" onclick="return confirm('确定要删除这个用户吗？');">删除</button>
                                    </form>
                                <?php else: ?>
                                    <span>无法操作</span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">暂无用户数据。</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>

</html>
