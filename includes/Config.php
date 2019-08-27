<?php
/**
 * @author Ahmed Mostafa
 * @copyright 2014
 */

$conf = array(
    'Server'        => 'localhost',
    'DB_User'       => 'root',
    'DB_Pass'       => '',
    'DB_Name'       => 'institute'
);

$DB = new mysqli($conf['Server'], $conf['DB_User'], $conf['DB_Pass'], $conf['DB_Name']);

if($DB->connect_error){
  echo "Connect Error : ".$DB->connect_error;
}else{
    ob_start();
    session_start();
}