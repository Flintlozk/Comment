<?
include_once('_header.php');
include_once('sidebar.php');
require("connect.php");

include_once('selectgeo.js');

date_default_timezone_set('Asia/Bangkok');
?>
<style>
.keyInChk{
  transform:scale(1.4);
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page xheader) -->
  <section class="content-header">
    <h1>
      เพิ่มประวัติลูกค้า
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">
            <?
            $User_ID = $_POST["textuserid"];
            $User_Name = $_POST["textusername"];
            $User_PWD = $_POST["textpassword"];
            $User_RName = $_POST["textrealname"];
            $User_Email = $_POST["textemail"];
            $User_Status = $_POST["textstatus"];
            $Sale_No = $_POST["textsaleno"];

            $sqlser="UPDATE user SET User_Name='".$User_Name."',
            User_PWD='".$User_PWD."',
            User_RName='".$User_RName."',
            User_Email='".$User_Email."',
            User_Status='".$User_Status."',
            Sale_No = '".$Sale_No."'
            WHERE User_ID ='".$User_ID."'";

            $queryser=mysql_query($sqlser);
            //print "<SCRIPT>window.location='edit_customer.php?c=".$_POST["textCus_ID"]."'</SCRIPT>";
            print "<SCRIPT>window.location='newuser.php'</SCRIPT>";
            ?>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<? include_once('_js.php');?>




</body>
</html>
