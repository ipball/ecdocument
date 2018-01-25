<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		แฟ้มเอกสาร
			<small>
			แฟ้มเอกสารจัดการแบ่งแยกเอกสาร
			</small>
		</h1>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo  base_url('documentfolder'); ?>">
					<i class="fa fa-dashboard">
					</i>หน้าแรก
				</a>
			</li>
			<li>
				<a href="<?php echo  base_url('documentfolder'); ?>">
					แฟ้มเอกสาร
				</a>
			</li>
			<li class="active">
				<?php echo $result->name?>
			</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Your Page Content Here -->
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">
					แก้ไขข้อมูล
				</h3>
			</div><!-- /.box-header -->
			<!-- form start -->
			<form role="form" action="<?php echo  base_url('documentfolder/postdata'); ?>" method="post">
				<input type="hidden" name="id" value="<?php echo $result->id?>">
				<div class="box-body">
				<div class="form-group">
						<label for="exampleInputEmail1">
							หมวดหมู่เอกสาร
						</label> <?php echo $this->session->flashdata('error_cat_id'); ?>
						<select class="form-control" name="categorie_id">
							<option value="">
								เลือกข้อมูล
							</option>
							<?php
							foreach($cats as $cat){
								$selected = ($cat->id==$result->categorie_id) ? 'selected' : '';
								?>
								<option value="<?php echo $cat->id; ?>" <?php echo $selected; ?> >
									<?php echo $cat->name; ?>
								</option>
								<?php
							} ?>
						</select>
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">
							ชื่อแฟ้มเอกสาร
						</label> <?php echo $this->session->flashdata('error_name')?>
						<input type="text" id="name" class="form-control" name="name" value="<?php echo  $result->name ?>">
					</div>
					<div class="form-group">
						<label>
							รายละเอียด
						</label>
						<textarea rows="3" class="form-control" id="description" name="description">
							<?php echo $result->description ?>
						</textarea>
					</div>
				</div><!-- /.box-body -->

				<div class="box-footer">
					<button class="btn btn-primary" type="submit">
						<i class="fa fa-fw fa-save">
						</i>บันทึกข้อมูล
					</button>
					<a class="btn btn-danger" href="<?php echo  base_url('documentfolder'); ?>" role="button">
						<i class="fa fa-fw fa-close">
						</i>ยกเลิก
					</a>
				</div>
			</form>
		</div>
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->