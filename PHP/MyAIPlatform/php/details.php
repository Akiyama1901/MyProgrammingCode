<?php
session_start();

// 检查是否登录，未登录跳转到登录页面
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

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

// 获取应用 ID
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// 查询应用详情
$sql = "SELECT name, category, description, details, image_path, scene, effect, link
        FROM applications 
        WHERE id = $id";
$result = $conn->query($sql);

$application = null;
if ($result && $result->num_rows > 0) {
    $application = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <title>应用详情</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f6f9;
        }

        .main-content {
            padding: 40px;
            margin: 0 auto;
            max-width: 900px;
        }

        h1 {
            font-size: 36px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .app-details {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        }

        .app-details img {
            display: block;
            margin: 0 auto 20px;
            max-width: 200px;
            border-radius: 8px;
        }

        .app-details p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .app-details strong {
            font-weight: bold;
            color: #333;
        }

        .app-details .category {
            font-style: italic;
            color: #2980b9;
        }

        .app-details .effect-img {
            max-width: 100%;
            height: auto;
        }

        .error-message {
            color: red;
            text-align: center;
            font-size: 20px;
            margin-top: 50px;
        }
    </style>
</head>

<body>

<div class="main-content">
    <?php if ($application): ?>
        <h1><?php echo $application['name']; ?></h1>
        <div class="app-details">
            <img src="../uploads/<?php echo $application['image_path']; ?>" alt="<?php echo $application['name']; ?>" />

            <p><strong>类别：</strong><span class="category"><?php echo $application['category']; ?></span></p>
            <p><strong>简介：</strong><?php echo $application['description']; ?></p>
            <p><strong>详细介绍：</strong><?php echo $application['details']; ?></p>
            <p><strong>应用场景：</strong><?php echo $application['scene']; ?></p>
            <p><strong>应用效果：</strong></p><br>
            <img src="../effect/<?php echo $application['effect']; ?>" alt="应用效果" class="effect-img"/>

            <p><strong>应用链接：</strong><a href="<?php echo $application['link']; ?>" target="_blank">点击查看</a></p>
        </div>
    <?php else: ?>
        <p class="error-message">未找到该应用的详细信息。</p>
    <?php endif; ?>
</div>
</body>
</html>
