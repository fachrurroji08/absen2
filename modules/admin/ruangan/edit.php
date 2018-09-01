<?php
$id_ruangan = antiInjection(@$_GET['id']);
if (!$id_ruangan) {
	echo "<script>alert('ID tidak diketahui');</script>";
	redirectJs(moduleUrl('admin/ruangan'));
}
$ruangan = _getOneData('ruangan', "id_ruangan='$id_ruangan'");
if (!$ruangan) {
	echo "<script>alert('Ruangan dengan ID $id_ruangan tidak ada.');</script>";
	redirectJs(moduleUrl('admin/ruangan'));
}
$defaultIdRuangan = $ruangan['id_ruangan'];
$defaultNamaRuangan = flashData('nama_ruangan');
$defaultKapasitas = flashData('kapasitas');
if (!$defaultNamaRuangan) $defaultNamaRuangan = $ruangan['nama_ruangan'];
if (!$defaultKapasitas) $defaultKapasitas = $ruangan['kapasitas'];
?>
<section class="content-header">
	<h2>Edit Ruangan</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/ruangan', 'do_edit', 'id='.$id_ruangan);?>" method="POST">
		                <div class="form-group">
		                  <label>ID Ruangan</label>
		                  <input type="text" class="form-control" placeholder="ID Ruangan" value="<?=$defaultIdRuangan;?>" name="id_ruangan"  required="required" disabled="disabled">
		                </div>
		                <div class="form-group">
		                  <label>Nama Ruangan</label>
		                  <input type="text" class="form-control" placeholder="Nama Ruangan" value="<?=$defaultNamaRuangan;?>" name="nama_ruangan" required="required">
		                </div>
		                <div class="form-group">
		                  <label>Kapasitas</label>
		                  <input type="text" class="form-control" placeholder="Kapasitas" value="<?=$defaultKapasitas;?>" name="kapasitas" required="required">
		                </div>
                		<button type="submit" class="btn btn-primary">Edit</button>
                		<a href="<?=moduleUrl('admin/ruangan');?>" class="btn btn-default">Batal</a>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->