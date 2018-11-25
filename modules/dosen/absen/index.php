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
					<table class="table table-hover table-bordered datatable" >
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
									Hari/Jam
								</th>
								<th colspan="" rowspan="" headers="" scope="">
									Pertemuan
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$datas = _fetchMultipleFromSql(sprintf("SELECT * from view_jadwal where id_dosen=%s",
								getProfile()['id_dosen']) );
							$no=0;
							foreach ($datas as $key => $jadwal) {
								++$no;
								?>
								<tr>
									<td>
										<?=$no;?>
									</td>
									<td>
										<?=$jadwal['nama_matakuliah'];?>
									</td>
                                    <td>
                                        <?php
                                        $onJadwal =
                                            date('w') == $jadwal['id_hari']
                                            &&
                                            $jadwal['jam_mulai'] <= date('H:i:s')
                                            &&
                                            date('H:i:s') <= $jadwal['jam_selesai']
                                        ;

                                        if ($onJadwal) {
                                            $sudahAbsen = $jadwal['pertemuan_ke'];
                                        } else {
                                            $sudahAbsen = false;
                                        }

                                        if ($onJadwal && $sudahAbsen) {
                                            ?>
                                            Pertemuan Ke-<?=$sudahAbsen;?><br>
                                            <a href="<?=moduleUrl('dosen/absen', 'lihat_pertemuan', 'id_jadwal='.$jadwal['id_jadwal']);?>" title="" class="btn btn-primary btn-sm">Lihat Pertemuan</a>
                                            <?php
                                        } else if ($onJadwal) {
                                            ?>
                                            <a href="<?=moduleUrl('dosen/absen', 'buat_pertemuan', 'id_jadwal='.$jadwal['id_jadwal']);?>" title="" class="btn btn-primary btn-sm">Buat Pertemuan</a>
                                            <?php
                                        } else {
                                            ?>
                                            Diluar Jadwal
                                            <?php
                                        }
                                        ?>

                                    </td>
									<td>
										<?=strtoupper($jadwal['nama_kelas']);?>
									</td>
									<td>
										<?=$jadwal['nama_ruangan'];?>
									</td>
									<td>
										<?=getDayIndonesia($jadwal['id_hari']);?><br/>
                                        <small class="text-danger">
                                            <?=$jadwal['jam_mulai'];?>
                                             -
                                            <?=$jadwal['jam_selesai'];?>
                                        </small>
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