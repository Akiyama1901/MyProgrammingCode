<?php

session_start();
// 数据库连接配置
$server_name = "localhost";
$username_db = "root";
$password = "123456";
$db_name = "mydb";
$port = "3306";

// 创建数据库连接
$conn = new mysqli($server_name, $username_db, $password, $db_name, $port);
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '用户';
// 构建查询语句
$sql = "SELECT id, name, image_path, description, details, category, updated_time FROM applications";
if ($search) {
    $sql .= " WHERE name LIKE '%$search%' OR description LIKE '%$search%' OR category LIKE '%$search%'";
} //字符串连接

// 执行查询
$result = $conn->query($sql);

$applications = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $applications[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title>应用管理</title>
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
            background-color: rgba(255, 255, 255, 0.1);
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

        .search-container {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
        }

        .search-wrapper {
            display: flex;
            align-items: center;
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 10px;
        }

        .search-box {
            width: 300px;
            padding: 8px 30px 8px 40px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .search-btn {
            background-color: cornflowerblue;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            display: inline-block;
            text-align: center;
        }

        .add-btn {
            background-color: #3498db;
            color: white;
            margin-bottom: 20px;
        }

        .add-btn:hover {
            background-color: #2980b9;
        }

        .app-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .app-table th,
        .app-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .app-table th {
            background-color: #f4f6f9;
            color: #333;
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
        <a href="manage.php" class="nav-item active">
            <span class="nav-icon">🤖</span>应用管理
        </a>
        <a href="management_user.php" class="nav-item">
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
        <div class="search-container">
            <form method="GET" action="manage.php" class="search-wrapper">
                <img src="../src/search.png" class="search-icon" width="20px" height="20px"/>
                <input type="text" class="search-box" name="search" placeholder="请输入关键词" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="search-btn">查询</button>
            </form>
        </div>
        <button class="btn add-btn" onclick="location.href='add.php'">新增应用</button>
        <table class="app-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>应用名称</th>
                <th>图片</th>
                <th>简介</th>
                <th>详细信息</th>
                <th>类别</th>
                <th>更新时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($applications)): ?>
                <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?php echo $app['id']; ?></td>
                        <td><?php echo $app['name']; ?></td>
                        <td>
                            <img src="../uploads/<?php echo $app['image_path']; ?>" alt="<?php echo $app['name']; ?>" width="50" />
                        </td>
                        <td><?php echo $app['description']; ?></td>
                        <td><?php echo $app['details']; ?></td>
                        <td><?php echo $app['category']; ?></td>
                        <td><?php echo $app['updated_time']; ?></td>
                        <td>
                            <form method="post" action="edit.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $app['id']; ?>">
                                <button class="btn edit-btn" type="submit">修改</button>
                            </form>

                            <form method="post" action="delete.php" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $app['id']; ?>">
                                <button class="btn delete-btn" type="submit" onclick="return confirm('确定要删除这个应用吗？');">删除</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">暂无应用数据。</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
