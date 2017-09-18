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
hr{
  margin: 5px 5px;
  background-color: #FF9F00;
}
span {
  -ms-word-break: break-all;
  word-break: break-all;

  /* Non standard for webkit */
  word-break: break-word;

  -webkit-hyphens: auto;
  -moz-hyphens: auto;
  hyphens: auto;
}
#nav{
  color:white;
  font-weight: bold;
  text-align:center;
  width:20px;
  display:inline-block;
  margin:5px;
  padding:5px 5px;
  cursor:default;
  -moz-border-radius: 2px;
  border-radius: 2px;
  border-color: #367fa9;
  border-style: solid;
  border-width: 1px;
  background-color:#3c8dbc;

}
#nav:hover{
  border-color: #204d74;
  background-color:#367fa9;
  cursor:pointer;
}
.pagination{
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
$sql = "SELECT Cus_ID,Cus_No,Cus_Name,Cus_Addr,DISTRICT_Name,AMPHUR_Name,PROVINCE_Name,Cus_Postcode,Cus_Phone,Cus_Tel,Cus_Fax,Cus_Line,Cus_Email
FROM customer,province,amphur,district
WHERE customer.Cus_Province = province.PROVINCE_ID
AND customer.Cus_City = amphur.AMPHUR_ID
AND customer.Cus_District = district.DISTRICT_ID
AND Cus_ID = '$_GET[c]'";
$result = mysql_query($sql) or die(mysql_error());

$row = mysql_fetch_array($result);
$Cus_ID = $row['Cus_ID'];
$Cus_No = $row['Cus_No'];
$Cus_Name = $row['Cus_Name'];
$Cus_Addr = $row['Cus_Addr'];
$Cus_District = $row['DISTRICT_Name'];
$Cus_City = $row['AMPHUR_Name'];
$Cus_Province  = $row['PROVINCE_Name'];
$Cus_Postcode = $row['Cus_Postcode'];
$Cus_Phone  = $row['Cus_Phone'];
$Cus_Tel  = $row['Cus_Tel'];
$Cus_Fax  = $row['Cus_Fax'];
$Cus_Line = $row['Cus_Line'];
$Cus_Email  = $row['Cus_Email'];

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
      <div class="col-xs-12">

        <div class="box box-primary">
          <div class="box-body">

            <div class="row">
              <div class="card">
                <div class="col-lg-4  col-md-4 col-sm-12 col-xs-12">
                  <div class="card-header">
                    <h3><?=$Cus_No?></h3>
                    <h4><?=$Cus_Name?></h3>

                      <!--<h4><?="หมายเลขลูกค้า ",$Cus_ID?></h4>-->

                    </div>

                  </div>
                  <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="card-block">
                      <h4 class="card-title" color="#75aaff"><u>ข้อมูลส่วนตัว</u></h4>
                      <p class="card-text">
                        <label>
                          ที่อยู่ปัจจุบัน
                        </label><br>
                        <?=$Cus_Addr?>
                        ต.<? if($Cus_District){echo $Cus_District;}else {echo "-";}?>
                        อ.<? if($Cus_City){echo $Cus_City;}else {echo "-";}?>
                        จ.<? if($Cus_Province){echo $Cus_Province;}else {echo "-";}?>
                        <?=$Cus_Postcode?><br>
                        <b>มือถือ</b> <? if($Cus_Phone){echo $Cus_Phone;}else {echo "-";}?><br>
                        <b>โทรศัพท์</b> <? if($Cus_Tel){echo $Cus_Tel;}else {echo "-";}?><br>
                        <b>Fax</b> <? if($Cus_Fax){echo $Cus_Fax;}else {echo "-";}?><br>
                        <b>Line ID</b> <? if($Cus_Line){echo $Cus_Line;}else {echo "-";}?><br>
                        <b>E-Mail</b> <? if($Cus_Email){echo $Cus_Email;}else {echo "-";}?>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <hr>
              <h4>แสดงความคิดเห็น</h4>

              <form method="post" action="insert_comment.php" >
                <div class="form-group">
                  <input type="hidden" name="cusid_hid" value="<?=$Cus_ID?>"/>
                  <input type="hidden"  name="userid_hid" value="<?=$_SESSION['User_ID']?>"/>
                  <textarea name="text_comment" cols="auto" rows="4" class="form-control"></textarea><br/>
                  <div align="center">
                    <input type="submit" name="btn_submit" width="100%" value="เพิ่มความคิดเห็น" class="btn btn-primary btn-block"/>
                  </div>
                </div>
              </form>
            </div><!-- /.box-body -->
          </div><!-- /.box -->


          <!-- Add Comment -->
          <?

          //Keep Cus_No,Comment_ID,Comment_txt,User_ID
          //

          ?>
              <!-- View Comment -->
              <?
              $Start_Page = 0;
              $End_Page = 20;
              $csql = "SELECT Comment_No,Comment_Text,Comment_Time,Cus_ID,user.User_ID,User_Name,User_RName
              FROM comment_list,user
              WHERE  comment_list.User_ID = user.User_ID
              AND Cus_ID = $_GET[c]
              ORDER BY Comment_No DESC,Comment_Time DESC";
              $cresult = mysql_query($csql) or die(mysql_error());
              ?>



              <div id="content">
                <?
                while($crow = mysql_fetch_array($cresult)){ //Start While
                  $Comment_No = $crow["Comment_No"];
                  $Comment_Text = $crow["Comment_Text"];
                  $Comment_Time = $crow["Comment_Time"];
                  $Comment_User_ID = $crow["User_ID"];
                  $Comment_User = $crow["User_Name"];
                  $Comment_RName = $crow["User_RName"];


                  ?>


                  <div class="element">

                    <div class="box box-primary">
                      <div class="box-body">
                    <div class="row">
                      <div class="col-sm-8">

                        <div class="panel panel-white post panel-shadow">

                          <div class="post-heading">
                            <div class="pull-left meta">
                              <div class="title h5">
                                <font color="#4a84e2"><b><?=$Comment_User?></b></font> <font size='2pt'><?=$Comment_RName?></font>
                              </div>
                              <h6 class="text-muted time"><?=DateThai($Comment_Time);?></h6>

                              <div class="collapse in" id="com<?=$Comment_No?>">
                                <span>
                                <p><?=$Comment_Text?></p>
                                </span>
                              </div>
                            </div>
                          </div>
                          <div class="collapse" id="edit<?=$Comment_No?>">
                              <form name="editcomment" method="POST" action="edit_comment.php">
                                <span>
                                  <input type="hidden" name="commentno" value="<?=$Comment_No?>">
                                  <input type="hidden" name="cusid" value="<?=$_GET[c]?>">
                                  <textarea name="commenttext" onclick="textAreaAdjust(this)" style="min-width:100%;" width="100%" class="form-control" rows="3" cols="auto"><?=$Comment_Text?></textarea>
                                  <br>
                                  <input type="submit" name="edit" class="btn btn-primary btn-sm" value="แก้ไข"/>
                                  <input type="button" name="edit2" class="btn btn-default btn-sm" value="ยกเลิก" data-toggle="collapse"  data-target="#edit<?=$Comment_No?>,#com<?=$Comment_No?>"/>
                                </span>
                            </form>
                          </div>
                        </div>

                      </div>
                      <? if($_SESSION["User_Name"] == $Comment_User){?>
                        <a id="<?=$Comment_No?>" href="" class="pull-right delbutton" style="margin:10px;">
                          <font color="#FF7777">
                            <span class="glyphicon glyphicon-remove"> </span>
                          </font>
                        </a>
                        <a class="pull-right" style="margin:10px; cursor:pointer;" data-toggle="collapse"  data-target="#edit<?=$Comment_No?>,#com<?=$Comment_No?>">
                          <font color="#4a84e2">
                            <span class="glyphicon glyphicon-wrench"></span>
                          </font>
                        </a>
                      <? }else{}?>

                    </div><!-- /.row -->
                  </div><!-- /.box -->
                </div><!-- /.col -->

                </div>


                <? }?><!-- End While -->
              </div>

              <div align='center'>
                <div class="pagination">
                </div>
              </div>

              <?/*<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <form name="editc" method="POST" action="edit_comment.php">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">แก้ไขคอมเมนต์</h4>
                    </div>
                    <div class="modal-body">
                      <font color='red'>***** ยังไม่สามารถใช้งานได้ *****</font>
                      <textarea class="form-control" rows='10'></textarea>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                      <input type="submit" class="btn btn-primary" value="บันทึก"/>
                    </div>
                  </div>
                </div>
              </form>
              </div>
              */?>

        </div><!-- /.row -->
      </div>
    </section><!-- /.content -->


  </div><!-- /.content-wrapper -->

</div><!-- ./wrapper -->



<? include_once('_js.php');?>

<script type="text/javascript">
$(document).ready(function(){

  var perpage=10;	// จำนวนรายการต่อหนึ่งหน้า
  var allNum = $("div#content div.element").length;  // นับจำนวน ข้อมูลทั้งหมดว่ามีกี่ชุด
  var paginator="";	// สร้าง navigator
  for(i=1; i<=Math.round(parseInt(allNum)/parseInt(perpage)); i++){
    paginator += "<span id='nav'>" + i + "</span>";
  }

  $("div.pagination").each(function(){
    $(this).html(paginator);
  });

  // ทำการแทรก div เพื่อกำกับเลขหน้า  นับตามจำนวนรายการต่อหนึ่งหน้า
  var count=0,
  pagecount=1,
  regenerator="<div class='page"+pagecount+"' for='all'>";
  $("div#content div.element").each(function(){
    count++;
    regenerator += "<div>"+$(this).html()+"</div>";
    if(!(count%perpage)){
      pagecount++;
      regenerator +="</div><div class='page"+pagecount+"' for='all'>";
    }
  });
  regenerator +="</div>";
  $("div#content").empty().html(regenerator);
  $("div[for=all]").hide();	//ซ่อนข้อมูลทั้งหมดก่อน
  $("div.page1").show(400);	//แสดงเฉพาะหน้าที่ 1
  //ดักการกดคีย์บอร์ดที่ navigator-page number ที่้ด้านบนและล่างของจอภาพ
  $("div.pagination span#nav").click(function(){
    var index = $(this).text();
    $("div[for=all]").hide(400);
    $("div.page"+index).show(400);
  });

});


</script>

<script>
var isBusy=false;
var currIdx=0;
var currPo='';
var tbl;
$(function () {
  tbl=$("#example1").DataTable();
});
</script>
<script type="text/javascript" >
$(function() {
  $(".delbutton").click(function() {
    var del_id = $(this).attr("id");
    var info = 'id=' + del_id;
    if (confirm("Are you sure?")) {
      $.ajax({
        type : "POST",
        url : "./scripts/delete_entry.php", //URL to the delete php script
        data : info,
        success : function() {
        }
      });
      setInterval(refreshPartial, 1000)
    }
    return false;
  });
});
</script>

<script>
$(document).ready(function() {
var comment_id;
var edit_window = $("#frmEdit").dialog({autoOpen: false,
    height: 280,
    width: 480,
    modal: true});

var add_window = $("#frmAdd").dialog({
  autoOpen: false,
  height: 280,
  width: 480,
  modal: true,
  buttons: {
  "Post": addComment
  },
  close: function() {
  add_window.dialog( "close" );
  }
});

function addComment() {
  add_window.dialog( "close" );
  callCrudAction('add','');
}

$( "#btnAddAction" ).button().on( "click", function() {
  add_window.dialog( "open" );
});

$( ".btnEditAction").button().on( "click", function() {
  openEditBox($(this).attr("id"));
});
});

function openEditBox(id) {
edit_window = $("#frmEdit").dialog({
    buttons: {
      "Edit": editComment
    },
    close: function() {

      edit_window.dialog( "close" );
    }
  });
edit_window.dialog( "open" );
comment_id = id;
var message = $("#message_" + comment_id + " .message-content").html();
$("#edit-message").val(message);
}

function editComment() {
edit_window.dialog( "close" );
callCrudAction('edit',comment_id);
}
</script>
<script>
function textAreaAdjust(o) {
  o.style.height = "1px";
  o.style.height = (25+o.scrollHeight)+"px";
}
</script>

</body>
</html>
