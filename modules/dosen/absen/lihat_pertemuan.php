<section class="content-header">
    <h2>Input Pertemuan Dosen</h2>
</section>

<?php
$id_jadwal = @$_GET['id_jadwal'];
$pertemuan_minggu_ini = get_pertemuan_minggu_ini($id_jadwal);
if (!$pertemuan_minggu_ini) {
    return redirectJs(moduleUrl('dosen/absen', 'lihat_pertemuan', 'id_jadwal='.$id_jadwal));
    die();
}

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
                    <form role="form" action="<?=moduleUrl('dosen/absen', 'do_lihat_pertemuan', 'id_jadwal='.$id_jadwal);?>" method="POST">

                        <div class="form-group">
                            <label>Pertemuan</label>
                            <input type="text" class="form-control" placeholder="Pertemuan" value="<?=$pertemuan_minggu_ini['pertemuan_ke'];?>" name="id_dosen"  required="required" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label>Ruangan</label>
                            <input type="text" class="form-control" placeholder="Nama Ruangan" value="<?=$jadwal['nama_ruangan'];?>" name="nama_ruangan" required="required" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label>Detail Pertemuan</label>
                            <textarea name="detail_pertemuan" class="form-control"><?=$pertemuan_minggu_ini['detail_pertemuan'];?></textarea>
                        </div>

                        <div class="form-group">
                            <label>Tanggal Pertemuan</label>
                            <input type="text" class="form-control" placeholder="tanggal_pertemuan" value="<?=$pertemuan_minggu_ini['tanggal_pertemuan'];?>" name="tanggal_pertemuan"  required="required" readonly="readonly">
                        </div>

                        <div class="form-group">
                            <label>Jam Mulai</label>
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" class="form-control timepicker" name="jam_mulai" value="<?=$pertemuan_minggu_ini['jam_mulai'];?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jam Selesai</label>
                            <div class="input-group bootstrap-timepicker ">
                                <input type="text" class="form-control timepicker" name="jam_selesai" value="<?=$pertemuan_minggu_ini['jam_selesai'];?>">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div>
                        </div>



                        <div class="form-group">
                            <label>Lokasi</label>
                            <div class="input-group">
                                <input type="text" class="form-control latitude" placeholder="Latitude" value="<?=$pertemuan_minggu_ini['latitude'];?>" name="" readonly="readonly">
                                <input type="hidden" class="latitude" name="latitude"  value="<?=$pertemuan_minggu_ini['latitude'];?>">
                                <span class="input-group-btn" style="width:0px;"></span>
                                <input type="text" class="form-control longitude" placeholder="Longitude" value="<?=$pertemuan_minggu_ini['longitude'];?>" name="" readonly="readonly">
                                <input type="hidden" class="longitude" name="longitude" value="<?=$pertemuan_minggu_ini['longitude'];?>">
                                <span class="input-group-btn">
                                  <button type="button" class="btn btn-primary aktifkan_lokasi"><i class="fa fa-location-arrow"></i> Aktifkan</button>
                              </span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="<?=moduleUrl('dosen/absen');?>" class="btn btn-default">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-body" id="update-status-kehadiran">
                    <?php
                    include  DOSEN_DIR."/absen/detail_kehadiran.php";
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
    function loadKehadiran() {
        var url = '<?=moduleUrl('dosen/absen', 'detail_kehadiran', 'id_jadwal='.$id_jadwal);?>';
        $.ajax({
            url:url,
            type:'get',
            success:function (a, b) {
                $("#update-status-kehadiran").html(a);
                setTimeout(loadKehadiran, 2000);
            }
        })
    }
    setTimeout(loadKehadiran, 2000);
</script>
<?php bufferEnd('scripts'); ?>
