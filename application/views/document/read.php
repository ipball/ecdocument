<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
				รายการเอกสาร
				<small>
					by itoffside.com
				</small>
			</h1>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url(); ?>">
						<i class="fa fa-dashboard">
						</i>หน้าแรก
					</a>
				</li>
				<li class="active">
					เอกสาร
				</li>
			</ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">
						<?php echo $result->topic; ?>
					</h3>
				</div>
				<div class="box-body">
					<form role="form" action="">
							<div class="form-group">
								<label for="exampleInputEmail1">
									<a class="btn btn-app" href="<?php echo base_url('uploads/' . $result->filename); ?>" target="_blank">
                   					 <i class="fa fa-save"></i> Download File
                  					</a>
							</div>
						<div class="box-body">
							<div class="form-group">
								<label for="exampleInputEmail1">
									หมวดหมู่
								</label>
								<input type="text" class="form-control" name="" value="<?php echo $result->name; ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									แฟ้มเอกสาร
								</label>
								<input type="text" class="form-control" name="" value="<?php echo $result->doc_type; ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									รหัสเอกสาร
								</label>
								<input type="text" class="form-control" name="" value="<?php echo $result->document_code; ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									เอกสาร Remark
								</label>
								<input type="text" class="form-control" name="" value="<?php echo $result->doc_remark; ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									ชื่อเอกสาร
								</label>
								<input type="text" id="topic" class="form-control" name="" value="<?php echo $result->topic; ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									วันที่ลงทะเบียนเอกสาร
								</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar">
										</i>
									</div>
									<input type="text" class="form-control pull-right" id="register_date" name="register_date" readonly="" data-date-format="yyyy-mm-dd" value="<?php echo date('d/m/Y',strtotime($result->register_date)); ?>">
								</div>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									อ้างอิงเอกสาร
								</label>
								<input type="text" id="reference" class="form-control" name="reference" value="<?php echo $result->reference; ?>" readonly="">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">
									สถานที่จัดเก็บเอกสาร
								</label>
								<input type="text" id="store" class="form-control" name="store" value="<?php echo $result->store; ?>" readonly="">
							</div>
							<div class="form-group">
								<label>
									รายละเอียด
								</label>
								<textarea rows="3" class="form-control" id="description" name="description" readonly=""><?php echo $result->description; ?></textarea>
							</div>
						</div><!-- /.box-body -->

						<div class="box-footer">
							<a class="btn btn-danger" href="<?php echo base_url('document/listview'); ?>" role="button">
								<i class="fa fa-fw fa-close">
								</i>ย้อนกลับ
							</a>
						</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
</div><!-- /.content-wrapper -->