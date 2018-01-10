<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            กลุ่มผู้ใช้งาน
            <small>จัดการกลุ่มผู้ใช้งานในระบบ</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> หน้าแรก</a></li>
            <li><a href="<?php echo base_url('usergroup'); ?>">กลุ่มผู้ใช้งาน</a></li>
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
            <form role="form" action="<?php echo base_url('usergroup/postdata'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $usergroup->id; ?>">
                <div class="box-body">
                    <div class="form-group">
                        <label for="">กลุ่มผู้ใช้งาน</label> <?php echo $this->session->flashdata('error_name'); ?>
                        <input type="text" id="name" class="form-control" name="name" value="<?php echo $usergroup->name; ?>">
                    </div>
                    <label for="">กำหนดสิทธิ์ใช้งาน</label>
                    <table class="table table-bordered">
                        <tr>
                            <th style="vertical-align: middle;">หมวดหมู่</th>
                            <th>
                                <div class="checkbox">
                                    <label><input type="checkbox" value="" id="checkAll">#ทั้งหมด</label>
                                </div>                                
                            </th>
                        </tr>
                        <?php $i=0; foreach($categories as $item): ?>
                        <?php
                            $val = $this->Permission_model->permission_by_usergroup_and_categorie($usergroup->id, $item->id);
                            $checked = !empty($val->read) ? 'checked="checked"' : '';
                        ?>
                            <tr>
                                <td style="vertical-align: middle;">
                                    <?php echo $item->name; ?>
                                    <input type="hidden" value="<?php echo $item->id; ?>" name="categorie<?php echo $i; ?>">
                                </td>
                                <td>
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="read<?php echo $i; ?>" value="1" <?php echo $checked ?> >สามารถเข้าถึงไฟล์</label>
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; endforeach; ?>
                    </table>
                    <input type="hidden" value="<?php echo $i; ?>" name="categorie_count">
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-save"></i> บันทึกข้อมูล</button>
                    <a class="btn btn-danger" href="<?php echo base_url('usergroup'); ?>" role="button"><i class="fa fa-fw fa-close"></i> ยกเลิก</a>
                </div>
            </form>
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script>
    $(document).ready(function () {
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    });
</script>