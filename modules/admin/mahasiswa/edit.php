<?php
$npm = antiInjection(@$_GET['id']);
if (!$npm) {
	echo "<script>alert('NPM tidak diketahui');</script>";
	redirectJs(moduleUrl('admin/mahasiswa'));
}
$mahasiswa = _getOneData('mahasiswa', "npm='$npm'");
if (!$mahasiswa) {
	echo "<script>alert('Mahasiswa dengan NPM $npm tidak ada.');</script>";
	redirectJs(moduleUrl('admin/mahasiswa'));
}
$defaultNpm = $mahasiswa['npm'];
$defaultNamaMahasiswa = flashData('nama_mahasiswa');
if (!$defaultNamaMahasiswa) $defaultNamaMahasiswa = $mahasiswa['nama_mahasiswa'];
?>
<section class="content-header">
	<h2>Edit Mahasiswa</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/mahasiswa', 'do_edit', 'id='.$npm);?>" method="POST">
		                <div class="form-group">
		                  <label>NPM</label>
		                  <input type="text" class="form-control" placeholder="NPM" value="<?=$defaultNpm;?>" name="npm"  required="required" disabled="disabled">
		                </div>
		                <div class="form-group">
		                  <label>Nama Mahasiswa</label>
		                  <input type="text" class="form-control" placeholder="Nama Mahasiswa" value="<?=$defaultNamaMahasiswa;?>" name="nama_mahasiswa" required="required">
		                </div>
                		<button type="submit" class="btn btn-primary">Edit</button>
                		<a href="<?=moduleUrl('admin/mahasiswa');?>" class="btn btn-default">Batal</a>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->