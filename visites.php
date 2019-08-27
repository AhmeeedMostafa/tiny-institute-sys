<?php require_once 'includes/Config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Visites</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
    <script src="js/jquery-1.6.3.min.js" type="text/javascript"></script>
    <script src="js/cufon-yui.js" type="text/javascript"></script>
    <script src="js/cufon-replace.js" type="text/javascript"></script>
    <script src="js/NewsGoth_400.font.js" type="text/javascript"></script>
	<script src="js/NewsGoth_700.font.js" type="text/javascript"></script>
    <script src="js/NewsGoth_Lt_BT_italic_400.font.js" type="text/javascript"></script>
    <script src="js/Vegur_400.font.js" type="text/javascript"></script>
    <script src="js/FF-cash.js" type="text/javascript"></script>
	<!--[if lt IE 7]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
        	<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today." />
        </a>
    </div>
	<![endif]-->
    <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
    <style type="text/css">
<!--
.style1 {color: #FFFFFF}
.txt{
    font-size: 23px;
    padding: 5px;
    border-radius: 3px;
    margin-top: 5%;
}
.btn{
  font-size: 21px;
  padding: 5px 20px;
  margin-top: 5%;
}
.container_12 center table tr th{
  padding: 5px;
}
.container_12 center table tr td{
  padding: 3px;
  font-size: 17px;
  font-weight: bold;
}
.done{
  color: green;
  font-size: 28px;
  font-family: cursive;
  line-height: 50px;
}
.failed{
   color: red;
   font-size: 28px;
   font-family: Arial, Tahoma;
   line-height: 50px;
}

-->
    </style>
</head>
<body id="page2">
	<div class="extra">
    	<!--==============================header=================================-->
        <header>
        	<div class="row-top">
            	<div class="main">
                	<div class="wrapper">
                    	<h1><a href="index.html">Consulting</a></h1>
                        <form id="search-form" method="post" enctype="multipart/form-data">
                          <img src="images/mylogo.png" width="150" height="39">
                                                </form>
                    </div>
                </div>
            </div>
            <div class="menu-row">
            	<div class="menu-bg">
                    <div class="main">
                        <nav class="indent-left">
                            <ul class="menu wrapper">
                                <li><a href="index.php">presentation</a></li>
                                <li class="active style1"><a href="visites.php"><span tabindex="-1" id="result_box" lang="fr">visites</span></a></li>
                                <li><a href="visites.php"><span tabindex="-1" id="result_box" lang="fr">absences</span></a></li>
                                <li><a href="projects.html">mon projet </a></li>
                                <li><a href="contact.html">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row-bot">
            	<div class="center-shadow">
                </div>
            </div>
        </header>

        <!--==============================content================================-->
        <section id="content"><div class="ic">More Website Templates @ TemplateMonster.com. December10, 2011!</div>
            <div class="content-bg">
                <div class="main">
                  <div class="container_12">
                  <center>
                    <?php
                    if(!isset($_SESSION['teacher_name']) && !isset($_SESSION['teacher_id']))
                        require_once 'includes/login.php';
                    else
                        require_once 'includes/profile.php';
                    ?>
                </center>
                </div>
                </div>
                <div class="block"></div>
            </div>
        </section>
    </div>

	<!--==============================footer=================================-->
    <footer>
        <div class="padding">
            <div class="main">
                <div class="container_12">
                  <div class="wrapper">
                        <article class="grid_8">
                            <h4>&nbsp;</h4>
                      </article>
                      <article class="grid_4">
                       	  <h4 class="indent-bot">&nbsp;</h4>
                          <p class="p1">By Rihab Farhat  &copy; 2014 </p>
                          <p class="p1"> Lycée Mdhilla ( Gestionnaire D'absence ) </p>
                      </article>
                    </div>
                </div>
            </div>
        </div>
</footer>
	<script type="text/javascript"> Cufon.now(); </script>
</body>
</html>
