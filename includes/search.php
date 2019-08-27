<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2013
 */
if(!isset($_SESSION['teacher_name']) || !isset($_SESSION['teacher_id'])){
    header("Location: /visites.php");
 }else{
 echo "<form action='$action' method='GET'><span style='color: blue; font-size: 18px;'>- Search About Teacher ( </span><span style='color: red; font-size: 16px;'>By Using His Name</span><span style='color: blue; font-size: 18px;'> ) </span><input type='text' name='string_search' class='txt' /> <input type='submit' name='search' value='Search' style='font-size: 25px; color: white; background-color: lightblue; padding: 7px; box-shadow: inset 1px 1px 1px gray;' /></form>";
 if(isset($_GET['search'])){
    $string_search = $_GET['string_search'];
    $search_query = $DB->query("SELECT * FROM `teachers` WHERE teacher_name LIKE '%$string_search%'");
    $search_num_rows = $search_query->num_rows;
    if($search_num_rows >= 1){
            echo "<table style='margin-top: 40px; font-size: 25px; text-align: center;' width='100%' height='auto' cellpading='2' cellspacing='2' border='2'>
            <tr>
            <th style='background-color: brown; color: black;'>Teacher Name</th>
                        <th style='background-color: #f80; color: white;'>Visits Information</th>
            <th style='background-color: lightgreen; color: black;'>Absent Information</th>
            <th style='background-color: lightblue; color: white;'>Operations</th>
        </tr>";
        while($search_fetch = $search_query->fetch_object()){
            $seteacher_name = stripslashes($search_fetch->teacher_name);
           echo "<tr>
                <td style='color: brown;'>".$seteacher_name."</td>
                <td><a href='?do=showV&id=$search_fetch->id' style='text-decoration: none; color: #f80;'>Show All Visits Information</a></td>
                <td><a href='?do=show&id=$search_fetch->id' style='text-decoration: none; color: lightgreen;'>Show All Absent Information</a></td>
                <td><a href='?do=addA&id=$search_fetch->id' style='text-decoration: none; color: #f80;'>Add New Absent</a> - <a href='?do=add_visitors&id=$search_fetch->id' style='text-decoration: none; color: green;'>Add New Visit</a> - <a href='?do=edit&id=$search_fetch->id' style='text-decoration: none; color: lightblue;'>Edit</a> - <a href='?do=delete&id=$search_fetch->id' style='text-decoration: none; color: red'>Delete</a></td></tr>";
        }
        echo "</table><hr />";
    }else{
        echo "<div style='font-size: 30px; color: red; font-family: Arial, Tahoma;'>Sorry, We Didn't Find Teacher has This Name ( <span style='color: blue; font-size: 40px;'>$string_search</span> ) Please Try Again With The Right Name .</div>";
    }
 }
 }
 
 ?>