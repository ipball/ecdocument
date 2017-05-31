
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>AdminLTE 2 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <?php echo link_tag('bootstrap/css/bootstrap.min.css'); ?>
	<!-- font awesome icons-->
	<?php echo link_tag('bootstrap/css/font-awesome.min.css'); ?>
	<!-- ionicons-->
	<?php echo link_tag('bootstrap/css/ionicons.min.css'); ?>
	<!--Theme style-->
	<?php echo link_tag('dist/css/AdminLTE.min.css'); ?>
	<!--Theme skin -->
	<?php echo link_tag('dist/css/skins/skin-blue.min.css'); ?>
	<!--Theme skin -->
	<?php echo link_tag('plugins/datatables/dataTables.bootstrap.css'); ?>
	<!--My Custom-->
	<?php echo link_tag('dist/css/mycustom.css'); ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
  <body class="skin-blue layout-top-nav">
    <div class="wrapper">

      <header class="main-header">
        <nav class="navbar navbar-static-top">
          <div class="container">
            <div class="navbar-header">
              <a href="<?php echo base_url(); ?>" class="navbar-brand"><b>ecDocument</b>1.0</a>
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                <i class="fa fa-bars"></i>
              </button>
            </div>
          </div><!-- /.container-fluid -->
        </nav>
      </header>
      <!-- Full Width Column -->
   
