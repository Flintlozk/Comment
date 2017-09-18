<?
ob_start();
session_start();
include_once('checkstatus.php');
if ($_SESSION["User_Name"]) {
}
else if (isset($_SESSION["User_Name"]))
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
td{
  -ms-word-break: break-all;
  word-break: break-all;


  word-break: break-word;

  -webkit-hyphens: auto;
  -moz-hyphens: auto;
  hyphens: auto;
}

</style>
<?
function DateThai($strDate) //แปลง Date/Time = Thai Date/Time
{
  $strYear = date("Y",strtotime($strDate))+543;
  $strMonth= date("m",strtotime($strDate));
  $strDay= date("j",strtotime($strDate));
  $strHour= date("H",strtotime($strDate));
  $strMinute= date("i",strtotime($strDate));
  $strSeconds= date("s",strtotime($strDate));

  return "$strDay-$strMonth-$strYear $strHour:$strMinute น.";
}
$strDate = date("d-m-Y"); //เวลาปัจจุบัน อิงจากเวลา Server


//SQL Query Section



?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page xheader) -->
  <section class="content-header">
    <h1>
      Comment
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
          <div class="box-body">

              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th class="visible-md visible-lg"><div align="center">วันที่</div></th>
                    <th class="visible-md visible-lg"><div align="center">ชื่อลูกค้า</div></th>
                    <th class="visible-md visible-lg"><div align="center">ชื่อเซลล์</div></th>
                    <th class="visible-md visible-lg"><div align="center">จังหวัด</div></th>
                    <th class="visible-md visible-lg" width="40%"><div align="center">คอมเมนต์</div></th>
                    <th class="visible-md visible-lg"></th>
                    <th class="visible-xs visible-sm">รายละเอียด</th>
                  </tr>
                </thead>
                <tbody>

                  <?
                  if($_SESSION["User_Status"] == 'admin'){
                    $sql = "SELECT customer.Cus_ID,Cus_No,Cus_Name,PROVINCE_Name,Comment_Text,Comment_Time,Sale_No,Sale_Name
                    FROM customer,province,comment_list
                    WHERE customer.Cus_Province = province.PROVINCE_ID
                    AND customer.Cus_ID = comment_list.Cus_ID
                    ORDER BY Comment_Time DESC";
                  }else if($_SESSION["User_Status"] == 'user'){
                    $sql = "SELECT customer.Cus_ID,Cus_No,Cus_Name,PROVINCE_Name,Comment_Text,Comment_Time,Sale_No,Sale_Name
                    FROM customer,province,comment_list
                    WHERE customer.Cus_Province = province.PROVINCE_ID
                    AND customer.Cus_ID = comment_list.Cus_ID
                    AND customer.Sale_No = '$_SESSION[User_Sale_No]'
                    ORDER BY Comment_Time DESC";
                  }
                  $result = mysql_query($sql) or die(mysql_error());

                  while($row = mysql_fetch_array($result)){
                    $Cus_ID = $row['Cus_ID'];
                    $Cus_No = $row['Cus_No'];
                    $Cus_Name = $row['Cus_Name'];
                    $Cus_Province  = $row['PROVINCE_Name'];
                    $Comment_Text = $row['Comment_Text'];
                    $Comment_Time = $row['Comment_Time'];
                    $Sale_Name = $row['Sale_Name'];
                    ?>
                    <tr  onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'">
                      <td class="visible-md visible-lg" style="cursor:pointer;"><div align="center"><?=DateThai($Comment_Time)?></div></td>
                      <td class="visible-md visible-lg" style="cursor:pointer;"><div align="left"><div style=" color:#3c8dbc; font-weight:bold; text-align:left;"><?=$Cus_Name?></div></div></td>
                      <td class="visible-md visible-lg" style="cursor:pointer;"><div align="center"><?=$Sale_Name?></div></td>
                      <td class="visible-md visible-lg" style="cursor:pointer;"><div align="center"><?=$Cus_Province?></div></td>
                      <td class="visible-md visible-lg" style="cursor:pointer;"><div align="left"><?=$Comment_Text?></div></td>
                      <td class="visible-md visible-lg" style="cursor:pointer;"><div align="center"><button class="btn btn-default" onclick="window.document.location='./c_profile.php?c=<?=$Cus_ID?>'">เพิ่มเติม</button></div></td>

                      <td class="visible-xs visible-sm">
                      <div align="left">
                        <div class="panel panel-white post panel-shadow">

                          <div class="post-heading">
                            <div class="pull-left meta">
                              <div class="title h5">
                                <font color="#4a84e2"><b><?=$Cus_Name?></b></font><br>
                                <font size='2pt'><?=$Cus_Province?></font><br>
                                <font size='2pt'><?=$Sale_Name?></font><br>
                              </div>
                              <h6 class="text-muted time"><?=DateThai($Comment_Time);?></h6>
                              <span>
                                <p><?=$Comment_Text?></p>
                              </span>
                            </div>

                          </div>
                        </div>
                      </div>
                    </td>
                    </tr>
                  <? }?>

                </tbody>
                <tfoot>
                  <tr>

                  </tr>
                </tfoot>
              </table>
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
var isBusy=false;
var currIdx=0;
var currPo='';
var tbl;
$(function () {
  /*
  $('.keyInChk').on('input change',function(){
  $('#loadingAni').addClass('busy');
  $.get('index.php',{todo:'isKeyIn',id:$(this).attr('id').replace('chk',''),val:($(this).is(':checked'))?'yes':'no'},function(){
  $('#loadingAni').removeClass('busy');
});
});
*/
tbl=$("#example1").DataTable({
  "iDisplayLength": 50
});
});
</script>
<!-------------------------------------------------------- Sort Table by fnSort----------------------------------------------------------------->
<script>
$(document).ready(function() {
  var oTable = $('#example1').dataTable();
  // Sort immediately with columns 0 and 1
  oTable.fnSort( [ [0,'desc'] ] );
} );
</script>
</body>
</html>
