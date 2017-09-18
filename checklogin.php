<?
ob_start();
session_start();

require("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Untitled Document</title>
</head>

<body background="wall/wall4.jpg" >
  <?php
  $sql = "select * from user where User_Name='".$_POST["username"]."' and User_PWD='".$_POST["password"]."';";
  $dbquery = mysql_query($sql);
  $result= mysql_fetch_array($dbquery);
  if($result)
  {
    $_SESSION["User_ID"] = $result["User_ID"];
    $_SESSION["User_Name"] = $result["User_Name"];
    $_SESSION["User_RName"] = $result["User_RName"];
    $_SESSION["User_Email"] = $result["User_EMail"];
    $_SESSION["User_Status"] = $result["User_Status"];
    $_SESSION["User_Sale_No"] = $result["Sale_No"];
    $_SESSION["Status"] = "yes";

    print "<SCRIPT>window.location='index.php'</SCRIPT>";
  }
  else
  {
    $_SESSION["Status"] = "no";
    session_unset();
    session_destroy();

    echo '<script language="javascript">';
    echo 'alert("ชื่อผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง")';
    echo '</script>';
    print "<SCRIPT>window.location='login.php'</SCRIPT>";
  }
  ?>
</body>
</html>
