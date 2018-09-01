<section class="content-header">
	<h2>Jadwal Absen</h2>
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
									Nama Matakuliah
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Kelas
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Ruangan
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Hari/Jam
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Dosen
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datas = _fetchMultipleFromSql(sprintf("SELECT * from view_krs where npm=%s", 
								'137006107') );
							$no=0;
							foreach ($datas as $key => $mahasiswa) {
								++$no;
								?>
								<tr>
									<td>
										<?=$no;?>
									</td>
									<td>
										<?=$mahasiswa['nama_matakuliah'];?>
									</td>
									<td>
										<?=$mahasiswa['nama_kelas'];?>
									</td>
									<td>
										<?=$mahasiswa['nama_ruangan'];?>
									</td>
									<td>
										<?=$mahasiswa['nama_dosen'];?>
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