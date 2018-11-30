<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/17/18
 * Time: 10:38 PM
 */

if (!isset($id_jadwal) || !$id_jadwal || isset($jadwal) || !$jadwal || isset($pertemuan_minggu_ini) || !$pertemuan_minggu_ini) {

    $id_jadwal = @$_GET['id_jadwal'];
    $pertemuan_minggu_ini = get_pertemuan_minggu_ini($id_jadwal);
    if (!$pertemuan_minggu_ini) {
        return redirectJs(moduleUrl('dosen/absen', 'lihat_pertemuan', 'id_jadwal='.$id_jadwal));
        die();
    }
    $jadwal = get_jadwal_by_id_jadwal($id_jadwal);
}

?>

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
    $id_pertemuan = $pertemuan_minggu_ini['id_pertemuan'];
    $mahasiswas = _fetchMultipleFromSql(
        "	SELECT v.*, m.nama_mahasiswa, a.status, a.waktu_absen, a.tanggal_absen, a.latitude, a.longitude, a.user_agent
            from view_krs v
            join mahasiswa m on m.npm=v.npm
            left join absen a on a.npm=m.npm and a.id_pertemuan='$id_pertemuan' 
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
            <td>
                <?php
                if ($mahasiswa['status']) {
                    echo sprintf("%s<br/><small>%s</small>", $mahasiswa['status'], $mahasiswa['waktu_absen']);
                } else {
                    echo "Belum Hadir";
                }
                ?>
            </td>
            <td>
                <?php
                $latitude_dosen = $pertemuan_minggu_ini['latitude'];
                $longitude_dosen = $pertemuan_minggu_ini['longitude'];
                if ($mahasiswa['latitude'] && $mahasiswa['longitude']) {
                    echo sprintf("%s meter<br/>%s || %s", number_format(haversineGreatCircleDistance(
                        $mahasiswa['latitude'], $mahasiswa['longitude'],
                        $latitude_dosen, $longitude_dosen
                    ), 2, ".", ","),
                        $mahasiswa['latitude'], $mahasiswa['longitude']
                    );
                    echo "<br/>";
                    echo $mahasiswa['user_agent'];
                } else {
                    echo "--";
                }
                ?>
            </td>
        </tr>
        <?php
    }

    ?>
    </tbody>
</table>
