<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/1/18
 * Time: 11:12 PM
 */

?>
<!-- Main content -->
<section class="content container-fluid">
    <div class="panel text-center">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-5x fa-map-marker faa-bounce animated"></i><br>
                    <span id="progress">
                        Loading Kehadiran
                    </span>
                    <span id="progress-titik">
                        .....
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>

<?php
// 1. baca lokasi dosen ->tidak ada : alert(tidak ada jadwal)
// 2. baca lokasi mahasiswa
//      ->tidak ada : alert(lokasi tidak bisa dibaca)
//      ->lokasi diluar batas toleransi (tidak bisa absen)
// 3. munculkan tombol absen
// 
?>

<?php bufferStart();?>
<script>
    
    function progressTitik() {
        var titik = ".";
        var angka = 1;

        function timeOutFunc() {
            setTimeout(function () {
                $("#progress-titik").html(titik.repeat(angka));
                angka = angka >= 7 ? 1 : (angka+1);
                timeOutFunc();
            }, 200);
        }
        timeOutFunc();
    }
    function setProgress(message) {
        $("#progress").html(message);
    }
    
    function redirectBackInSeconds() {
        setTimeout(function () {
            //window.location.href = "<?//=moduleUrl('mahasiswa/absen');?>//";
            window.close();
        }, 1000);
    }
    var dataAbsen = {};
    function bacaLokasiDosen() {
        setProgress("Baca Pertemuan & Lokasi Dosen");
        var $dosenId = "<?=$_GET['id_jadwal'];?>";
        var url = "<?=moduleUrl('mahasiswa/absen', 'get_dosen_location');?>&id_jadwal="+$dosenId;
        $.ajax({
            type:'get',
            url:url,
            success:function (a,b) {
                dataAbsen = Object.assign(a, dataAbsen);
                proccessDataAbsen();
            },
            error:function (a,b) {
                alert(a);
            }
        })
    }
    
    function proccessDataAbsen() {
        setProgress("Proses Data Absen");
        if (dataAbsen['status']==0) {
            alert(dataAbsen['message']);
            redirectBackInSeconds();
        } else {
            bacaLokasiMahasiswa();
        }
    }
    
    function bacaLokasiMahasiswa() {
        setProgress("Proses Lokasi Mahasiswa");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                dataAbsen = Object.assign(dataAbsen, {position: position});
                simpanAbsensi();
            }, function (error) {
                alert("Pengaksesan lokasi tidak diizinkan. Anda tidak bisa melakukan absensi.");
                redirectBackInSeconds();
            });
        } else {
            alert("Geolocation is not supported by this browser.");
            redirectBackInSeconds();
        }
    }
    
    function simpanAbsensi() {
        var latMahasiswa = dataAbsen.position.coords.latitude;
        var lngMahasiswa = dataAbsen.position.coords.longitude;
        var id_pertemuan = dataAbsen.data.pertemuan.id_pertemuan;
        var id_jadwal = dataAbsen.data.jadwal.id_jadwal;
        var url = "<?=moduleUrl('mahasiswa/absen', 'simpan_absensi');?>";
        $.ajax({
            type:'post',
            url:url,
            data:{latMahasiswa: latMahasiswa, lngMahasiswa: lngMahasiswa, id_pertemuan: id_pertemuan, id_jadwal: id_jadwal},
            success:function (a,b) {
                if (a['status']==0) {
                    setProgress("Absen Gagal");
                } else {
                    setProgress("Absen Berhasil");
                }
                alert(a['message']);
                redirectBackInSeconds();
            },
            error:function (a,b) {
                alert(a);
            }
        })
    }

    bacaLokasiDosen();
    progressTitik();

    window.onunload = refreshParent;
    function refreshParent() {
        window.opener.location.href = window.opener.location;
    }
    


</script>
<?php bufferEnd('scripts');?>

