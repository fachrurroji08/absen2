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
		                
                		<div class="form-group">
		                  <label>Lokasi</label>
		                  <div class="input-group">
                              <input type="text" class="form-control latitude" placeholder="Latitude" value="" name="" readonly="readonly">
                              <input type="hidden" class="latitude" name="latitude">
                              <span class="input-group-btn" style="width:0px;"></span>
                              <input type="text" class="form-control longitude" placeholder="Longitude" value="" name="" readonly="readonly">
                              <input type="hidden" class="longitude" name="longitude">
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-primary aktifkan_lokasi"><i class="fa fa-location-arrow"></i> Aktifkan</button>
                              </span>
                          </div>
		                </div>
                		<button type="submit" class="btn btn-primary">Tambah</button>
             		 </form>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->