<?
ob_start();
session_start();
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
//SQL Query Section
$sql = "SELECT Cus_ID,Cus_No,Cus_Name,Cus_Addr,district.DISTRICT_ID,DISTRICT_Name,amphur.AMPHUR_ID,AMPHUR_Name,province.PROVINCE_ID,PROVINCE_Name,Cus_Postcode,Cus_Phone,Cus_Tel,Cus_Fax,Cus_Line,Cus_Email
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
$Cus_District_ID = $row['DISTRICT_ID'];
$Cus_District = $row['DISTRICT_Name'];
$Cus_City_ID = $row['AMPHUR_ID'];
$Cus_City = $row['AMPHUR_Name'];
$Cus_Province_ID  = $row['PROVINCE_ID'];
$Cus_Province  = $row['PROVINCE_Name'];
$Cus_Postcode = $row['Cus_Postcode'];
$Cus_Phone  = $row['Cus_Phone'];
$Cus_Tel  = $row['Cus_Tel'];
$Cus_Fax  = $row['Cus_Fax'];
$Cus_Line = $row['Cus_Line'];
$Cus_Email  = $row['Cus_Email'];

?>
<script language=Javascript>
function Inint_AJAX() {
  try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
  try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
  try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
  alert("XMLHttpRequest not supported");
  return null;
};

function dochange(src, val,pointer) {
  var req = Inint_AJAX();
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
      }
    }
  };
  req.open("GET", "localtion_select.php?data=" + src  + "&val=" + val + "&pointer=" + pointer); //สร้าง connection
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
  req.send(null); //ส่งค่า
}

window.onLoad=dochange('district', <?=$Cus_City_ID?>,<?=$Cus_District_ID?>);
window.onLoad=dochange('amphur', <?=$Cus_Province_ID?>,<?=$Cus_City_ID?>);
window.onLoad=dochange('province',-1,<?=$Cus_Province_ID?>);

</script>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page xheader) -->
  <section class="content-header">
    <h1>
      แก้ไขประวัติลูกค้า
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
              <form name="frmMain" method="post" action="insert_edit_customer.php">

                <div class="row">
                  <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        ชื่อ <font color="red">*</font>
                      </label>
                      <input type="text" class="form-control" name="textCus_Name" value="<?=$Cus_Name?>" required />
                      <input type="hidden" class="form-control" name="textCus_ID" value="<?=$Cus_ID?>" required />
                    </div>
                    <div class="form-group">
                      <label>
                        รหัสลูกค้า Navision
                      </label>
                      <input type="text" class="form-control" name="textCus_No" style="text-transform: uppercase;" value="<?=$Cus_No?>" />
                    </div>
                    <div class="form-group">
                      <label>
                        E-Mail
                      </label>
                      <input type="text" class="form-control" name="textCus_Email" value="<?=$Cus_Email?>" />
                    </div>
                    <hr>
                  </div>

                  <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        ที่อยู่ปัจจุบัน <font color="red">*</font>
                      </label>
                      <textarea class="form-control" name="textCus_Addr" cols='100%' rows="3" required><?=$Cus_Addr?></textarea>
                    </div>
                  </div>

                  <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        จังหวัด <font color="red">*</font>
                      </label>
                      <span id="province">
                        <select name="ddlProvince" class="form-control" required>
                          <option value="<?=$Cus_Province_ID?>"><?=$Cus_Province?></option>
                        </select>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>
                        อำเภอ <font color="red">*</font>
                      </label>
                      <span id="amphur">
                        <select name="ddlAmphur"  class="form-control" required>
                          <option value='<?=$Cus_City_ID?>'><?=$Cus_City?></option>
                        </select>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>
                        ตำบล <font color="red">*</font>
                      </label>
                      <span  id="district">
                        <select name="ddldistrict" class="form-control">
                          <option value='<?=$Cus_District_ID?>'><?=$Cus_District?></option>
                        </select>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>
                        รหัสไปรษณีย์ <font color="red">*</font>
                      </label>
                      <input type="text" class="form-control" name="textCus_Postcode" value="<?=$Cus_Postcode?>" required />
                    </div>
                  </div>

                  <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        หมายเลขโทรศัพท์
                      </label>
                      <input type="text" class="form-control" name="textCus_Tel" value="<?=$Cus_Tel?>" />
                    </div>
                    <div class="form-group">
                      <label>
                        Fax
                      </label>
                      <input type="text" class="form-control" name="textCus_Fax" value="<?=$Cus_Fax?>" />
                    </div>
                    <div class="form-group">
                      <label>
                        โทรศัพท์มือถือ
                      </label>
                      <input type="text" class="form-control" name="textCus_Phone" value="<?=$Cus_Phone?>" />
                    </div>
                    <div class="form-group">
                      <label>
                        Line ID
                      </label>
                      <input type="text" class="form-control" name="textCus_Line" value="<?=$Cus_Line?>" />
                    </div>
                  </div>

                  <input type="submit" class="btn btn-primary btn-block" name="submittype" value="ยืนยัน">
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

<script>/*
function selectedPro(){
var proid = $("#testProvince option:selected").val();
window.location.href = "edit_customer.php?c=<?=$_GET[c]?>&proid=" + proid;
//document.getElementById("proid").innerHTML = proid;
}
function selectedAm(){
var amid = $("#testAmphur option:selected").val();
window.location.href = "edit_customer.php?c=<?=$_GET[c]?>&proid=<?=$_GET["proid"]?>&amid=" + amid;
}

function selectedDis(){
var disid = $("#testDistrict option:selected").val();
window.location.href = "edit_customer.php?c=<?=$_GET[c]?>&proid=<?=$_GET["proid"]?>&amid=<?=$_GET["amid"]?>&disid=" + disid;*/
}
</script>




</body>
</html>
