<?
ob_start();
session_start();
session_unset();
session_destroy();
session_write_close();
setcookie(session_name(),'',0,'/');
session_regenerate_id(true);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logout</title>
</head>

  <?
 	print "<SCRIPT>alert('ออกจากระบบสำเร็จ')</SCRIPT>";
	print "<SCRIPT>window.location='login.php'</SCRIPT>";
	?>
</body>
</html>
