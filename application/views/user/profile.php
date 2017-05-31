<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			AdminLTE 2 | Registration Page
		</title>
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<!-- Bootstrap 3.3.4 -->
		<?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>
        <!-- Font Awesome Icons -->
        <?php echo link_tag('bootstrap/css/font-awesome.min.css'); ?>
        <!-- Theme style -->
        <?php echo link_tag('dist/css/AdminLTE.min.css'); ?>
        <!-- iCheck -->
        <?php echo link_tag('plugins/iCheck/square/blue.css'); ?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<style type="text/css">
			#fi #fic
			{
				margin-right: 100px !important
			}
			#fi #rh
			{
				margin-left: -115px !important;
				width: 95px !important
			}
			#fi .rh
			{
				display: none !important
			}
			body:not(.xE) div[role='main'] .Bu:not(:first-child)
			{
				display: none !important
			}
		</style>
	</head>
	<body class="register-page">
		<div class="register-box">
			<div class="register-logo">
				<a href="http://www.itoffside.com">
					<b>
						ecDocument
					</b>1.0
				</a>
			</div>

			<div class="register-box-body">
				<p class="login-box-msg">
					แก้ไขข้อมูล
				</p>
				<form method="post" action="<?php echo base_url('user/postprofile'); ?>">
					<div class="form-group has-feedback">
						<input type="text" placeholder="Full name" class="form-control" value="<?php echo $result->username; ?>" readonly="" name="username">
						<span class="glyphicon glyphicon-asterisk form-control-feedback">
						</span>
					</div>
					<div class="form-group has-feedback">
						<input type="text" placeholder="Full name" class="form-control" value="<?php echo $result->display_name; ?>" name="display_name">
						<span class="glyphicon glyphicon-user form-control-feedback">
						</span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" placeholder="Password" class="form-control" name="password" value="">
						<span class="glyphicon glyphicon-lock form-control-feedback">
						</span>
					</div>
					<div class="row">
						<div class="col-xs-8">
						</div><!-- /.col -->
						<div class="col-xs-4">
							<button class="btn btn-primary btn-block btn-flat" type="submit">
								Edit
							</button>
						</div><!-- /.col -->
					</div>
				</form>
				<a class="text-center" href="<?php echo base_url('document'); ?>">
					ย้อนกลับไปหน้าหลัก
				</a>
			</div><!-- /.form-box -->
		</div><!-- /.register-box -->

		<!-- jQuery 2.1.4 -->
		<script type="text/javascript" src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.1.4.min.js">
		</script>
		<!-- Bootstrap 3.3.2 JS -->
		<script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js">
		</script>
		<!-- iCheck -->
		<script type="text/javascript" src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js">
		</script>
		<script>
			$(function ()
				{
					$('input').iCheck(
						{
							checkboxClass: 'icheckbox_square-blue',
							radioClass: 'iradio_square-blue',
							increaseArea: '20%' // optional
						});
				});
		</script>


	</body>
</html>