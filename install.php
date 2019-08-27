<!DOCTYPE html>
<html>

<head>

<title>Institute - Teachers ^ install</title>
<meta name='author' content='Ahmed Mostafa ElSayed' />

<style type="text/css">
    *{
    padding: 0px;
    margin: 0px;
    outline: 0px;
    direction: ltr;
    color: white;
}
body{
    background-image: url("images/bg.jpg");
    background-repeat: repeat;
}
.done{
    background-color: #9DFF9D;
    color: green;
    border: 1px solid green;
    font-weight: bold;
    font-style: italic;
    font-size: 35px;
    text-align: center;
    direction: ltr;
    border-radius: 7px;
    margin-top: 7px;
}
.failed{
    background-color: #FF9595;
    color: red;
    border: 1px solid red;
    font-weight: bold;
    font-style: italic;
    font-size: 35px;
    text-align: center;
    direction: ltr;
    border-radius: 7px;
    margin-top: 7px;
}
.txt{
    background-color: #DBDBDB;
    color: #804040;
    font-size: 25px;
    padding: 7px;
    margin-top: 11px;
}
.txt:focus{
    padding: 9px;
    background-color: #2F97FF;
    color: #0000EA;
    transition: 1s;
}
.btn{
    padding: 7px;
    background-color: #A3A3A3;
    color: lightblue;
    font-size: 30px;
    text-align: center;
    direction: ltr;
    margin-left: 160px;
    margin-top: 11px;
}
.signup{
    margin: 185px auto 0px auto;
}
#indexsignup{
    color: lightgreen;
    text-decoration: none;
}
#indexsignup:hover{
    color: red;
    font-size: 80px;
    transition: 0.1s;
}
#indexlogin{
    color: lightblue;
    text-decoration: none;
}
#indexlogin:hover{
    color: red;
    font-size: 80px;
    transition: 0.1s;
}
#indexprofile{
    color: #FFAAD5;
    text-decoration: none;
}
#indexprofile:hover{
    color: red;
    font-size: 80px;
    transition: 0.1s;
}
.inext{
    text-decoration: none;
    border: 1px solid red;
    color: red;
    border-radius: 9px;
    padding: 18px;
    box-shadow: inset 4px 4px 4px gray;
    font-size: 50px;
}
.inext:hover{
    background-color: #727272;
    border: 1px solid lightgreen;
    color: lightgreen;
    box-shadow: inset 4px 4px 4px black;
}
</style>

</head
>
<body>

<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2013
 */
    $server_name = 'localhost';
    $user = 'root';
    $pass = '';
    $db_name = 'institute';
    $DB = new mysqli($server_name,$user,$pass, $db_name);

