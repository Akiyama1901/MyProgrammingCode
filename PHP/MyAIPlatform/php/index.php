<?php
session_start();

// 检查是否登录，未登录跳转到登录页面
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// 获取用户名
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '用户';

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

// 获取搜索关键词
$search = isset($_GET['search']) ? trim($_GET['search']) : ''; // 去掉空格
$searchTerm = "%$search%";

$sql = "SELECT id, name, category, description, image_path 
        FROM applications 
        WHERE name LIKE '$searchTerm' 
           OR description LIKE '$searchTerm' 
           OR category LIKE '$searchTerm'";

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
    <title>人工智能应用平台</title>
    <link rel="stylesheet" href="../css/index.css">
    <style>
        body {
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

        .info-item {
            display: flex;
            margin-bottom: 20px;
            cursor: pointer;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .info-item img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 20px;
        }

        .info-details h3 {
            margin: 0;
            font-size: 18px;
        }

        .category {
            font-size: 14px;
            color: #888;
            margin-left: 10px;
        }

        .info-details p {
            margin-top: 10px;
            color: #555;
        }

    </style>
</head>

<body>
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3>人工智能应用平台</h3>
    </div>
    <nav class="nav-menu">
        <a href="index.php" class="nav-item active">
            <span class="nav-icon">🏠</span>应用展示
        </a>
        <?php if ($user_permission == 1 || $user_permission == 2): ?>
            <a href="manage.php" class="nav-item">
                <span class="nav-icon">🤖</span>应用管理
            </a>
            <a href="management_user.php" class="nav-item">
                <span class="nav-icon">👥</span>用户管理
            </a>
        <?php endif; ?>
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
            <form method="GET" action="index.php" class="search-wrapper">
                <img src="../src/search.png" class="search-icon" width="20px" height="20px" />
                <input type="text" class="search-box" name="search" placeholder="请输入关键词" value="<?php echo $search; ?>">
                <button type="submit" class="search-btn">查询</button>
            </form>
        </div>

        <?php if (!empty($applications)): ?>
            <?php foreach ($applications as $app): ?>
                <div class="info-item" onclick="location.href='details.php?id=<?php echo $app['id']; ?>'">
                    <img src="../uploads/<?php echo $app['image_path']; ?>" alt="<?php echo $app['name']; ?>" />
                    <div class="info-details">
                        <h3>
                            <?php echo $app['name']; ?>
                            <span class="category">
                                <?php echo $app['category']; ?>
                            </span>
                        </h3>
                        <p>
                            <?php echo $app['description']; ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>暂无应用信息。</p>
        <?php endif; ?>
    </div>
</div>
</body>

</html>
