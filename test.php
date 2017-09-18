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
.badge {
  padding: 1px 9px 2px;
  font-size: 12.025px;
  font-weight: bold;
  white-space: nowrap;
  color: #ffffff;
  background-color: #999999;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}
.badge:hover {
  color: #ffffff;
  text-decoration: none;
  cursor: pointer;
}
.badge-new {
  background-color: #b94a48;
}
.badge-new:hover {
  background-color: #953b39;
}
.badge-old {
  background-color: #3a87ad;
}
.badge-old:hover {
  background-color: #2d6987;
}
.keyInChk{
  transform:scale(1.4);
}
</style>

<?
$DateSet = Date("Y-m-d 0:00:00");

$gsql = "SELECT GEO_ID,GEO_Name FROM GEO";
$gresult = mysql_query($gsql) or die(mysql_error());

  if($_GET["g"]){
    if($_SESSION["User_Status"] == 'admin'){
      $sql = "SELECT Cus_ID,Cus_No,Cus_Name,Cus_Addr,Cus_City,PROVINCE_Name,Cus_Postcode,Cus_Phone,Cus_Tel,Cus_Fax,Cus_Line,Cus_Email
      FROM customer,province
      WHERE customer.Cus_Province = province.PROVINCE_ID
      AND Geo_ID = $_GET[g]
      ORDER BY Cus_ID ASC";
      }else if($_SESSION["User_Status"] == 'user'){
        $sql = "SELECT Cus_ID,Cus_No,Cus_Name,Cus_Addr,Cus_City,PROVINCE_Name,Cus_Postcode,Cus_Phone,Cus_Tel,Cus_Fax,Cus_Line,Cus_Email,user.Sale_No,Sale_Name
        FROM customer,province,user
        WHERE customer.Cus_Province = province.PROVINCE_ID
        AND user.Sale_No = customer.Sale_No
        AND Geo_ID = $_GET[g]
        AND customer.Sale_No = '$_SESSION[User_Sale_No]'
        ORDER BY Cus_ID ASC";
      }
    }else{
      if($_SESSION["User_Status"] == 'admin'){
        $sql = "SELECT Cus_ID,Cus_No,Cus_Name,Cus_Addr,Cus_City,PROVINCE_Name,Cus_Postcode,Cus_Phone,Cus_Tel,Cus_Fax,Cus_Line,Cus_Email
        FROM customer,province
        WHERE customer.Cus_Province = province.PROVINCE_ID
        ORDER BY Cus_ID ASC";
        }else if($_SESSION["User_Status"] == 'user'){
          $sql = "SELECT Cus_ID,Cus_No,Cus_Name,Cus_Addr,Cus_City,PROVINCE_Name,Cus_Postcode,Cus_Phone,Cus_Tel,Cus_Fax,Cus_Line,Cus_Email,user.Sale_No,Sale_Name
          FROM customer,province,user
          WHERE customer.Cus_Province = province.PROVINCE_ID
          AND user.Sale_No = customer.Sale_No
          AND customer.Sale_No = '$_SESSION[User_Sale_No]'
          ORDER BY Cus_ID ASC";
        }
    }
$result = mysql_query($sql) or die(mysql_error());

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page xheader) -->
  <section class="content-header">
    <h1>
      ข้อมูลลูกค้า
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-lg-12 col-xs-12">
        <div class="box box-primary">
          <div class="box-body">

            <form name="Select_Geo" method="GET" action="index.php?d=">


               <div class="col-xs-6 col-md-2">
                  <a href='add_customer.php' >
                    <div class="btn btn-primary" style="width: 100%;">
                    <span class="glyphicon glyphicon-plus"></span>
                    เพิ่มลูกค้า
                  </div>
                  </a>
                </div>

                <div class="col-xs-6 col-md-2">
                  <select name="g" class="form-control input-md" onchange="this.form.submit();">
                    <? if($_GET["g"]){?>
                      <option value="">แสดงทั้งหมด</option>
                    <? }else{?><option value="">-- ภูมิภาค --</option>
                    <?
                  }
                  while($grow = mysql_fetch_array($gresult)){
                    $GEO_ID = $grow["GEO_ID"];
                    $GEO_Name = $grow["GEO_Name"];
                    ?>
                    <option value="<?=$GEO_ID?>" <? if($_GET["g"] == $GEO_ID){echo 'selected';}?>><?=$GEO_Name?></option>
                  <? }?>
                </select>

              </div>
          </form>

          <br>
          <br>


          <div class="col-lg-12 col-md-12 col-sm-12">
              <table id="example1" class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                  <tr>
                    <th class="visible-xs visible-sm visible-md visible-lg" width="10"><div align="center"></div></th>
                    <th class="visible-md visible-lg" width="75" class=""><div align="center">รหัสลูกค้า</div></th>
                    <th class="visible-xs visible-sm visible-md visible-lg" width=""><div align="center">ชื่อ</div></th>
                    <th class="visible-md visible-lg"><div align="center">จังหวัด</div></th>
                    <th class="visible-md visible-lg"><div align="center">เบอร์โทร</div></th>
                    <th class="visible-md visible-lg"><div align="center">อีเมลล์</div></th>
                    <th class="visible-md visible-lg" width="15"></th>
                    <th class="visible-md visible-lg" width="15"></th>
                  </tr>
                </thead>
                <tbody>

                  <?
                  while($row = mysql_fetch_array($result)){
                    $i++;
                    $Cus_ID = $row['Cus_ID'];
                    $Cus_No = $row['Cus_No'];
                    $Cus_Name = $row['Cus_Name'];
                    $Cus_Addr = $row['Cus_Addr'];
                    $Cus_City = $row['Cus_City'];
                    $Cus_Province  = $row['PROVINCE_Name'];
                    $Cus_Postcode = $row['Cus_Postcode'];
                    $Cus_Phone  = $row['Cus_Phone'];
                    $Cus_Tel  = $row['Cus_Tel'];
                    $Cus_Fax  = $row['Cus_Fax'];
                    $Cus_Line = $row['Cus_Line'];
                    $Cus_Email  = $row['Cus_Email'];

                    $ccmsql = "SELECT COUNT(Comment_No) as CCount ,MAX(Comment_Time) as CTime,Cus_ID
                              FROM comment_list
                              WHERE Cus_ID = $Cus_ID";
                    $ccmresult = mysql_query($ccmsql) or die(mysql_error());
                    $ccmrow = mysql_fetch_array($ccmresult);
                      $CCount = $ccmrow["CCount"];
                      $CTime = $ccmrow["CTime"];

                    ?>

                    <tr>
                      <td class="visible-xs visible-sm visible-md visible-lg" onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;"><div align="center"><?=$i?></div></td>
                      <td class="visible-md visible-lg"  onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;"><div align="center"><?=$Cus_No?></div></td>

                      <td class="visible-xs visible-sm visible-md visible-lg"  onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;" class="align-middle">
                        <div style=" color:#3c8dbc; font-weight:bold; text-align:left;">

                          <div class="pull-right" >
                            <? if($CTime < $DateSet) {?>
                              <span class="badge badge-old">
                                <?=$CCount?>
                              </span>
                            <? } else {?>
                              <span class="badge badge-new">
                                <?=$CCount?>
                              </span>
                            <? }?>
                          </div>
                            <?=$Cus_Name?> 
                        </div>
                      </td>

                      <td class="visible-md visible-lg"  onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;"><div align="center"><?=$Cus_Province?></div></td>
                      <td class="visible-md visible-lg" onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;"><div align="center"><?=$Cus_Phone?></div></td>
                      <td class="visible-md visible-lg" onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;" ><div align="center"><?=$Cus_Email?></div></td>
                      <td class="visible-md visible-lg" onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'" style="cursor:pointer;">
                        <button class="btn btn-default">
                          <a href="./c_profile.php?c=<?=$Cus_ID?>">
                            <span class='fa fa-user'></span>
                          </a>
                        </button></td>
                        <td class="visible-md visible-lg">
                          <button class="btn btn-default" onclick="window.document.location='./edit_customer.php?c=<?=$Cus_ID?>'">
                            <a href="./edit_customer.php?c=<?=$Cus_ID?>"><span class='fa fa-wrench'></span></a>
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
            </div>
            <br/>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->

  </section><!-- /.content -->
</div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->

<? include_once('_js.php');?>
<script>

</script>

<script>
var isBusy=false;
var currIdx=0;
var currPo='';
var tbl;
$(function () {
  tbl=$("#example1").DataTable({
    "iDisplayLength": 50
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

</html>
