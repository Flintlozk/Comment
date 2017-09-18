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
</style>

<script language=Javascript>
function Inint_AJAX() {
  try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
  try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
  try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
  alert("XMLHttpRequest not supported");
  return null;
};

function dochange(src, val) {
  var req = Inint_AJAX();
  req.onreadystatechange = function () {
    if (req.readyState==4) {
      if (req.status==200) {
        document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
      }
    }
  };
  req.open("GET", "localtion.php?data="+src+"&val="+val); //สร้าง connection
  req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
  req.send(null); //ส่งค่า
}

window.onLoad=dochange('province', -1);
</script>

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

            <section class="content-header">
              <h1>

              </h1>
            </section>
            <section class="content">
              <form name="frmMain" method="post" action="insert_customer.php">
                <input type="hidden" class="form-control" name="textSaleno" value="<?=$_SESSION["User_Sale_No"]?>" required />
                <input type="hidden" class="form-control" name="textSale_Name" value="<?=$_SESSION["User_RName"]?>" required />
                <div class="row">
                  <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        ชื่อ <font color="red">*</font>
                      </label>
                      <input type="text" class="form-control" name="textCus_Name" required />
                    </div>
                    <div class="form-group">
                      <label>
                        รหัสลูกค้า Navision
                      </label>
                      <input type="text" class="form-control" style="text-transform: uppercase;" name="textCus_No" />
                    </div>
                    <div class="form-group">
                      <label>
                        E-Mail
                      </label>
                      <input type="email" class="form-control" name="textCus_Email"  />
                    </div>
                    <hr>
                  </div>
                  <div class="col-lg-12  col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        ที่อยู่ปัจจุบัน <font color="red">*</font>
                      </label>
                      <textarea class="form-control" name="textCus_Addr" cols='100%' rows="3" required></textarea>
                    </div>
                  </div>
                  <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        จังหวัด <font color="red">*</font>
                      </label>
                      <span id="province">
                        <select name="ddlProvince" class="form-control" required>
                          <option value="0"></option>
                        </select>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>
                        อำเภอ <font color="red">*</font>
                      </label>
                      <span id="amphur">
                        <select name="ddlAmphur"  class="form-control" required>
                          <option  value='0'></option>
                        </select>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>
                        ตำบล
                      </label>
                      <span  id="district">
                        <select name="ddldistrict" class="form-control">
                          <option value='0'></option>
                        </select>
                      </span>
                    </div>

                    <div class="form-group">
                      <label>
                        รหัสไปรษณีย์ <font color="red">*</font>
                      </label>
                      <input type="text" class="form-control" name="textCus_Postcode" required />
                    </div>
                  </div>

                  <div class="col-lg-6  col-md-6 col-sm-12 col-xs-12">
                    <div class="form-group">
                      <label>
                        หมายเลขโทรศัพท์
                      </label>
                      <input type="text" class="form-control" name="textCus_Tel"  />
                    </div>
                    <div class="form-group">
                      <label>
                        Fax
                      </label>
                      <input type="text" class="form-control" name="textCus_Fax"  />
                    </div>
                    <div class="form-group">
                      <label>
                        โทรศัพท์มือถือ
                      </label>
                      <input type="text" class="form-control" name="textCus_Phone"  />
                    </div>
                    <div class="form-group">
                      <label>
                        Line ID
                      </label>
                      <input type="text" class="form-control" name="textCus_Line" />
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" name="submittype" value="ยืนยัน">
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




</body>
</html>
