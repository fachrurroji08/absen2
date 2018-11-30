<?php
$kode_matakuliah = antiInjection(@$_GET['id']);
if (!$kode_matakuliah) {
	echo "<script>alert('Kode kode_matakuliah tidak diketahui');</script>";
	redirectJs(moduleUrl('admin/matakuliah'));
}
$matakuliah = _getOneData('matakuliah', "kode_matakuliah='$kode_matakuliah'");
if (!$matakuliah) {
	echo "<script>alert('matakuliah dengan Kode Matakuliah $kode_matakuliah tidak ada.');</script>";
	redirectJs(moduleUrl('admin/matakuliah'));
}
$defaultKodeMatakuliah = $matakuliah['kode_matakuliah'];
$defaultNamaMatakuliah = flashData('nama_matakuliah');
if (!$defaultNamaMatakuliah) $defaultNamaMatakuliah = $matakuliah['nama_matakuliah'];
?>
<section class="content-header">
	<h2>Edit Matakuliah</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/matakuliah', 'do_edit', 'id='.$kode_matakuliah);?>" method="POST">
		                <div class="form-group">
		                  <label>Kode Matakuliah</label>
		                  <input type="text" class="form-control" placeholder="kode_matakuliah" value="<?=$defaultKodeMatakuliah;?>" name="kode_matakuliah"  required="required" disabled="disabled">
		                </div>
		                <div class="form-group">
		                  <label>Nama matakuliah</label>
		                  <input type="text" class="form-control" placeholder="Nama matakuliah" value="<?=$defaultNamaMatakuliah;?>" name="nama_matakuliah" required="required">
		                </div>
                		<button type="submit" class="btn btn-primary">Edit</button>
                		<a href="<?=moduleUrl('admin/matakuliah');?>" class="btn btn-default">Batal</a>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->