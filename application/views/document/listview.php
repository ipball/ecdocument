<div class="content-wrapper">
	<div class="container">
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
			<div class="box box-default">
				<div class="box-header with-border">
					<h3 class="box-title">
						ตารางข้อมูล
					</h3>
				</div>
				<div class="box-body">
					<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
						<div class="row">
							<div class="col-sm-6">
								<a class="btn btn-default btn-sm" href="<?php echo  base_url('document/listview'); ?>" role="button">
									<i class="fa fa-fw fa-refresh">
									</i> Refresh Data
								</a>
								<a class="btn btn-info btn-sm" href="<?php echo  base_url('document'); ?>" role="button">
									<i class="fa fa-cog"></i> กลับไปหน้าจัดการ
								</a>
							</div>
							<div class="col-sm-6">
								<div id="" class="dataTables_filter">
									<form action="" method="GET" name="search">
										<label>
											ค้นหา
										</label>:<input type="search" name="keyword" class="form-control input-sm" placeholder="ค้นหาชื่อเอกสาร"></label>
									</form>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
									<thead>
										<tr role="row">
											<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 70px;">
												รหัสเอกสาร
											</th>
											<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 200px;">
												ชื่อเอกสาร
											</th>
											<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 30px;">
												วันที่เอกสาร
											</th>
											<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 100px;">
												แหล่งเก็บ
											</th>
											<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 100px;">
												สร้างโดย
											</th>
											<th class="sorting" tabindex="0"  rowspan="1" colspan="1" style="width: 100px;">
												หมวดหมู่
											</th>
											<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width:  80px;">
												&nbsp;
											</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(!empty($results))
										{
											foreach($results as $data)
											{
												$permission = $this->Permission_model->permission_by_usergroup_and_categorie($usergroup_id, $data->categorie_id);
												if($permission->read == 1){
												?>
												<tr role="row">
													<td>
														<a href="<?php echo base_url('document/read/'.$data->id); ?>">
															<?php echo  $data->document_code; ?>
														</a>
													</td>
													<td>
														<?php echo  $data->topic; ?>
													</td>
													<td>
														<?php echo  date('d/m/Y',strtotime($data->register_date)); ?>
													</td>
													<td>
														<?php echo  $data->store; ?>
													</td>
													<td>
														<?php echo  $data->display_name; ?>
													</td>
													<td>
														<?php echo $data->name; ?>
													</td>
													<td>
														<a class="btn btn-info btn-xs" target="_blank" href="<?php echo  base_url('uploads/'.$data->filename); ?>" role="button">
															<i class="fa fa-fw  fa-file-text">
															</i>ไฟล์เอกสาร
														</a>
													</td>
												</tr>
												<?php
												}
											}
										} ?>
									</tbody>

								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-5">
								<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
									Total <?php echo  $total_rows; ?> entries
								</div>
							</div>
							<div class="col-sm-7">
								<div id="example1_paginate" class="dataTables_paginate paging_simple_numbers">
									<?php echo $link; ?>
								</div>

							</div>
						</div>
					</div>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</section><!-- /.content -->
	</div><!-- /.container -->
</div><!-- /.content-wrapper -->