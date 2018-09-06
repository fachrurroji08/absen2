<section class="content-header">
	<h2>Jadwal Absen</h2>
</section>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<table class="table table-hover table-bordered datatable">
						<thead>
							<tr>
								<th colspan="" rowspan="" headers="" scope="">
									No
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Nama Matakuliah
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Kelas
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Ruangan
								</th>
                                <th colspan="" rowspan="" headers="" scope="">
                                    Dosen
                                </th>
								<th colspan="" rowspan="" headers="" scope="">
									Hari/Jam
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Absen
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datas = _fetchMultipleFromSql(sprintf("SELECT * from view_krs where npm=%s",
								getProfile()['npm']) );
							$no=0;
							foreach ($datas as $key => $mahasiswa) {
								++$no;
								?>
								<tr>
									<td>
										<?=$no;?>
									</td>
									<td>
										<?=$mahasiswa['nama_matakuliah'];?>
									</td>
									<td>
										<?=strtoupper($mahasiswa['nama_kelas']);?>
									</td>
									<td>
										<?=$mahasiswa['nama_ruangan'];?>
									</td>
									<td>
										<?=$mahasiswa['nama_dosen'];?>
									</td>
									<td>
										<?=getDayIndonesia($mahasiswa['id_hari']);?><br/>
                                        <small class="text-danger">
                                            <?=$mahasiswa['jam_mulai'];?>
                                             -
                                            <?=$mahasiswa['jam_selesai'];?>
                                        </small>
									</td>
									<td>
                                        <?php
                                        $onJadwal =
                                            date('N') == $mahasiswa['id_hari']
                                            &&
                                            $mahasiswa['jam_mulai'] <= date('H:i:s')
                                            &&
                                            date('H:i:s') <= $mahasiswa['jam_selesai']
                                        ;

                                        if ($onJadwal) {
                                        	$query = sprintf(
                                        		"SELECT * from absen where tanggal_absen='%s' and waktu_absen >= '%s' and waktu_absen <= '%s' and npm='%s' ",
                                        		date('Y-m-d'),
                                        		$mahasiswa['jam_mulai'], 
                                        		$mahasiswa['jam_selesai'],
                                        		$mahasiswa['npm']
                                        	);
                                        	$sudahAbsen = _fetchOneFromSql($query);	
                                        } else {
                                        	$sudahAbsen = false;
                                        }

                                        if ($onJadwal && $sudahAbsen) {
                                            ?>
                                            <div class="alert alert-success">
                                            	Sudah Absen : <?=$sudahAbsen['status'];?><br/>
                                            <?=sprintf("%s %s", $sudahAbsen['tanggal_absen'], $sudahAbsen['waktu_absen']);?>
                                            </div>
                                            <?php
                                        } else if ($onJadwal) {
                                            ?>
                                            <a href="<?=moduleUrl('mahasiswa/absen', 'startAbsen', 'id_jadwal='.$mahasiswa['id_jadwal']);?>" class="btn btn-primary btn-xs" onclick="openWindow(event, this)">Absen</a>
                                            <?php
                                        } else {
                                            ?>
                                            Diluar Jadwal
                                            <?php
                                        }
                                        ?>

									</td>
								</tr>
								<?php
							}
							?>
						</tbody>	
					</table>
				</div>
			</div>
		</div>	
	</div>
</section>
<!-- /.content -->
<?php bufferStart();?>
<script type="text/javascript">
	function needConfirm(event, el) {
		event.preventDefault();
		var conf = confirm("Apakah yakin akan menghapus data ini ?");
		if (conf) {
			window.location.href = $(el).attr('href');
		}
	}
	function openWindow(event, el) {
        event.preventDefault();
        var url = $(el).attr('href');
        PopupCenter(url, "Absen Mata Kuliah", '900', '500');
    }

    function PopupCenter(url, title, w, h) {
        // Fixes dual-screen position                         Most browsers      Firefox
        var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : window.screenX;
        var dualScreenTop = window.screenTop != undefined ? window.screenTop : window.screenY;

        var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        var left = ((width / 2) - (w / 2)) + dualScreenLeft;
        var top = ((height / 2) - (h / 2)) + dualScreenTop;
        var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

        // Puts focus on the newWindow
        if (window.focus) {
            newWindow.focus();
        }
    }
</script>
<?php bufferEnd('scripts');?>