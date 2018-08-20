

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SIM Absen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=baseUrl('style/dist/css/AdminLTE.min.css');?>">
  <link rel="stylesheet" href="<?=baseUrl('style/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=baseUrl('style/bower_components/font-awesome/css/font-awesome.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=baseUrl('style/bower_components/Ionicons/css/ionicons.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=baseUrl('style/dist/css/AdminLTE.min.css');?>">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect. -->
  <link rel="stylesheet" href="<?=baseUrl('style/dist/css/skins/_all-skins.min.css');?>">
  <!-- bootstrap time picker -->
  <script src="<?=baseUrl('style/plugins/timepicker/bootstrap-timepicker.min.js');?>"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="<?=baseUrl('style/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">
    
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>IM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SIM</b> Absen</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="style/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">admin</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="style/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  admin                  <small>Tanggal : 20-08-2018</small>
                </p>
              </li>
              <!-- Menu Body -->

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
       
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="style/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>admin</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- BERANDA -->
                  <li class="active"><a href="<?=moduleUrl('dashboard');?>"><i class="fa fa-link"></i> <span>Beranda</span></a></li>
           
        
                <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Mahasiswa</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          	<li><a href="<?=moduleUrl('admin/mahasiswa');?>">Data Mahasiswa</a></li>
            <li><a href="<?=moduleUrl('admin/mahasiswa', 'input');?>">Input Data</a></li>
          </ul>
        </li>
        

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Dosen</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          	<li><a href="<?=moduleUrl('admin/dosen');?>">Data Dosen</a></li>
            <li><a href="<?=moduleUrl('admin/dosen', 'input');?>">Input Data</a></li>
          </ul>
        </li>
        
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Ruangan</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          	<li><a href="<?=moduleUrl('admin/data_ruangan');?>">Data Ruangan</a></li>
            <li><a href="<?=moduleUrl('admin/input_ruangan', 'input');?>">Input Data</a></li>
          </ul>
        </li>

                <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>Jadwal</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=moduleUrl('admin/data_jadwal');?>">Data Jadwal</a></li>
            <li><a href="<?=moduleUrl('admin/tambah_jadwal','input');?>">Tambah Jadwal</a></li>
          </ul>
        </li>

        	<li>
        		         <a href="<?=moduleUrl('admin/matakuliah');?>"><i class="fa fa-link"></i> <span>Matakuliah</span>
            <span class="pull-right-container">
              </span>
          </a>
        	</li>

      </ul>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

