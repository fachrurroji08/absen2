<section class="content-header">

</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<table class="table table-hover table-bordered datatable">
						<thead>
							<tr>
								<th colspan="" rowspan="" headers="" scope="">
									No
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									ID Dosen
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									NIDN
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Jenis Kelamin
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Nama
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Opsi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datas = _fetchMultipleFromSql("SELECT * from dosen");
							$no=0;
							foreach ($datas as $key => $dosen) {
								++$no;
								?>
								<tr>
									<td>
										<?=$no;?>
									</td>
									<td>
										<?=$dosen['id_dosen'];?>
									</td>
									<td>
										<?=$dosen['nidn'];?>
									</td>
									<td>
										<?=$dosen['jenis_kelamin'];?>
									</td>
									<td>
										<?=$dosen['gelar_depan']." ".$dosen['nama_dosen']." ".$dosen['gelar_belakang'];?>
									</td>
									<td>
										<a href="<?=moduleUrl('admin/dosen', 'edit', 'id='.$dosen['id_dosen']);?>" title="Edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
										<a href="<?=moduleUrl('admin/dosen', 'hapus', 'id='.$dosen['id_dosen']);?>" title="Hapus" class="btn btn-danger btn-xs" onclick="needConfirm(event, this);"><i class="fa fa-trash"></i></a>
									</td>
								</tr>
								<?php
							}
							?>
						</tbody>	
					</table>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->
<?php bufferStart();?>
<script type="text/javascript">
	function needConfirm(event, el) {
		event.preventDefault();
		var conf = confirm("Apakah yakin akan menghapus data ini ?");
		if (conf) {
			window.location.href = $(el).attr('href');
		}
	}
</script>
<?php bufferEnd('scripts');?>