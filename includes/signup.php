<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2013
 */
$action = $_SERVER['REQUEST_URI'];
echo "<h3 style='margin-bottom: 3%;'>Welcome Teacher , SignUp To Our institute .</h3>
<form action='$action' method='POST'>
    <table dir='ltr' class='signup'>
    <tr><td><input type='text' name='teacher_name' placeholder='Teacher Name' style='font-size: 23px; padding: 5px; border-radius: 3px; margin-top: 5%;' size='25' /></td></tr>
    <tr><td><input type='text' name='teacher_code' placeholder='Teacher Code' style='font-size: 23px; padding: 5px; border-radius: 3px; margin-top: 5%;' size='25' /></td></tr>
    <tr><td><input type='password' name='password' placeholder='Password' style='font-size: 23px; padding: 5px; border-radius: 3px; margin-top: 5%;' size='25' /></td></tr>
    <tr><td colspan='2'><input type='submit' name='signup' value='SignUp' style='margin-left: 37%; font-size: 23px; padding: 5px 15px; border-radius: 3px; margin-top: 5%; margin-bottom: 9%;' /></td></tr>
    <table>
</form>";

if(isset($_POST['signup'])){
    $teacher_name = $DB->real_escape_string(htmlentities($_POST['teacher_name']));
    $teacher_code     = $DB->real_escape_string(htmlentities($_POST['teacher_code']));
    $password     = $DB->real_escape_string(htmlentities($_POST['password']));
    $sel_user_to_check = $DB->query("SELECT * FROM `teachers` ORDER BY id");
    $sel_admin_to_check = $DB->query("SELECT * FROM `admin` ORDER BY id");
    $users_names = array();
    $admins_names = array();
    // Get users names in DataBase
    while($fetch_users = $sel_user_to_check->fetch_object()){
        $users_names[] = $fetch_users->teacher_code;
        }
    // Get admins names in DataBase
    while($fetch_admins = $sel_admin_to_check->fetch_object()){
        $admins_names[] = $fetch_admins->teacher_code;
    }

    if(empty($teacher_name))
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Please, Insert Teacher Name .</div>";
    elseif(strlen($teacher_name) < 3 || strlen($teacher_name) > 100)
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Sorry, Teacher Name Must be more than 3 letters And little than 100 letters .</div>";
    elseif(empty($teacher_code))
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Please, Insert Teacher Code .</div>";
    elseif(in_array($teacher_code,$users_names) || in_array($teacher_code,$admins_names))
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>This Teacher Code is Existing, Please Try SignUp Again With another Teacher Code .</div>";
    elseif(strlen($teacher_code) < 4 || strlen($teacher_code) > 60)
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Sorry, Teacher Code Must be 4 or more than 4 letters And little than 60 letters .</div>";
    elseif(empty($password))
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Please, Insert Password .</div>";
    elseif(strlen($password) < 6 || strlen($password) > 80)
        echo "<div style='color: red; font-size: 30px; font-family: Arial, Tahoma;'>Sorry, Password Must be 6 or more than 6 And little than 80 letters .</div>";
    else{
        $insert = $DB->query("INSERT INTO `teachers` (teacher_name,teacher_code,password) VALUE('".$teacher_name."','".$teacher_code."','".md5($password)."')");
        if(isset($insert))
            echo "<div style='color: green; font-size: 30px; font-family: Cursive;'>Now You Are Member With US To LogIn Click , <a href='login.php' style='color: red; font-weight: bold;'>Here</a></div>";
    }
}

?>
<div style='margin-bottom: 7%;'></div>