<?php

$action = getAction();

if ($action == "proccessLogin") {

	try {

		$username = @$_POST['username'];
		$password = @$_POST['password'];
		if (!$username) {
			throw new Exception("Username harus diisi.", 1);
		}
		if (!$password) {
			throw new Exception("Password harus diisi.", 1);
		}

		$status = false;
		$loginOptions = [
			'admin' => "SELECT * FROM admin WHERE username='%s'",
		];
		$user = false;
		$level = false;
		foreach ($loginOptions as $clevel => $query) {

			$db = connectDb();
			$sql = sprintf($query, $username);
			$user = _fetchOneFromSql($sql);
			if ($user) {
				$level = $clevel;
				break;
			}
			
		}
		if (!$user) {
			throw new Exception("Username salah.", 1);
		}

		if (!password_verify($password, $user['password'])) {
			throw new Exception("Password salah.", 1);
		}

		$_SESSION[$level]=$user;
		$_SESSION['level']=$level;

		$message = "Berhasil Login.";
		$status = true;

	} catch(Exception $e) {
		$message = $e->getMessage();
		$user = false;
		$status = false;
	}
	if ($status) {
		flash()->success($message);
		redirect(moduleUrl('dashboard'));
	} else {
		flash()->error($message);
		redirect(moduleUrl('login'));
	}

	die();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=baseUrl('style/bower_components/bootstrap/dist/css/bootstrap.min.css');?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="style/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="style/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="style/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="style/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?=flash()->display();?>
    <form action="<?=moduleUrl('login', 'proccessLogin');?>" method="post" autocomplete="off">
      <div class="form-group has-feedback">
        
      </div>
      <div class="form-group has-feedback">
        <input name="username" type="text" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn-login">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="style/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="style/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="style/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>