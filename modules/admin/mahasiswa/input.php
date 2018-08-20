<section class="content-header">
	<h2>Input Mahasiswa</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/mahasiswa', 'do_input');?>" method="POST">
		                <div class="form-group">
		                  <label>NPM</label>
		                  <input type="text" class="form-control" placeholder="NPM" value="<?=flashData('npm');?>" name="npm"  required="required">
		                </div>
		                <div class="form-group">
		                  <label>Nama Mahasiswa</label>
		                  <input type="text" class="form-control" placeholder="Nama Mahasiswa" value="<?=flashData('nama_mahasiswa');?>" name="nama_mahasiswa" required="required">
		                </div>
                		<button type="submit" class="btn btn-primary">Tambah</button>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->