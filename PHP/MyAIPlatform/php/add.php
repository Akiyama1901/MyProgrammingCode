<?php
$server_name = "localhost";
$username = "root";
$password = "123456";
$db_name = "mydb";
$port = "3306";

$created = date("Y-m-d H:i:s");

// 创建数据库连接
$conn = new mysqli($server_name, $username, $password, $db_name, $port);
if ($conn->connect_error) {
    echo "连接失败: " . $conn->connect_error;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $name = $_POST['name'];
    $description = $_POST['description'];
    $details = $_POST['details'];
    $category = $_POST['category'];
    $uploadDir = '../uploads/';

    // 检查是否上传了文件
    if (!empty($_FILES['image']['tmp_name']))
    {
        $imageName = time() . '-' . $_FILES['image']['name'];
        $imagePath = $uploadDir . $imageName;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            // 文件上传成功，保存到数据库
            $query = "INSERT INTO applications (name, description, details, updated_time, category, image_path) 
          VALUES ('$name', '$description', '$details', '$created', '$category', '$imageName')";


            if (mysqli_query($conn, $query))
            {
                echo "<script>
                        alert('应用添加成功！');
                        window.location.href = 'manage.php';
                      </script>";
            }
            else
            {
                echo "<script>
                        alert('数据库插入失败: " . mysqli_error($conn) . "');
                      </script>";
            }
        }
        else
        {
            echo "<script>
                    alert('文件上传失败，请检查上传目录权限。');
                  </script>";
        }
    }
    else
    {
        echo "<script>
                alert('请上传文件！');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增应用</title>
    <style>
        body {
            margin: 0;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
        }
        .form-container input[type="text"],
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container button {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: cornflowerblue;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: cornflowerblue;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h3>新增应用</h3>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">应用名称：</label>
        <input type="text" id="name" name="name" required><br>

        <label for="image">图片：</label>
        <input type="file" id="image" name="image" required><br>

        <label for="description">简介：</label>
        <textarea id="description" name="description" rows="4" required></textarea><br>

        <label for="details">详细信息：</label>
        <textarea id="details" name="details" rows="4" required></textarea><br>

        <label for="category">类别：</label>
        <select id="category" name="category" required>
            <option value="" disabled selected>请选择类别</option>
            <option value="text">文本</option>
            <option value="picture">图片</option>
            <option value="video">视频</option>
            <option value="audio">音频</option>
            <option value="other">其他</option>
        </select><br>

        <button type="submit">提交</button>
    </form>
</div>

</body>
</html>
