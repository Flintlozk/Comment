<?
include_once('_header.php');
?>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="./index.php"><b>SGD</b> Customer</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form name="loginForm" action="checklogin.php" method="post">
        <div class="form-group has-feedback">
          <input name="username" id='username' type="text" class="form-control" placeholder="Username" autofocus>
          <span class="fa fa-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input name="password" id='password' type="password" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
            </div>
          </div><!-- /.col -->
          <div class="col-xs-12">
            <div class="form-group">
              <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In"/>
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
