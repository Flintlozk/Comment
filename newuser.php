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
$sql = "SELECT User_ID,User_Name,User_PWD,User_RName,User_Email,User_Status,Sale_No FROM user";
$result = mysql_query($sql) or die(mysql_error());
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page xheader) -->
  <section class="content-header">
    <h1>
      กำหนดสิทธิ์ผู้ใช้งาน
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
              <button class="btn btn-primary" id="adduser" data-toggle="collapse" data-target="#add" ><span class="glyphicon glyphicon-plus"></span> เพิ่มผู้ใช้งาน</button>
              <br><br>

                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th class="visible-xs visible-sm visible-md visible-lg" width="20"><div align="center">ID</div></th>

                      <th class="visible-xs visible-sm visible-md visible-lg" width="50"><div align="center">หมายเลขเซลล์</div></th>
                      <th class="visible-xs visible-sm visible-md visible-lg" width="150"><div align="center">ชื่อผู้ใช้งาน</div></th>
                      <th class="visible-md visible-lg"><div align="center">ชื่อ-สกุล</div></th>
                      <th class="visible-md visible-lg" width="80"><div align="center">สถานะ</div></th>
                      <th class="visible-md visible-lg"><div align="center">อีเมล์</div></th>
                      <th class="visible-md visible-lg" width="40">รหัสผ่าน</th>
                      <th class="visible-md visible-lg" width="20"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?
                    while($row = mysql_fetch_array($result)){
                      $User_ID = $row["User_ID"];
                      $User_Name = $row["User_Name"];
                      $User_PWD = $row["User_PWD"];
                      $User_RName = $row["User_RName"];
                      $User_Email = $row["User_Email"];
                      $User_Status = $row["User_Status"];
                      $Sale_No = $row["Sale_No"]
                      ?>
                      <tr>
                        <td class="visible-xs visible-sm visible-md visible-lg" onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div align="center"><?=$User_ID?></div></td>
                        <td class="visible-xs visible-sm visible-md visible-lg"  onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div style=" color:#3c8dbc; font-weight:bold; text-align:left;"><?=$Sale_No?></div></td>
                        <td class="visible-xs visible-sm visible-md visible-lg"  onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div style=" color:#3c8dbc; font-weight:bold; text-align:left;"><?=$User_Name?></div></td>
                        <td class="visible-md visible-lg" onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div align="center"><?=$User_RName?></div></td>
                        <td class="visible-md visible-lg" onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div align="left"><?=$User_Status?></div></td>
                        <td class="visible-md visible-lg" onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div align="center"><?=$User_Email?></div></td>
                        <td class="visible-md visible-lg" onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'" style="cursor:pointer;"><div align="center"><?=$User_PWD?></div></td>
                        <td class="visible-md visible-lg">
                          <button class="btn btn-default" onclick="window.document.location='./edit_user.php?u=<?=$User_ID?>'">
                            <a href="./edit_user.php?u=<?=$User_ID?>"><span class='fa fa-wrench'></span></a>
                          </button>
                        </td>
                      </tr>
                    <? }?>
                  </tbody>
                  <tfoot>
                    <tr>

                    </tr>
                  </tfoot>
                </table>

              <br>
              <br>

              <div id="add" class="collapse" >
                <form name="loginForm" action="add_user.php" method="post">
                  <div class="form-group has-feedback">
                    <label>
                      ชื่อผู้ใช้งาน <font color="red">*</font>
                    </label>
                    <input name="textusername" id='username' type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" autofocus required>
                  </div>
                  <div class="form-group has-feedback">
                    <label>
                      รหัสผ่าน <font color="red">*</font>
                    </label>
                    <input name="textpassword" id='password' type="password" class="form-control" placeholder="รหัสผ่าน" required>
                  </div>
                  <div class="form-group has-feedback">
                    <label>
                      หมายเลขเซลล์ <font color="red">*</font>
                    </label>
                    <input name="textsaleno" id='username' type="text" class="form-control" style="text-transform: uppercase;" placeholder="หมายเลขเซลล์" required>
                  </div>
                  <div class="form-group has-feedback">
                    <label>
                      ชื่อ-สกุล <font color="red">*</font>
                    </label>
                    <input name="textrealname" id='userrname' type="text" class="form-control" placeholder="ชื่อ-สกุล" required>
                  </div>
                  <div class="form-group has-feedback">
                    <label>
                      E-Mail <font color="red">*</font>
                    </label>
                    <input name="textemail" id='email' type="email" class="form-control" placeholder="E-Mail" required>
                  </div>
                  <div class="form-group has-feedback">
                    <label>
                      สถานะ <font color="red">*</font>
                    </label>
                    <select name="textstatus" id='status' class="form-control" >
                      <option value="user" selected>ผู้ใช้งาน</option>
                      <option value="admin" >ผู้ดูแล</option>
                    </select>
                  </div>

                  <div class="row">
                    <div class="col-xs-8">
                      <div class="checkbox icheck">
                      </div>
                    </div><!-- /.col -->
                    <div class="col-xs-12">
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block btn-flat" value="Register"/>
                      </div>
                    </div><!-- /.col -->
                  </div>
                </form>
              </div>
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
  oTable.fnSort( [ [0,'asc'] ] );
});
</script>

<script>
$('#adduser').on('shown',function(){
  $('#username').focus();
});
</script>
</body>
</html>
