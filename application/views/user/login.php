<html><head>
        <meta charset="UTF-8">
        <title>AdminLTE 2 | Log in</title>
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
        <style type="text/css"> #fi #fic {margin-right:100px !important}  #fi #rh {margin-left:-115px !important;width:95px !important}  #fi .rh {display:none !important}  body:not(.xE) div[role='main'] .Bu:not(:first-child) {display: none !important} </style></head>
    <body class="login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="http://www.itoffside.com">ecDocument</a> 1.0
            </div><!-- /.login-logo -->
            <div class="login-box-body">
            	<p class="login-box-msg">เข้าสู่ระบบเพื่อเริ่มเข้าจัดการเอกสาร</p>
               	<?=$this->session->flashdata('msgerr')?>
                <form method="post" action="<?php echo base_url('user/validlogin') ?>">
                    <div class="form-group has-feedback">
                        <input type="text" placeholder="Username" class="form-control" name="username">
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" placeholder="Password" class="form-control" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-primary btn-block btn-flat" type="submit">Sign In</button>
                        </div><!-- /.col -->
                    </div>
                </form>

                <a href="#">ลืมรหัสผ่าน คลิกตรงนี้</a>

            </div><!-- /.login-box-body -->
        </div><!-- /.login-box -->

        <!-- jQuery 2.1.4 -->
        <script type="text/javascript" src="<?php echo base_url(); ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <!-- Bootstrap 3.3.2 JS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>bootstrap/js/bootstrap.min.js"></script>
        <!-- iCheck -->
        <script type="text/javascript" src="<?php echo base_url(); ?>plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>


    </body></html>