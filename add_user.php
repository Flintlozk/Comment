<?
require("connect.php");

$User_Name = $_POST["textusername"];
$User_PWD = $_POST["textpassword"];
$User_RName = $_POST["textrealname"];
$User_Email = $_POST["textemail"];
$User_Status = $_POST["textstatus"];
$Sale_No = $_POST["textsaleno"];

$sql = "Select User_Name,User_Email FROM user WHERE User_Name = '$User_Name'";
$result = mysql_query($sql) or die(mysql_error());
$row = mysql_fetch_array($result);
$dbUsername = $row["User_Name"];
$dbUseremail = $row["User_Email"];

if($User_Name == $dbUsername || $User_Email == $dbUseremail){
  echo '<script language="javascript">';
  echo 'alert("! ! ! ชื่อผู้ใช้งานหรืออีเมลล์ซ้ำ ! ! !")';
  echo '</script>';
  print "<SCRIPT>window.location='newuser.php'</SCRIPT>";
}else{
  $sqlser="insert into user (User_Name,User_PWD,User_RName,User_Email,User_Status,Sale_No)
  values ('".$User_Name."',
  '".$User_PWD."',
  '".$User_RName."',
  '".$User_Email."',
  '".$User_Status."',
  '".$Sale_No."')";

  $queryser=mysql_query($sqlser) or die(mysql_error());
  print "<SCRIPT>window.location='newuser.php'</SCRIPT>";
}
?>
