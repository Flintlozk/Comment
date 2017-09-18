<?
ob_start();
session_start();
include_once('checkstatus.php');
if ($_SESSION["User_Name"]) {
}
else if (isset($_SESSION["textuser"]))
{
  session_unset();
  session_destroy();
  echo '<script language="javascript">';
  echo 'alert("Sessions Timeout")';
  echo '</script>';
  print "<SCRIPT>window.location='login.php'</SCRIPT>";
}
include_once('_header.php');
include_once('sidebar.php');
require("connect.php");

date_default_timezone_set('Asia/Bangkok');
?>
<style>
.keyInChk{
  transform:scale(1.4);
}
</style>
<?
$sql = "SELECT User_ID,User_Name,User_PWD,User_RName,User_Email,User_Status,Sale_No FROM user WHERE User_ID = '$_GET[u]'";
$result = mysql_query($sql) or die(mysql_error());

$row = mysql_fetch_array($result);
$User_ID = $row["User_ID"];
$User_Name = $row["User_Name"];
$User_PWD = $row["User_PWD"];
$User_RName = $row["User_RName"];
$User_Email = $row["User_Email"];
$User_Status = $row["User_Status"];
$Sale_No = $row["Sale_No"]
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page xheader) -->
  <section class="content-header">
    <h1>
      แก้ไข้ข้อมูลผู้ใช้งาน
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">

            <section class="content-header">
              <h1>

              </h1>
            </section>
            <section class="content">
              <form name="loginForm" action="insert_edit_user.php" method="post">
                <div class="form-group has-feedback">
                  <label>
                    ชื่อผู้ใช้งาน <font color="red">*</font>
                  </label>
                  <input type="hidden" name="textuserid"  value="<?=$User_ID?>"/>
                  <input name="textusername" id='username' type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" value="<?=$User_Name?>" required>
                </div>

                <div class="form-group has-feedback">
                  <label>
                    รหัสผ่าน <font color="red">*</font>
                  </label>
                  <input name="textpassword" id='password' type="text" class="form-control" placeholder="รหัสผ่าน" value="<?=$User_PWD?>" required>
                </div>

                <div class="form-group has-feedback">
                  <label>
                    หมายเลขเซลล์ <font color="red">*</font>
                  </label>
                  <input name="textsaleno" id='username' type="text" class="form-control" style="text-transform: uppercase;" placeholder="หมายเลขเซลล์" value="<?=$Sale_No?>" required>
                </div>

                <div class="form-group has-feedback">
                  <label>
                    ชื่อ-สกุล <font color="red">*</font>
                  </label>
                  <input name="textrealname" id='userrname' type="text" class="form-control" placeholder="ชื่อ-สกุล" value="<?=$User_RName?>" required>
                </div>
                <div class="form-group has-feedback">
                  <label>
                    E-Mail <font color="red">*</font>
                  </label>
                  <input name="textemail" id='email' type="email" class="form-control" placeholder="E-Mail" value="<?=$User_Email?>" required>
                </div>
                <div class="form-group has-feedback">
                  <label>
                    สถานะ <font color="red">*</font>
                  </label>
                  <select name="textstatus" id='status' class="form-control" >
                    <option value="user" <?if($User_Status =="user"){echo "selected";}?>>ผู้ใช้งาน</option>
                    <option value="admin" <?if($User_Status =="admin"){echo "selected";}?>>ผู้ดูแล</option>
                  </select>
                </div>

                <div class="row">
                  <div class="col-xs-8">
                    <div class="checkbox icheck">
                    </div>
                  </div><!-- /.col -->
                  <div class="col-xs-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary btn-block btn-flat" role="group" value="ตกลง"/>
                    </div>
                  </div><!-- /.col -->
                </div>
              </form>
            </section>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<? include_once('_js.php');?>
<script>
var isBusy=false;
var currIdx=0;
var currPo='';
var tbl;
$(function () {
  tbl=$("#example1").DataTable({
    "iDisplayLength": 10
  });
});
</script>
</body>

<!-- Sort Table by fnSort----------------------------------------------------------------->


<script>
$(document).ready(function() {
  var oTable = $('#example1').dataTable();
  oTable.fnSort( [ [1,'asc'] ] );
});
</script>
</body>
</html>
