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
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">ประเภทผู้ใช้งาน</label> <?php echo $this->session->flashdata('error_permission'); ?>
                        <select class="form-control" name="permission">
                            <option value="">
                                เลือกข้อมูล
                            </option>
                            <option value="USER">
                                USER
                            </option>
                            <option value="ADMIN">
                                ADMIN
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">กลุ่มผู้ใช้</label> <?php echo $this->session->flashdata('error_usergroup_id'); ?>
                        <select class="form-control" name="usergroup_id">
                            <option value="">
                                เลือกข้อมูล
                            </option>
                            <?php foreach($usergroup as $item): ?>
                                <option value="<?php echo $item->id ?>"><?php echo $item->name; ?></option>
                            <?php endforeach; ?>     
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อผู้ใช้งาน</label> <?php echo $this->session->flashdata('error_username'); ?>
                        <input type="text" id="username" class="form-control" name="username" value="<?php echo $this->session->flashdata('e_username'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">รหัสผ่านเข้าใช้งาน</label> <?php echo $this->session->flashdata('error_password'); ?>
                        <input type="password" id="password" class="form-control" name="password" value="<?php echo $this->session->flashdata('e_password'); ?>">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">ชื่อจริง นามสกุล</label> <?php echo $this->session->flashdata('error_display_name'); ?>
                        <input type="text" id="display_name" class="form-control" name="display_name" value="<?php echo $this->session->flashdata('e_display_name'); ?>">
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