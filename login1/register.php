<?php require_once('User_Information.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "registration")) {
  $insertSQL = sprintf("INSERT INTO users (username, password, email) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mysql_select_db($database_User_Information, $User_Information);
  $Result1 = mysql_query($insertSQL, $User_Information) or die(mysql_error());

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_User_Information, $User_Information);
$query_User_Request = "SELECT * FROM users";
$User_Request = mysql_query($query_User_Request, $User_Information) or die(mysql_error());
$row_User_Request = mysql_fetch_assoc($User_Request);
$totalRows_User_Request = mysql_num_rows($User_Request);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>SUCCESSFUL LOGIN</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {margin:0;}
ul.topnav {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li a {
  display: inline-block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  transition: 0.3s;
  font-size: 17px;
}

ul.topnav li a:hover {background-color: #555;}

ul.topnav li.icon {display: none;}

@media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
}

@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }
  
}
body{
	background-color:#ffffb3;
	
}
h1 {
    color:#0000ff;
}
</style>
</head>

<body>
<!--<div id='pq'><img src="C:\Users\Bhoomika R Rao\Desktop\abstract-colorful-wallpapers-full-hd.jpg"
height='100%' width='100%' ></div>-->

<div class="row" style="background-color:white;">
  
		<div class="col-md-2" style="background-color:white;"><img src="34.png" style="float:left;margin-left:60px;"><br><br></div>
		<p  style="font-size:600%;" "font-family:courier;" style="color:red;" "text-align:middle;"><b>SpicePool<b></p>
</div>
<ul class="topnav" id="myTopnav">
       <li><a class="active" href="dumfp - Copy.html"><b>HOME</b></a></li>
  <li><a class="active" href="article.html"><b>ARTICLES</b></a></li>
  <li><a class="active" href="vegrecipe.html"><b> RECIPES</b></a></li>
   <li><a class="active" href="hv.html"><b>GO BAKING</b></a></li>
  <li><a class="active" href="#about"><b>REVIEWS</b></a></li>
  <li><a class="active" href="deitandex.html"><b>HEALTH-TIPS</b></a></li>
  <li><a class="active" href="#about"><b>VIDEOS</b></a></li>
  <li><a class="active" href="index.php"><b>LOGIN</b></a></li>
  <li class="icon">
    <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
  </li>
</ul>

<div style="padding-left:16px">
  
</div>

<h1><center>Register</center></h1>
<form method="POST" action="<?php echo $editFormAction; ?>" name="registration">
<center><label>Username:</label><br/></center>
<center><input name="username" type="text" required="required"><br/></center>
<center><label><center>Password:</center></label><br/></center>
<center><input name="password" type="password" required="required"><br/></center>
<center><label><center>Email:</center></label><br/></center>
<center><input name="email" type="email" required="required"><br/></center>
<center><input type="submit" value="Register"></center>
<input type="hidden" name="MM_insert" value="registration"></center>
</form>
<center>Already have an account?<a href="login.php"><center>Login!</a></center>
</body>
</html>
<?php
mysql_free_result($User_Request);
?>
