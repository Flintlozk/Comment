<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="./index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>SGD</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>SGD </b>Customer</span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="logout.php" ><i class="fa fa-sign-out"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">
            <span><font color="white"><?='Name: ',$_SESSION["User_RName"]?></font></span><br>
            <span><font color="white"><?='Sale No: ',$_SESSION["User_Sale_No"]?></font></span>
          </li>
          <li class="header">
            <span>Customer</span>
          </li>
          <li>
            <a href="index.php">
              <i class="glyphicon glyphicon-home"></i> <span>หน้าแรก</span>
            </a>
          </li>

          
          <li>
            <a href="comment.php">
              <i class="glyphicon glyphicon-comment"></i> <span>คอมเมนต์</span>
            </a>
          </li>
          <?
          if($_SESSION["User_Status"] == "admin"){?>
            <li>
              <a href="newuser.php">
                <i class="glyphicon glyphicon-lock"></i> <span>ผู้ใช้งาน</span>
              </a>
            </li>
          <? } else{} ?>


          <!--
          <li>
          <a href="genre.php">
          <i class="fa fa-th"></i> <span>หมวดหมู่</span>
        </a>
      </li>
    -->
  </ul>
</section>
<!-- /.sidebar -->
</aside>
