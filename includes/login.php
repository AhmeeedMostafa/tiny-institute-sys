<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2013
 */
   $action = $_SERVER['REQUEST_URI'];
    echo "<h3>Login To see your profile .</h3>
    <form action='$action' method='POST'>
        <table dir='ltr' class='signup'>
        <tr><td><input type='text' name='teacher_code' placeholder='Teacher Code' style='font-size: 23px; padding: 5px; border-radius: 3px; margin-top: 5%;' size='25' /></td></tr>
        <tr><td><input type='password' name='password' placeholder='Password' style='font-size: 23px; padding: 5px; border-radius: 3px; margin-top: 5%;' size='25' /></td></tr>
        <tr><td colspan='2'><input type='submit' name='login' value='LogIn' style='margin-left: 37%; font-size: 23px; padding: 5px 15px; border-radius: 3px; margin-top: 5%; margin-bottom: 9%;' /></td></tr>
        <table>
    </form>";

    if(isset($_POST['login'])){
        $teacher_code = $DB->real_escape_string(htmlentities($_POST['teacher_code']));
        $password = md5($DB->real_escape_string(htmlentities($_POST['password'])));
        $select  = $DB->query("SELECT * FROM `teachers` WHERE teacher_code='$teacher_code' AND password='$password'");
        $select2 = $DB->query("SELECT * FROM `admin` WHERE teacher_code='$teacher_code' AND password='$password'");
        $fetch  = $select->fetch_object();
        $fetch2 = $select2->fetch_object();
        $num_rows  = $select->num_rows;
        $num_rows2 = $select2->num_rows;
        if($num_rows <= 0 && $num_rows2 <= 0){
            echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Your Teacher Code OR password is Wrong, If you didn't signup click <a href='signup.php' style='color: blue; font-weight: bold;'>Here</a> .</div>";
        }else{
            if($num_rows >= 1){
                $_SESSION['teacher_name'] = stripslashes($fetch->teacher_name);
                $_SESSION['teacher_id']   = $fetch->id;
                $_SESSION['teacher_code']     = stripslashes($fetch->teacher_code);
                $_SESSION['password']     = stripslashes($fetch->password);
                header("Location: visites.php");
            }elseif($num_rows2 >= 1){
                $_SESSION['teacher_name'] = stripslashes($fetch2->teacher_name);
                $_SESSION['teacher_id']   = $fetch2->id;
                $_SESSION['teacher_code']     = stripslashes($fetch2->teacher_code);
                $_SESSION['password']     = stripslashes($fetch2->password);
                header("Location: visites.php");
            }
        }
    }
ob_end_flush();
?>
<div style='margin-bottom: 7%;'></div>