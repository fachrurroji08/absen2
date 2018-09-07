<section class="content-header">
	<h2>Input Dosen</h2>
</section>



<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/dosen', 'do_input');?>" method="POST">

						 <div class="form-group">
                  			<label>Text</label>
                  			<input class="form-control" placeholder="Enter ..." type="text">
               			 </div>

		                <div class="form-group">
		                  <label>Pertemuan</label>
		                  <input type="text" class="form-control" placeholder="ID Dosen" value="<?=flashData('id_dosen');?>" name="id_dosen"  required="required">
		                </div>

		                <div class="form-group">
		                  <label>Ruangan</label>
		                  <input type="text" class="form-control" placeholder="NIDN" value="<?=flashData('nidn');?>" name="nidn" required="required">
		                </div>

		                <div class="form-group">
		                  <label>Detail Pertemuan</label>
		                  <input type="text" class="form-control" placeholder="Gelar Depan" value="<?=flashData('gelar_depan');?>" name="gelar_depan">
		                </div>

						<div class="form-group">
		                  <label>Tanggal Pertemuan</label>
		                  <input type="text" class="form-control" placeholder="Nama Dosen" value="<?=flashData('nama_dosen');?>" name="nama_dosen"  required="required">
		                </div>

		                <div class="form-group">
		                  <label>Jam Mulai</label>
		                  <input type="text" class="form-control" placeholder="Gelar Belakang" value="<?=flashData('gelar_belakang');?>" name="gelar_belakang">
		                </div>

		                <div class="form-group">
		                  <label>Jam Selesai</label>
		                  <input type="text" class="form-control" placeholder="Gelar Belakang" value="<?=flashData('gelar_belakang');?>" name="gelar_belakang">
		                </div>

		                <div class="form-group">
                  			<label>Jenis Kelamin</label>
                  			<select name="jenis_kelamin" class="form-control">
                   				 <option value="L">Laki-Laki</option>
                   				 <option value="P">Perempuan</option>
                			</select>
               			 </div>

                		<button type="submit" class="btn btn-primary">Tambah</button>
             		 </form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>No.</th>
								<th>Nama</th>
								<th>Status</th>
								<th>Lokasi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$id_jadwal = @$_GET['id_jadwal'];
							$id_pertemuan = @$_GET['id_pertemuan'];
							$mahasiswas = _fetchMultipleFromSql(
							"	SELECT v.*, m.nama_mahasiswa 
								from view_krs v 
								join mahasiswa m on m.npm=v.npm
								left join absen a on a.npm=m.npm and 
								where v.id_jadwal='$id_jadwal' order by m.npm, m.nama_mahasiswa 
							");

							$no = 0;
							foreach ($mahasiswas as $key => $mahasiswa) {
								++$no;
								?>
								<tr>
									<th><?=$no;?></th>
									<th>
										<?=$mahasiswa['nama_mahasiswa'];?>
										<br>
										<small class="text-danger"><?=$mahasiswa['npm'];?></small>
									</th>
									<th><?=</th>
									<th>Lokasi</th>
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