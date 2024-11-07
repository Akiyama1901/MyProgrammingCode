<?php
echo $_REQUEST["username"]."<br>";
echo $_REQUEST["password1"]."<br>";
echo $_REQUEST["password2"]."<br>";
echo $_REQUEST["gender"]."<br>";
if(isset($_POST["hobby"])){
    $hobbies = $_POST["hobby"];
    if(is_array($hobbies)){
        echo "爱好：";
        foreach($hobbies as $hobby){
            echo $hobby." ";
        }
        echo "<br>";
    }
}
echo $_REQUEST["brief"]."<br>";