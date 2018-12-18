<section class="content-header">
	<h2>Input Pertemuan Dosen</h2>
</section>

<?php
$id_jadwal = @$_GET['id_jadwal'];
$pertemuan_minggu_ini = get_pertemuan_minggu_ini($id_jadwal);
if ($pertemuan_minggu_ini) {
    return redirectJs(moduleUrl('dosen/absen', 'lihat_pertemuan', 'id='.$id_jadwal));
    die();
}
$lastPertemuan = get_last_pertemuan($id_jadwal);
$nextPertemuan = ((int) $lastPertemuan)+1;

$jadwal = get_jadwal_by_id_jadwal($id_jadwal);


?>


<?php bufferStart();?>
<script>
    //Timepicker
    $('.timepicker').timepicker({
        showSeconds: true,
        showMeridian: false,
    })
</script>
<?php bufferEnd('scripts');?>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('dosen/absen', 'do_buat_pertemuan', 'id_jadwal='.$id_jadwal);?>" method="POST">

		                <div class="form-group">
		                  <label>Pertemuan</label>
		                  <input type="text" class="form-control" placeholder="Pertemuan" value="<?=$nextPertemuan;?>" name="id_dosen"  required="required" readonly="readonly">
		                </div>

		                <div class="form-group">
		                  <label>Ruangan</label>
		                  <select name="id_ruangan" class="form-control" onchange="changeLatitudeLongitude(event, this);">
		                  	<option value='' selected="selected">--Pilih Ruangan--</option>
	                   		<?php
	                   		$datas = _fetchMultipleFromSql ("SELECT * FROM ruangan");

	                   		foreach ($datas as $data) {
	                   			$id = $data['id_ruangan'];
	                   			$value = $data['nama_ruangan'];
	                   			echo "<option value='$id'>$value</option>";
	                   		}
	                   		?>
                			</select>
		                </div>

		                <div class="form-group">
		                  <label>Detail Pertemuan</label>
		                  <textarea name="detail_pertemuan" class="form-control"></textarea>
		                </div>

						<div class="form-group">
		                  <label>Tanggal Pertemuan</label>
		                  <input type="text" class="form-control" placeholder="tanggal_pertemuan" value="<?=date('Y-m-d');?>" name="tanggal_pertemuan"  required="required" readonly="readonly">
		                </div>

						<div class="form-group">
		                  <label>Jam Mulai</label>
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control timepicker" name="jam_mulai">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
		                </div>
<!--                        -->
<!--						<div class="form-group">-->
<!--		                  <label>Jam Selesai</label>-->
<!--                            <div class="input-group bootstrap-timepicker ">-->
<!--                                <input type="text" class="form-control timepicker" name="jam_selesai">-->
<!--                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>-->
<!--                            </div>-->
<!--		                </div>-->



		                <div class="form-group">
		                  <label>Lokasi</label>
		                  <div class="input-group">
                              <input type="text" class="form-control latitude" placeholder="Latitude" value="" name="latitude" readonly="readonly">
                              <span class="input-group-btn" style="width:0px;"></span>
                              <input type="text" class="form-control longitude" placeholder="Longitude" value="" name="longitude" readonly="readonly">
                          </div>
		                </div>

                		<button type="submit" class="btn btn-primary">Simpan</button>
                		<a href="#" class="btn btn-default">Kembali</a>
             		 </form>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
                    Silahkan Simpan Pertemuan Terlebih Dahulu
                    <?php
                    /*
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
							$mahasiswas = _fetchMultipleFromSql(
							"	SELECT v.*, m.nama_mahasiswa 
								from view_krs v 
								join mahasiswa m on m.npm=v.npm
								where v.id_jadwal='$id_jadwal' order by m.npm, m.nama_mahasiswa 
							");

							$no = 0;
							foreach ($mahasiswas as $key => $mahasiswa) {
								++$no;
								?>
								<tr>
									<td><?=$no;?></td>
									<td>
										<?=$mahasiswa['nama_mahasiswa'];?>
										<br>
										<small class="text-danger"><?=$mahasiswa['npm'];?></small>
									</td>
									<td><?=$mahasiswa['nama_mahasiswa'];?></td>
									<td>Lokasi</td>
								</tr>
								<?php
							}

							?>
						</tbody>
					</table>
                     */
                    ?>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->
<?php bufferStart();?>
<script>
    $(".aktifkan_lokasi").click(function (event) {
        event.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function showPosition(position) {
                $(".latitude").val(position.coords.latitude);
                $(".longitude").val(position.coords.longitude);
            }, function (error) {
                alert("Geolokasi tidak didukung");
            });
        } else {
            alert("Geolokasi tidak didukung");
        }
    })
    function changeLatitudeLongitude(event, el) {
    	event.preventDefault();
    	var value = $(el).find('option:selected').val();
    	$.ajax({
    		type:'POST',
    		url:'<?=moduleUrl("dosen/absen", 'getLocation');?>',
    		data:{id_ruangan:value},
    		success:function (a, b) {
    			var data = a.data;
    			if (data) {
    				$(".latitude").val(data.latitude);
    				$(".longitude").val(data.longitude);
    			}
    		}
    	})
    }
</script>
<?php bufferEnd('scripts'); ?>
