<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2013
 */
if(!isset($_SESSION['teacher_name']) || !isset($_SESSION['teacher_id'])){
    header("Location: /visites.php");
}else{
    $action = $_SERVER['REQUEST_URI'];

    if(isset($_GET['do']) && $_GET['do'] == "addA"){
        echo "<form action='$action' method='POST'>
        <table>
            <tr><td>Day He Absented : </td><td><input type='text' name='day' class='txt' /></td</tr>
            <tr><td>Date To The Day He Absented	</td><td><input type='date' name='date' class='txt' /></td></tr>
            <tr><td>Time He Absented : </td><td><input type='time' name='time' class='txt' /></td></tr>
            <tr><td>The Reason To The Day He Absented : </td><td><textarea name='reason' class='txt'></textarea></td></tr>
            <tr><td colspan='2'><input type='submit' name='add_absent' value='Add Absent' class='btn' /></td></tr>
        </table></form>";
        if(isset($_POST['add_absent'])){
            $uid    = $DB->real_escape_string(htmlentities($_GET['id']));
            $day    = $DB->real_escape_string(htmlentities($_POST['day']));
            $date   = $DB->real_escape_string(htmlentities($_POST['date']));
            $time   = $DB->real_escape_string(htmlentities($_POST['time']));
            $reason = $DB->real_escape_string(htmlentities($_POST['reason']));
            $add    = $DB->query("INSERT INTO `absents` (uid,day,date,time,reason) VALUE('$uid','$day','$date','$time','$reason')");
            if(isset($add))
                echo "<div class='done'>Absent Has Been Added To The Teacher Successfully, Go TO Your <a href='visites.php' style='text-decoration: none; color: red;'>Profile</a> .</div>";
        }
    }
    if(isset($_GET['do']) && $_GET['do'] == "edit"){
        $uid = $_GET['id'];
        $get_teacher_2_edit = $DB->query("SELECT * FROM `teachers` WHERE id='$uid'");
        $e_teacher_fetch    = $get_teacher_2_edit->fetch_object();
        $get_absent_2_edit  = $DB->query("SELECT * FROM `absents` WHERE uid='$uid'");
        $e_absent_fetch     = $get_absent_2_edit->fetch_object();
        $enteacher_name     = stripslashes($e_teacher_fetch->teacher_name);
        echo("<h1 style='text-align: center; margin-top: 22px;'>You Edit Information To <span style='color: red; font-weight: bold;'>".$enteacher_name."</span></h1><form action='$action' method='POST'>
    <table dir='ltr' style='margin:100px auto 0px auto;'>
    <tr><td>Teachername : </td><td><input type='text' name='eteacher_name' class='txt' value='".$enteacher_name."' /></td></tr>
    <tr><td>Make Him Admin : </td><td><input type='checkbox' name='is_admin' value='1' /></td></tr>
    <tr><td colspan='2'><input type='submit' name='edit' value='Edit' class='btn' /></td></tr>
    <table>
</form>");

    if(isset($_POST['edit'])){
            $eteacher_name  = $DB->real_escape_string(htmlentities($_POST['eteacher_name']));

            $update = $DB->query("UPDATE `teachers` SET teacher_name='$eteacher_name' WHERE id='$uid'");
            if(isset($_POST['is_admin'])&& $_POST['is_admin'] == 1){
                $update2 = $DB->query("INSERT INTO `admin` (teacher_name,teacher_code,password) VALUE('$e_teacher_fetch->teacher_name','$e_teacher_fetch->teacher_code','$e_teacher_fetch->password')");
                $del = $DB->query("DELETE FROM `teachers` WHERE id='$uid'");
            }
            if(isset($update) || (isset($del) && isset($update2)))
                    echo "<div class='done'>Information Has Been Edited Successfully, Go To <a href='visites.php' style='text-decoration: none; color: red;'>Your profile</a> .</div>";
        }
    }

    if(isset($_GET['do']) && $_GET['do'] == "delete"){
        $uid = $_GET['id'];
        $delete = $DB->query("DELETE FROM `teachers` WHERE id='$uid'");
        if(isset($delete))
            echo "<div class='done'>Teacher Has Been Deleted Successfully, Go To Your <a href='visites.php' style='text-decoration: none; color: red;'>Profile</a> .</div>";
    }
    
    if(isset($_GET['do']) && $_GET['do'] == "show"){
        $uid = $_GET['id'];
        $get_teacher_2_edit = $DB->query("SELECT * FROM `teachers` WHERE id='$uid'");
        $e_teacher_fetch    = $get_teacher_2_edit->fetch_object();
        $get_absent_2_edit  = $DB->query("SELECT * FROM `absents` WHERE uid='$uid'");
        $e_absent_fetch     = $get_absent_2_edit->fetch_object();
        $get4show           = $DB->query("SELECT * FROM `absents` WHERE uid='$uid'");
        echo "<h1 style='text-align: center; margin-top: 22px;'>Absent Dates & Information To <span style='color: red; font-weight: bold;'>$e_teacher_fetch->teacher_name</span></h1>
                <table dir='ltr' cellpadding='2' cellspacing='2' width='100%' height='auto' border='2' style='font-size: 20px; margin-top: 50px; text-align: center;'>
                    <tr><th>Teacher Name</th>
                    <th style='background-color: blue; color: white;'>Absence Times</th>
                    <th style='background-color: lightgreen;'>Day He Absented</th>
                    <th style='background-color: cyan; color: black'>Date To The Day He Absented</th>
                    <th style='background-color: brown; color: white;'>Time He Absented</th>
                    <th style='background-color: #f80;'>The Reason</th>
                    <th style='background-color: lightblue;'>Operations</th></tr>";
        while($show = $get4show->fetch_object()){
            $gteacher_name = stripslashes($e_teacher_fetch->teacher_name);
            $gday          = stripslashes($show->day);
            $gdate         = stripslashes($show->date);
            $gtime         = stripslashes($show->time);
            $greason       = stripslashes($show->reason);
            $absenceTimes  = $get4show->num_rows;
            echo "<tr>
            <td width='14%'>". $gteacher_name."</td>
            <td style='color: blue;' width='14%'>".$absenceTimes."</td>
            <td style='color: lightgreen;' width='14%'>".$gday."</td>
            <td style='color: cyan;' width='14%'>".$gdate."</td>
            <td style='color: brown;' width='14%'>".$gtime."</td>
            <td style='color: #f80;' width='14%'>".$greason."</td>
            <td width='14%'><a href='?do=Aedit&id=$show->id' style='color: lightblue; text-decoration: none;'>Edit</a> - <a href='?do=Adelete&id=$show->id' style='color: red; text-decoration: none;'>Delete</a></td>
            </tr>";
        }
      echo "</table>";
      

    }
        if(isset($_GET['do']) && $_GET['do'] == "showV"){
        $uid = $_GET['id'];
        $get_teacher_2_show = $DB->query("SELECT * FROM `teachers` WHERE id='$uid'");
        $e_teacher_fetch    = $get_teacher_2_show->fetch_object();
        $get_visits_2_show  = $DB->query("SELECT * FROM `visitors` WHERE uid='$uid'");
        $e_visits_fetch     = $get_visits_2_show->fetch_object();
        $get4show           = $DB->query("SELECT * FROM `visitors` WHERE uid='$uid'");
        echo "<h1 style='text-align: center; margin-top: 22px;'>Visits Information To <span style='color: red; font-weight: bold;'>$e_teacher_fetch->teacher_name</span></h1>
                <table dir='ltr' cellpadding='2' cellspacing='2' width='100%' height='auto' border='2' style='font-size: 20px; margin-top: 50px; text-align: center;'>
                    <tr><th>Teacher Name</th>
                    <th style='background-color: lightgreen;'>Visitor Name</th>
                    <th style='background-color: cyan; color: black'>Day He Visited Him in</th>
                    <th style='background-color: brown;'>Date He Visited Him in</th>
                    <th style='background-color: #f80;'>Time He Visited Him in</th>
                    <th style='background-color: lightblue;'>Operations</th></tr>";
        while($show = $get4show->fetch_object()){
            $svteacher_name = stripslashes($e_teacher_fetch->teacher_name);
            $sv_name          = stripslashes($show->v_name);
            $sv_day         = stripslashes($show->v_day);
            $sv_date         = stripslashes($show->v_date);
            $sv_time       = stripslashes($show->v_time);
            echo "<tr>
            <td width='20%'>".$svteacher_name."</td>
            <td style='color: lightgreen;' width='20%'>".$sv_name."</td>
            <td style='color: cyan;' width='20%'>".$sv_day."</td>
            <td style='color: brown;' width='20%'>".$sv_date."</td>
            <td style='color: #f80;' width='20%'>".$sv_time."</td>
            <td width='20%'><a href='?do=Vedit&id=$show->id' style='color: lightblue; text-decoration: none;'>Edit</a> - <a href='?do=Vdelete&id=$show->id' style='color: red; text-decoration: none;'>Delete</a></td>
            </tr>";
        }
        echo "</table>";
    }
     if(isset($_GET['do']) && $_GET['do'] == "Aedit"){
        $id = $_GET['id'];
        $sel4edit    = $DB->query("SELECT * FROM `absents` WHERE id='$id'");
        $fetch4edit  = $sel4edit->fetch_object();
        $enday    = stripslashes($fetch4edit->day);
        $endate   = stripslashes($fetch4edit->date);
        $entime   = stripslashes($fetch4edit->time);
        $enreason = stripslashes($fetch4edit->reason);
        echo "<form action='$action' method='POST'>
        <table>
            <tr><td>Day He Absented : </td><td><input type='text' name='eday' class='txt' value='".$enday."' /></td</tr>
            <tr><td>Date To The Day He Absented	</td><td><input type='date' name='edate' class='txt' /> Value OF This Field : <span style='font-size: 22px; color: red;'>".$endate."</span></td></tr>
            <tr><td>Time He Absented : </td><td><input type='time' name='etime' class='txt' /> Value OF This Field : <span style='font-size: 22px; color: red;'>".$entime."</span></td></tr>
            <tr><td>The Reason : </td><td><textarea type'text' name='ereason' class='txt'>".$enreason."</textarea>
            <tr><td colspan='2'><input type='submit' name='edit_absent' value='Edit Absent' class='btn' /></td></tr>
        </table></form>";
        
        if(isset($_POST['edit_absent'])){
            $eday  = $DB->real_escape_string(htmlentities($_POST['eday']));
            $edate = $DB->real_escape_string(htmlentities($_POST['edate']));
            $etime = $DB->real_escape_string(htmlentities($_POST['etime']));
            $ereason = $DB->real_escape_string(htmlentities($_POST['ereason']));

            $update = $DB->query("UPDATE `absents` SET day='$eday', date='$edate', time='$etime', reason='$ereason' WHERE id='$id'");
            if(isset($update)){
                echo "<div class='done' style='font-size: 30px;'>Absentes Information To This Day Has been Edited Successfuly, Go To Your <a href='visites.php' style='color: red; text-decoration: none;'>Profile</a> .</div>";
            }
        }
      }
      if(isset($_GET['do']) && $_GET['do'] == "Vedit"){
        $id = $_GET['id'];
        $sel4edit    = $DB->query("SELECT * FROM `visitors` WHERE id='$id'");
        $fetch4edit  = $sel4edit->fetch_object();
        $v_v_name    = stripslashes($fetch4edit->v_name);
        $v_v_day   = stripslashes($fetch4edit->v_day);
        $v_v_date   = stripslashes($fetch4edit->v_date);
        $v_v_time = stripslashes($fetch4edit->v_time);
        echo "<form action='$action' method='POST'>
        <table>
            <tr><td>Visitor Name : </td><td><input type='text' name='ev_name' class='txt' value='".$v_v_name."' /></td</tr>
            <tr><td>Day He Visited Him in : </td><td><input type='text' name='ev_day' class='txt' value=".$v_v_day." /></td></tr>
            <tr><td>Date He Visited Him in : </td><td><input type='date' name='ev_date' class='txt' /> Value OF This Field : <span style='font-size: 22px;color: red;'>".$v_v_date."</span></td></tr>
            <tr><td>Time He Visited Him in : </td><td><input type='time' name='ev_time' class='txt' /> Value OF This Field : <span style='font-size: 22px;color: red;'>".$v_v_time."</span></td></tr>
            <tr><td colspan='2'><input type='submit' name='edit_visit' value='Edit Visit' class='btn' /></td></tr>
        </table></form>";
        
        if(isset($_POST['edit_visit'])){
            $ev_name  = $DB->real_escape_string(htmlentities($_POST['ev_name']));
            $ev_day = $DB->real_escape_string(htmlentities($_POST['ev_day']));
            $ev_date = $DB->real_escape_string(htmlentities($_POST['ev_date']));
            $ev_time = $DB->real_escape_string(htmlentities($_POST['ev_time']));
            
            $update = $DB->query("UPDATE `visitors` SET v_name='$ev_name',v_day='$ev_day',v_date='$ev_date',v_time='$ev_time' WHERE id='$id'");
            if(isset($update)){
                echo "<div class='done' style='font-size: 30px;'>Visit Information To This Teacher Has been Edited Successfuly, Go To Your <a href='visites.php' style='color: red; text-decoration: none;'>Profile</a> .</div>";
            }
        }
      }
      if(isset($_GET['do']) && $_GET['do'] == "Adelete"){
        $id = $_GET['id'];
        $delete = $DB->query("DELETE FROM `absents` WHERE id='$id'");
        if(isset($delete))
            echo "<div class='done'>Absent Has Been Deleted Successfully, Go To Your <a href='visites.php' style='color: red; text-decoration: none;'>Profile</a> .</div>";
      }
      
      if(isset($_GET['do']) && $_GET['do'] == "deleteT"){
        die ("<h1 style='text-align: center; color: red;'>You Will Delete All Teachers Users & Absents Information .</h1><hr />
        <div style='text-align: center; font-size: 20px; margin-top: 200px;'>Are You Sure You Want To Delete All teachers users & Absents Information ? <a href='?do=deleteT_Yes' style='text-decoration: none; color: red; font-size: 40px;'>Yes</a><span style='font-size: 35px;'> - </span><a href='visites.php' style='color: green; text-decoration: none; font-size: 40px;'>No</a></div>");
      }
      if(isset($_GET['do']) && $_GET['do'] == "deleteT_Yes"){
        $truncate_teachers = $DB->query("TRUNCATE TABLE `teachers`");
        $truncate_absents  = $DB->query("TRUNCATE TABLE `absents`");
        if(isset($truncate_teachers) && isset($truncate_absents))
            die ("<div class='done' style='font-size: 30px;'>You Have Been Deleted All Teachers Users & Absents Information Successfully, Go To Your <a href='visites.php' style='text-decoration: none; color: red;'>Profile</a></div>");
        else
            die ("<div class='failed' style='font-size: 30px;'>There Is Some Thing Wrong, Pleaswe Try Again Later Go To Your <a href='visites.php' style='text-decoration: none; color: red;'>Profile</a> .</div>");
     }
     
     if(isset($_GET['do']) && $_GET['do'] == "Vdelete"){
        $id = $_GET['id'];
        $delete = $DB->query("DELETE FROM `visitors` WHERE id='$id'");
        if(isset($delete))
            echo "<div class='done'>Visit Has Been Deleted Successfully, Go To Your <a href='visites.php' style='color: red; text-decoration: none;'>Profile</a> .</div>";
      }

     if(isset($_GET['do']) && $_GET['do'] == "add_visitors"){
        echo "<form action='$action' method='POST'>
        <table>
            <tr><td>Visitor Name : </td><td><input type='text' name='v_name' class='txt' /></td</tr>
            <tr><td>Day He Visited him in	: </td><td><input type='text' name='v_day' class='txt' /></td></tr>
            <tr><td>Date He Visited him in : </td><td><input type='date' name='v_date' class='txt' /></td></tr>
            <tr><td>Time He Visited him in : </td><td><input type='time' name='v_time' class='txt' /></td></tr>
            <tr><td colspan='2'><input type='submit' name='add_visit' value='Add Visit' class='btn' /></td></tr>
        </table></form>";
        if(isset($_POST['add_visit'])){
            $v_uid       = $DB->real_escape_string(htmlentities($_GET['id']));
            $v_name    = $DB->real_escape_string(htmlentities($_POST['v_name']));
            $v_day     = $DB->real_escape_string(htmlentities($_POST['v_day']));
            $v_date     = $DB->real_escape_string(htmlentities($_POST['v_date']));
            $v_time    = $DB->real_escape_string(htmlentities($_POST['v_time']));
            $v_add       = $DB->query("INSERT INTO `visitors` (uid,v_name,v_day,v_date,v_time) VALUE('$v_uid','$v_name','$v_day','$v_date','$v_time')");
            if(isset($v_add))
                echo "<div class='done'>Visit Has Been Added To The Teacher Successfully, Go TO Your <a href='visites.php' style='text-decoration: none; color: red;'>Profile</a> .</div>";
        }
     }
    
    $teacher_code = $_SESSION['teacher_code'];
    $password = $_SESSION['password'];
    $id       = $_SESSION['teacher_id'];
    $get = $DB->query("SELECT * FROM `admin` WHERE teacher_code='$teacher_code' AND password='$password' AND id='$id'");
    $num_rows = $get->num_rows;
    
    if($num_rows >= 1){
        $get_users = $DB->query("SELECT * FROM `teachers` ORDER BY id DESC");        
        echo "<h3 style='margin-top: 4%;'>Welcome Mr / <a href='visites.php' style='text-decoration: none;'><b style='color: red;'>".$_SESSION['teacher_name']."</b></a><a href='visites.php' style='text-decoration: none; margin-left: 2.5%;'>Your Profile</a><span style='direction: ltr; margin-left: 68%;'><a href='logout.php' style='text-decoration: none;'>LogOut</a></span></h3><hr />";
        echo "<h1 style='text-align: center; color: orange'>Teachers List :-</h1>";
        $inc = include_once 'search.php';
        echo "<br /><a href='?do=deleteT' style='text-decoration: none; color: red; font-size: 33px;'>Delete ALL Teachers From The Table</a>";
        echo "<table style='margin-top: 40px; font-size: 25px; text-align: center;' width='100%' height='auto' cellpading='2' cellspacing='2' border='2'>
            <tr>
            <th style='background-color: brown; color: black;'>Teacher Name</th>
            <th style='background-color: #f80; color: white;'>Visits Information</th>
            <th style='background-color: lightgreen; color: black;'>Absent Information</th>
            <th style='background-color: lightblue; color: white;'>Operations</th>
            </tr>";
        
        while($fetch = $get_users->fetch_object()){
            $rteacher_name = stripslashes($fetch->teacher_name);
            echo "<tr>
            <td style='color: brown;'>".$rteacher_name."</td>
            <td><a href='?do=showV&id=$fetch->id' style='text-decoration: none; color: #f80;'>Show All Visits Information</a></td>
            <td><a href='?do=show&id=$fetch->id' style='text-decoration: none; color: lightgreen;'>Show All Absent Information</a></td>
            <td><a href='?do=addA&id=$fetch->id' style='text-decoration: none; color: #f80;'>Add new absent</a> - <a href='?do=add_visitors&id=$fetch->id' style='text-decoration: none; color: lightgreen;'>Add new visit</a> <br> <a href='?do=edit&id=$fetch->id' style='text-decoration: none; color: lightblue;'>Edit</a> - <a href='?do=delete&id=$fetch->id' style='text-decoration: none; color: red'>Delete</a></td></tr>";
        }
        
        echo "</table>";
    }else{
        $select_teachers = $DB->query("SELECT * FROM `absents` WHERE uid='$id'");
        echo "<h3 style='margin-top: 4%;'>Welcome Mr / <a href='visites.php' style='text-decoration: none;'><b style='color: red;'>".$_SESSION['teacher_name']."</b></a><a href='visites.php' style='text-decoration: none; margin-left: 2.5%;'>Your Profile</a><span style='direction: ltr; margin-left: 68%;'><a href='logout.php' style='text-decoration: none;'>LogOut</a></span></h3><hr />";
        echo "<h1 style='text-align: center; border: 1px solid white; color: orange;'>This Is Your Absent Information</h1>";
        echo "<table cellpadding='2' cellspacing='2' dir='ltr' border='2' width='100%' height='auto' style='font-size: 24px; margin-top: 60px;'>
            <tr>
                <th style='color: lightblue;' width='20%'>Day You Absented In</th>
                <th style='color: lightgreen;' width='20%'>Date You Absented In</th>
                <th style='color: #f80;' width=20%''>Time You Absented In</th>
                <th style='color: red;' width='40%'>The Reason</th>
            </tr>";
        while($result_teachers = $select_teachers->fetch_object()){
            $srday = stripslashes($result_teachers->day);
            $srdate = stripslashes($result_teachers->date);
            $srtime = stripslashes($result_teachers->time);
            $srreason = stripslashes($result_teachers->reason);
            echo "
                <tr>
                    <td style='color: lightblue;' width='20%'>".$srday."</td>
                    <td style='color: lightgreen;' width='20%'>".$srdate."</td>
                    <td style='color: #f80;' width='20%'>".$srtime."</td>
                    <td style='color: red;' width='40%'>".$srreason."</td>
                </tr>
            ";
        }
            //
        echo "</table>";
    }
}
ob_end_flush();
?>