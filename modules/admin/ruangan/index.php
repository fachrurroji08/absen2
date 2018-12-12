  <section class="content-header">
	<h2>Data Mahasiswa</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<table class="table table-hover table-bordered datatable">
						<thead>
							<tr>
								<th colspan="" rowspan="" headers="" scope="">
									No
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Nama Ruangan
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Kapasitas
							</th>
								<th colspan="" rowspan="" headers="" scope="">
									Latitude
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Longitude
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Opsi
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datas = _fetchMultipleFromSql("SELECT * from ruangan");
							$no=0;
							foreach ($datas as $key => $ruangan) {
								++$no;
								?>
								<tr>
									<td>
										<?=$no;?>
									</td>
									<td>
										<?=$ruangan['nama_ruangan'];?>
									</td>
									<td>
										<?=$ruangan['kapasitas'];?>
									</td>
									<td>
										<?=$ruangan['latitude'];?>
									</td>
									<td>
										<?=$ruangan['longitude'];?>
									</td>
									<td>
										<a href="<?=moduleUrl('admin/ruangan', 'edit', 'id='.$ruangan['id_ruangan']);?>" title="Edit" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
										<a href="<?=moduleUrl('admin/ruangan', 'hapus', 'id='.$ruangan['id_ruangan']);?>" title="Hapus" class="btn btn-danger btn-xs" onclick="needConfirm(event, this);"><i class="fa fa-trash"></i></a>
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