if(isset($_GET['install']) && $_GET['install'] == "Step_1"){
        die ("<div style='text-align: center; margin-top: 333px;'><span style='font-size: 40px; color: red;'><span style='color: lightblue;'>Done,</span> Go To The Next Step </span><a href='?install=Step_2' class='inext'>Next</a></div>");
}
if(isset($_GET['install']) && $_GET['install'] == "Step_2"){
        $create_tadmin_query = "CREATE TABLE `admin`
        (`id` int(11) NOT NULL AUTO_INCREMENT,
        `teacher_name` varchar(255) CHARACTER SET utf8 NOT NULL,
        `teacher_code` varchar(200) CHARACTER SET utf8 NOT NULL,
        `password` varchar(200) CHARACTER SET utf8 NOT NULL,
        PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $create_tadmin = $DB->query($create_tadmin_query);
        if(isset($create_tadmin)){
            die ("<div style='text-align: center; margin-top: 333px;'><span style='font-size: 40px; color: red;'><span style='color: lightblue;'>Done,</span> Go To The Next Step </span><a href='?install=Step_3' class='inext'>Next</a></div>");
        }
}
if(isset($_GET['install']) && $_GET['install'] == "Step_3"){
        $create_tteacher_query = "CREATE TABLE `teachers`
        (`id` int(11) NOT NULL AUTO_INCREMENT,
        `teacher_name` varchar(255) CHARACTER SET utf8 NOT NULL,
        `teacher_code` varchar(200) CHARACTER SET utf8 NOT NULL,
        `password` varchar(200) CHARACTER SET utf8 NOT NULL,
        PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $create_tteachers = $DB->query($create_tteacher_query);
        if(isset($create_tteachers))
            die ("<div style='text-align: center; margin-top: 333px;'><span style='font-size: 40px; color: red;'><span style='color: lightblue;'>Done,</span> Go To The Next Step </span><a href='?install=Step_4' class='inext'>Next</a></div>");
}
if(isset($_GET['install']) && $_GET['install'] == "Step_4"){
        $create_tabsents_query = "CREATE TABLE `absents`
        (`id` int(11) NOT NULL AUTO_INCREMENT,
        `uid` int(11) NOT NULL,
        `day` varchar(60) CHARACTER SET utf8 NOT NULL,
        `date` varchar(100) CHARACTER SET utf8 NOT NULL,
        `time` varchar(100) CHARACTER SET utf8 NOT NULL,
        `reason` TEXT CHARACTER SET utf8 NOT NULL,
        PRIMARY KEY (`id`)
        )ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $create_tabsents = $DB->query($create_tabsents_query);
        $create_tvisitors_query = "CREATE TABLE  `visitors` (
             `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
             `uid` INT NOT NULL ,
             `v_name` VARCHAR( 200 ) NOT NULL ,
             `v_day` VARCHAR( 60 ) NOT NULL ,
             `v_date` VARCHAR( 60 ) NOT NULL,
             `v_time` VARCHAR( 60 ) NOT NULL
            ) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci";
        $create_tvisitors = $DB->query($create_tvisitors_query);
        if(isset($create_tabsents) && isset($create_tvisitors)){
                die ("<div style='text-align: center; margin-top: 333px;'><span style='font-size: 40px; color: red;'><span style='color: lightblue;'>Done,</span> Go To The Next Step </span><a href='?install=Step_5' class='inext'>Next</a></div>");
        }
}
if(isset($_GET['install']) && $_GET['install'] == "Step_5"){
    $action = $_SERVER['REQUEST_URI'];
    echo ("<form action='$action' method='POST'>
    <table dir='ltr' class='signup'>
    <tr><td>Adminname : </td><td><input type='text' name='admin_name' class='txt' /><span style='color: yellow; font-size: 20px; font-weight: bold;'> This Will Show in Your Profile .</span></td></tr>
    <tr><td>teacher_code : </td><td><input type='text' name='teacher_code' class='txt' /><span style='color: red; font-size: 20px; font-weight: bold;'> You Will Login By This Teacher Code .</span></td></tr>
    <tr><td>Password : </td><td><input type='password' name='password' class='txt' /></td></tr>
    <tr><td colspan='2'><input type='submit' name='signup' value='SignUp' class='btn' /></td></tr>
    <table>
    </form>");
    if(isset($_POST['signup'])){
        $admin_name = $DB->real_escape_string(htmlentities($_POST['admin_name']));
        $teacher_code = $DB->real_escape_string(htmlentities($_POST['teacher_code']));
        $password = $DB->real_escape_string(htmlentities($_POST['password']));

        if(empty($admin_name))
            die ("<div class='failed'>Please, Insert Teachername .</div>");
        elseif(strlen($admin_name) < 3 || strlen($admin_name) > 100)
            die ("<div class='failed'>Sorry, Teachername Must be more than 3 letters And little than 100 letters .</div>");
        elseif(empty($teacher_code))
            die ("<div class='failed'>Please, Insert Teacher Code .</div>");
        elseif(strlen($teacher_code) < 4 || strlen($teacher_code) > 60)
            die ("<div class='failed'>Sorry, Teacher Code Must be 4 or more than 4 letters And little than 60 letters .</div>");
        elseif(empty($password))
            die ("<div class='failed'>Please, Insert Password .</div>");
        elseif(strlen($password) < 6 || strlen($password) > 80)
            die ("<div class='failed'>Sorry, Password Must be 6 or more than 6 And little than 80 letters .</div>");
        else{
                $insert = $DB->query("INSERT INTO `admin` (teacher_name,teacher_code,password) VALUE('".$admin_name."','".$teacher_code."','".md5($password)."')");
                if(isset($insert))
                    die ("<div class='done' color='font-size: 30px;'>Done, You Have Been SignedUp As Admin - Go To Next Step <a href='?install=Step_6' class='inext'>Next</a></div>");

        }
    }
    die("");
}
if(isset($_GET['install']) && $_GET['install'] == "Step_6"){
    $file = 'install.php';
    $delete_install = unlink($file);
    if(isset($delete_install)){
        die ("<div class='done' style='font-size: 35px;'>The Script Has Been Finished Setup, Now You Can Go To Login As Admin Click <a href='visites.php' style='text-decoration: none; color: red;'>Here</a> .</div>");
    }
}

echo "<div style='text-align: center; margin-top: 333px;'><span style='color: lightblue; font-size: 40px;'>Start Install The Script </span><a href='?install=Step_1' class='inext'>Start</a></div>";
?>
</body>
</html>