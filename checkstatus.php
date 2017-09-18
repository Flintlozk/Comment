<?
if($_SESSION["Status"] == "yes"){

}
else {
  session_unset();
  session_destroy();
  echo '<script language="javascript">';
  echo '</script>';
  print "<SCRIPT>window.location='login.php'</SCRIPT>";
}
?>
