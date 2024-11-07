<html>
<head>
    <meta charset="GB2312">
    <style>
        body {
            display: flex;
            justify-content: center;
            margin: 0;
        }
    </style>
    <title>SWE22005_缪加斌_登录界面</title>
</head>
<body>
<form action="info.php" method="post">
    用户名：<input type="text" name="username" value="" size="10"/><br>
    密码1：<input type="password" name="password1" value="" size="10"/><br>
    密码2：<input type="password" name="password2" value="" size="10"/><br>
    性别：
    男<input type="radio" name="gender" value="男" checked="checked">
    女<input type="radio" name="gender" value="女"><br>
    <select name="year">
        <?php
        for ($year = 1950; $year <= 2024; $year++)
        {
            echo "<OPTION>$year</OPTION>";
        }
        ?>
    </select>年
    <select name="month">
        <?php
        for ($month = 1; $month <= 12; $month++)
        {
            echo "<OPTION>$month</OPTION>";
        }
        ?>
    </select>月
    <select name="day">
        <?php
        $isLeapYear = false;
        if (($year % 4 == 0 && $year % 100!= 0) || $year % 400 == 0) {
            $isLeapYear = true;
        }
        if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12) {
            for ($day = 1; $day <= 31; $day++)
            {
                echo "<OPTION>$day</OPTION>";
            }
        } elseif ($month == 4 || $month == 6 || $month == 9 || $month == 11) {
            for ($day = 1; $day <= 30; $day++)
            {
                echo "<OPTION>$day</OPTION>";
            }
        } else {
            if ($isLeapYear) {
                for ($day = 1; $day <= 29; $day++)
                {
                    echo "<OPTION>$day</OPTION>";
                }
            } else {
                for ($day = 1; $day <= 28; $day++)
                {
                    echo "<OPTION>$day</OPTION>";
                }
            }
        }
        ?>
    </select>日
    <br>
    爱好：
    阅读<input type="checkbox" name="hobby[]" value="阅读">
    登山<input type="checkbox" name="hobby[]" value="登山">
    音乐<input type="checkbox" name="hobby[]" value="音乐"><br>
    <textarea name="brief" rows="5" cols="20">请在此输入个人简介</textarea><br>
    <button type="submit">提交</button>
    <button type="reset">重置</button>
</form>
</body>
</html>