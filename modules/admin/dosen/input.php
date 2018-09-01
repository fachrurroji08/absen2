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
		                  <label>ID Dosen</label>
		                  <input type="text" class="form-control" placeholder="ID Dosen" value="<?=flashData('id_dosen');?>" name="id_dosen"  required="required">
		                </div>

		                <div class="form-group">
		                  <label>NIDN</label>
		                  <input type="text" class="form-control" placeholder="NIDN" value="<?=flashData('nidn');?>" name="nidn" required="required">
		                </div>

		                <div class="form-group">
		                  <label>Gelar Depan</label>
		                  <input type="text" class="form-control" placeholder="Gelar Depan" value="<?=flashData('gelar_depan');?>" name="gelar_depan">
		                </div>

						<div class="form-group">
		                  <label>Nama Dosen</label>
		                  <input type="text" class="form-control" placeholder="Nama Dosen" value="<?=flashData('nama_dosen');?>" name="nama_dosen"  required="required">
		                </div>

		                <div class="form-group">
		                  <label>Gelar Belakang</label>
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
	</div>
</section>
<!-- /.content -->