<!-- Datetime picker -->
<?php echo link_tag('plugins/datepicker/datepicker3.css'); ?>
<script src="<?php echo base_url(); ?>plugins/datepicker/bootstrap-datepicker.js" type="text/javascript">
</script>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			เอกสาร
			<small>
				จัดการเอกสารต่างๆให้ตรงตามหมวดหมู่ เพื่อความง่ายต่อการเข้าถึงของผู้ใช้งาน
			</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url(); ?>">
					<i class="fa fa-dashboard">
					</i>หน้าแรก
				</a>
			</li>
			<li>
				<a href="<?php echo base_url('document'); ?>">
					หมวดหมู่เอกสาร
				</a>
			</li>
			<li class="active">
				เพิ่มข้อมูลใหม่
			</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">
					เพิ่มข้อมูล
				</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form role="form" action="<?php echo base_url('document/postdata'); ?>" method="post" enctype="multipart/form-data">
			<input type="hidden" value="<?php echo $doc->id; ?>" name="id">
			<input type="hidden" value="<?php echo $doc->filename; ?>" name="datafile">
				<div class="box-body">
					<div class="form-group">
						<label for="exampleInputEmail1">
							หมวดหมู่เอกสาร
						</label> <?php echo $this->session->flashdata('err_categorie_id'); ?>
						<select class="form-control" name="categorie_id">
							<option value="">
								เลือกข้อมูล
							</option>
							<?php
							foreach($results as $result){
								?>
								<option value="<?php echo $result->id; ?>" <?php if($result->id==$doc->categorie_id){echo "selected"; } ?>>
									<?php echo $result->name; ?>
								</option>
								<?php
							} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="">แฟ้มเอกสาร</label>
						<select name="document_folder_id" class="form-control" ></select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							รหัสเอกสาร
						</label> <?php echo $this->session->flashdata('err_document_code'); ?>
						<input type="text" id="document_code" class="form-control" name="document_code" value="<?php echo $doc->document_code; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							Remark เอกสาร
						</label>
						<br>
						<label class="radio-inline">
							<input type="radio" name="doc_remark" value="Normal" <?php echo ($doc->doc_remark=='Normal') ? 'checked' : '' ?> > ทั่วไป
						</label>
						<label class="radio-inline">
							<input type="radio" name="doc_remark" value="ISO" <?php echo ($doc->doc_remark=='ISO') ? 'checked' : '' ?> > ISO
						</label>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							ชื่อเอกสาร
						</label> <?php echo $this->session->flashdata('err_topic'); ?>
						<input type="text" id="topic" class="form-control" name="topic" value="<?php echo $doc->topic; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							วันที่ลงทะเบียนเอกสาร
						</label> <?php echo $this->session->flashdata('err_register_date'); ?>
						<div class="input-group">
							<div class="input-group-addon">
								<i class="fa fa-calendar">
								</i>
							</div>
							<input type="text" class="form-control pull-right" id="register_date" name="register_date" readonly="" data-date-format="yyyy-mm-dd" value="<?php echo date('Y-m-d',strtotime($doc->register_date)); ?>">
						</div>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							อ้างอิงเอกสาร
						</label>
						<input type="text" id="reference" class="form-control" name="reference" value="<?php echo $doc->reference; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							สถานที่จัดเก็บเอกสาร
						</label>
						<input type="text" id="store" class="form-control" name="store" value="<?php echo $doc->store; ?>">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							อัพโหลดไฟล์เอกสารใหม่
							<a href="<?php echo base_url('uploads/' . $doc->filename); ?>" target="_blank">(ไฟล์เดิมคลิก)</a>
						</label> <?php echo $this->session->flashdata('err_filename'); ?>
						<input type="file" name="userfile" id="userfile" >
					</div>
					<div class="form-group">
						<label>
							รายละเอียด
						</label>
						<textarea rows="3" class="form-control" id="description" name="description"><?php echo $doc->description; ?></textarea>
					</div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<button class="btn btn-primary" type="submit">
						<i class="fa fa-fw fa-save">
						</i>บันทึกข้อมูล
					</button>
					<a class="btn btn-danger" href="<?php echo base_url('document'); ?>" role="button">
						<i class="fa fa-fw fa-close">
						</i>ยกเลิก
					</a>
				</div>
			</form>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->
<script type="text/javascript">
	$(document).ready(function () {
		$('#register_date').datepicker().on();
		/* onload */
		$('select[name=document_folder_id]').html('<option value="">เลือกรายการ</option>');
		var catSelected =  $('select[name=categorie_id]').val();
		$.ajax({
				type: 'GET',
				url: '<?php echo site_url('documentfolder/list_doctype_by_categorie/'); ?>' + catSelected,			
				dataType: 'json',
				success: function (d) {
					var option = '';
					$.each(d,function(i,item){
						option += '<option value="'+item.id+'">'+item.name+'</option>';
					});

					$('select[name=document_folder_id]').append(option);
					/* default selected doc type */
					$('select[name=document_folder_id]').val('<?php echo $doc->document_folder_id; ?>');
				}
		});
	
		

		/* onclick */
		$('body').on('change', 'select[name=categorie_id]', function(){
			$('select[name=document_folder_id]').html('<option value="">เลือกรายการ</option>');
			$.ajax({
				type: 'GET',
				url: '<?php echo site_url('documentfolder/list_doctype_by_categorie/'); ?>' + $('select[name=categorie_id]').val(),			
				dataType: 'json',
				success: function (d) {
					var option = '';
					$.each(d,function(i,item){
						option += '<option value="'+item.id+'">'+item.name+'</option>';
					});

					$('select[name=document_folder_id]').append(option);
				}
			});	
		});
	});
</script>