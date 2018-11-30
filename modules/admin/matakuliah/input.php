<section class="content-header">
	<h2>Input Matakuliah</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/matakuliah', 'do_input');?>" method="POST">
		                <div class="form-group">
		                  <label>Kode Matakuliah</label>
		                  <input type="text" class="form-control" placeholder="Kode Matakuliah" value="<?=flashData('kode_matakuliah');?>" name="kode_matakuliah"  required="required">
		                </div>
		                <div class="form-group">
		                  <label>Nama Matakuliah</label>
		                  <input type="text" class="form-control" placeholder="Nama Matakuliah" value="<?=flashData('nama_matakuliah');?>" name="nama_matakuliah" required="required">
		                </div>
                		<button type="submit" class="btn btn-primary">Tambah</button>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->