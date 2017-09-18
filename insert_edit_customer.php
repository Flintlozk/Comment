<?
include_once('checkstatus.php');
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

            $sqlser="UPDATE customer SET Cus_Name='".$_POST["textCus_Name"]."',
            Cus_No='".$_POST["textCus_No"]."',
            Cus_Addr='".$_POST["textCus_Addr"]."',
            Cus_District='".$_POST["district"]."',
            Cus_City='".$_POST["amphur"]."',
            Cus_Province='".$_POST["province"]."',
            Cus_Postcode='".$_POST["textCus_Postcode"]. "',
            Cus_Phone='".$_POST["textCus_Phone"]."',
            Cus_Tel='".$_POST["textCus_Tel"]."',
            Cus_Fax='".$_POST["textCus_Fax"]."',
            Cus_Line='".$_POST["textCus_Line"]."',
            Cus_Email='".$_POST["textCus_Email"]."'
            WHERE Cus_ID ='".$_POST["textCus_ID"]."'";

            $queryser=mysql_query($sqlser);
            //print "<SCRIPT>window.location='edit_customer.php?c=".$_POST["textCus_ID"]."'</SCRIPT>";
            print "<SCRIPT>window.location='index.php'</SCRIPT>";
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
