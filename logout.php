<?php

/**
 * @author Ahmed Mostafa
 * @copyright 2013
 */

session_start();
session_destroy();
session_unset();

header("Location: index.html");

?>