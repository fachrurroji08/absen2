<?php
$id_dosen = antiInjection(@$_GET['id']);
if (!$id_dosen) {
	echo "<script>alert('ID tidak diketahui');</script>";
	redirectJs(moduleUrl('admin/dosen'));
}
$dosen = _getOneData('dosen', "id_dosen='$id_dosen'");
if (!$dosen) {
	echo "<script>alert('Dosen dengan ID $id_dosen tidak ada.');</script>";
	redirectJs(moduleUrl('admin/dosen'));
}
$defaultIdDosen = $dosen['id_dosen'];
$defaultNidn = flashData('nidn');
$defaultNamaDosen = flashData('nama_dosen');
$defaultGelarDepan = flashData('gelar_depan');
$defaultGelarBelakang = flashData('gelar_belakang');
if (!$defaultNamaDosen) $defaultNamaDosen = $dosen['nama_dosen'];
if (!$defaultNidn) $defaultNidn = $dosen['nidn'];
if (!$defaultGelarDepan) $defaultGelarDepan = $dosen['gelar_depan'];
if (!$defaultGelarBelakang) $defaultGelarBelakang = $dosen['gelar_belakang'];
?>
<section class="content-header">
	<h2>Edit Data Dosen</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/dosen', 'do_edit', 'id='.$id_dosen);?>" method="POST">

		                 <div class="form-group">
		                  <label>ID Dosen</label>
		                  <input type="text" class="form-control" placeholder="ID Dosen" value="<?=$defaultIdDosen;?>" name="id_dosen"  required="required" disabled="disabled">
		                </div>

		                <div class="form-group">
		                  <label>NIDN</label>
		                  <input type="text" class="form-control" placeholder="NIDN" value="<?=$defaultNidn;?>" name="nidn" required="required">
		                </div>

		                <div class="form-group">
		                  <label>Gelar Depan</label>
		                  <input type="text" class="form-control" placeholder="Gelar Depan" value="<?=$defaultGelarDepan;?>" name="gelar_depan">
		                </div>

						<div class="form-group">
		                  <label>Nama Dosen</label>
		                  <input type="text" class="form-control" placeholder="Nama Dosen" value="<?=$defaultNamaDosen;?>" name="nama_dosen"  required="required">
		                </div>

		                <div class="form-group">
		                  <label>Gelar Belakang</label>
		                  <input type="text" class="form-control" placeholder="Gelar Belakang" value="<?=$defaultGelarBelakang;?>" name="gelar_belakang">
		                </div>

		                <div class="form-group">
                  			<label>Jenis Kelamin</label>
                  			<select name="jenis_kelamin" class="form-control">
                   				 <option value="L">Laki-Laki</option>
                   				 <option value="P">Perempuan</option>
                			</select>
               			 </div>

                		<button type="submit" class="btn btn-primary">Edit</button>
                		<a href="<?=moduleUrl('admin/dosen');?>" class="btn btn-default">Batal</a>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->