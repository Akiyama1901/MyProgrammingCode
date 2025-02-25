<?php
$server_name = "localhost";
$username = "root";
$password = "123456";
$db_name = "mydb";
$port = "3306";

$conn = new mysqli($server_name, $username, $password, $db_name, $port);
if ($conn->connect_error) {
    echo "连接失败: " . $conn->connect_error;
}

$app = null;

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // 查询应用信息
    $sql = "SELECT * FROM applications WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $app = $result->fetch_assoc(); // 获取应用信息
    } else {
        echo "找不到该应用！";
    }
} else {
    echo "无效的 ID！";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $application_scene = $_POST['scene'];
    $application_effect = $_FILES['effect']['name'];  // 使用选择的效果文件名
    $application_link = $_POST['link'];

    // 处理应用图片上传
    $uploadDir = '../uploads/';
    $effectDir = '../effect/';
    $imageName = isset($app['image']) ? $app['image'] : ''; // If $app is not set, keep an empty string

    // 检查是否上传了新的应用图片
    if (!empty($_FILES['image']['tmp_name'])) {
        $imageName = time() . '-' . $_FILES['image']['name'];
        $imagePath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "<script>alert('文件上传失败，请检查上传目录权限。');</script>";
        }
    }

    // 处理效果图片上传
    if (!empty($application_effect)) {
        $effectImageName = time() . '-' . $application_effect;  // 为效果图片生成唯一文件名
        $effectImagePath = $effectDir . $effectImageName;

        if (!move_uploaded_file($_FILES['effect']['tmp_name'], $effectImagePath)) {
            echo "<script>alert('效果图片上传失败，请检查上传目录权限。');</script>";
        }
    } else {
        // 如果没有上传新效果图片，保持原有的效果图片
        $effectImageName = isset($app['effect']) ? $app['effect'] : ''; // If no effect, keep the original one
    }

    $updated_time = date("Y-m-d H:i:s");

    // 更新数据库
    $updateQuery = "UPDATE applications SET 
                name = '$name',
                description = '$description',
                details = '$details',
                category = '$category',
                scene = '$application_scene', 
                effect = '$effectImageName',
                link = '$application_link', 
                image_path = '$imageName',
                updated_time = '$updated_time'
                WHERE id = '$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>
                alert('应用更新成功！');
                window.location.href = 'manage.php';
              </script>";
    } else {
        echo "<script>alert('更新失败: " . mysqli_error($conn) . "');</script>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="zh">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>编辑应用</title>
    <style>
        .content-wrapper {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 20px auto;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
            color: #555;
        }

        input[type="text"], textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="file"] {
            display: inline-block;
            padding: 10px;
        }

        button {
            background-color: #2980b9;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #3498db;
        }

        img {
            margin-top: 15px;
            border-radius: 5px;
            max-width: 100px;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

<div class="main-content">
    <div class="content-wrapper">
        <h3>编辑应用</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo isset($app['id']) ? $app['id'] : ''; ?>">

            <div class="form-group">
                <label for="name">应用名称：</label>
                <input type="text" id="name" name="name" value="<?php echo isset($app['name']) ? $app['name'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="image">图片：</label>
                <input type="file" id="image" name="image">
                <?php if (isset($app['image_path'])): ?>
                    <img src="../uploads/<?php echo $app['image_path']; ?>" alt="<?php echo $app['name']; ?>" />
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="description">简介：</label>
                <textarea id="description" name="description" rows="4" required><?php echo isset($app['description']) ? $app['description'] : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="details">详细信息：</label>
                <textarea id="details" name="details" rows="4" required><?php echo isset($app['details']) ? $app['details'] : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="category">类别：</label>
                <select id="category" name="category" required>
                    <option value="text" <?php echo isset($app['category']) && $app['category'] == 'text' ? 'selected' : ''; ?>>文本</option>
                    <option value="picture" <?php echo isset($app['category']) && $app['category'] == 'picture' ? 'selected' : ''; ?>>图片</option>
                    <option value="video" <?php echo isset($app['category']) && $app['category'] == 'video' ? 'selected' : ''; ?>>视频</option>
                    <option value="audio" <?php echo isset($app['category']) && $app['category'] == 'audio' ? 'selected' : ''; ?>>音频</option>
                    <option value="other" <?php echo isset($app['category']) && $app['category'] == 'other' ? 'selected' : ''; ?>>其他</option>
                </select>
            </div>

            <div class="form-group">
                <label for="scene">应用场景：</label>
                <input type="text" id="scene" name="scene" value="<?php echo isset($app['scene']) ? $app['scene'] : ''; ?>" required>
            </div>

            <div class="form-group">
                <label for="effect">应用效果：</label>
                <input type="file" id="effect" name="effect">
                <?php if (isset($app['effect'])): ?>
                    <img src="../effect/<?php echo $app['effect']; ?>" alt="应用效果" style="max-width: 200px; margin-top: 10px;" />
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="link">应用链接：</label>
                <input type="text" id="link" name="link" value="<?php echo isset($app['link']) ? $app['link'] : ''; ?>" required>
            </div>

            <button type="submit" name="update">更新应用</button>
        </form>
    </div>
</div>

</body>
</html>
