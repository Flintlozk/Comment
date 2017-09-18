<?
include_once('_header.php');
?>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="./index.php"><b>SGD</b> Customer</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">สมัครสมาชิก</p>

      <form name="loginForm" action="add_user.php" method="post">
        <div class="form-group has-feedback">
          <input name="textusername" id='username' type="text" class="form-control" placeholder="ชื่อผู้ใช้งาน" required>
          <span class="fa fa-user form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input name="textpassword" id='password' type="password" class="form-control" placeholder="รหัสผ่าน" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input name="textrealname" id='userrname' type="text" class="form-control" placeholder="ชื่อ-สกุล" required>
          <span class="form-control-feedback"></span>
        </div>

        <div class="form-group has-feedback">
          <input name="textemail" id='email' type="email" class="form-control" placeholder="E-Mail" required>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
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

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->
  <!-- jQuery 2.1.4 -->
  <script src="./plugins/jQuery/jQuery-2.1.4.min.js"></script>
  <!-- Bootstrap 3.3.5 -->
  <script src="./bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->

</body>
</html>
