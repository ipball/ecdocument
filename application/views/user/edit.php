<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            ผู้ใช้งาน
            <small>จัดการผู้ใช้งานในระบบ</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
            <li><a href="<?php echo base_url('user'); ?>">ผู้ใช้งาน</a></li>
            <li class="active">เพิ่มข้อมูลใหม่</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">เพิ่มข้อมูล</h3>
            </div><!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url('user/postdata'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ประเภทผู้ใช้งาน</label> <?php echo $this->session->flashdata('error_permission'); ?>
                        <?php
                        if ($user->id == 1) { ?>
                        <input type="text" id="permission" class="form-control" name="permission" value="<?php echo $user->permission; ?>" readonly="true">
                       <?php } else {
                            ?>
                            <select class="form-control" name="permission">
    
                                <option value="USER" <?php
                                if ($user->permission == 'USER') {
                                    echo 'selected';
                                }
                                ?>>
                                    USER
                                </option>
                                <option value="ADMIN" <?php
                                if ($user->permission == 'ADMIN') {
                                    echo 'selected';
                                }
                                ?>>
                                    ผู้ดูแลระบบ
                                </option>
                            </select>
                        <?php }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อผู้ใช้งาน</label> <?php echo $this->session->flashdata('error_username'); ?>
                        <input type="text" id="username" class="form-control" name="username" value="<?php echo $user->username; ?>" readonly="true">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสผ่านเข้าใช้งาน (สามารถว่างได้ถ้าไม่ต้องการเปลี่ยนรหัสผ่าน)</label> <?php echo $this->session->flashdata('error_password'); ?>
                        <input type="password" id="password" class="form-control" name="password" value="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อ นามสกุลจริง</label> <?php echo $this->session->flashdata('error_display_name'); ?>
                        <input type="text" id="display_name" class="form-control" name="display_name" value="<?php echo $user->display_name; ?>">
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-save"></i> บันทึกข้อมูล</button>
                    <a class="btn btn-danger" href="<?php echo base_url('user'); ?>" role="button"><i class="fa fa-fw fa-close"></i> ยกเลิก</a>
                </div>
            </form>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->