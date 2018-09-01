<section class="content-header">
	<h2>Input Ruangan</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/ruangan', 'do_input');?>" method="POST">

		                <div class="form-group">
		                  <label>Nama Ruangan</label>
		                  <input type="text" class="form-control" placeholder="Nama Ruangan" value="<?=flashData('nama_ruangan');?>" name="nama_ruangan" required="required">
		                </div>

						<div class="form-group">
		                  <label>Kapasitas</label>
		                  <input type="text" class="form-control" placeholder="Kapasitas" value="<?=flashData('kapasitas');?>" name="kapasitas" required="required">
		                </div>
                		
                		<button type="submit" class="btn btn-primary">Tambah</button>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->