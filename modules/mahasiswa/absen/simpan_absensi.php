<?php
$latMahasiswa = @$_POST['latMahasiswa'];
$lngMahasiswa = @$_POST['lngMahasiswa'];
$dataPertemuan = @$_POST['dataPertemuan'];
$id_jadwal = @$_POST['id_jadwal'];
$id_pertemuan = @$_POST['id_pertemuan'];
$user = getProfile();
$npm = $user['npm'];
try {
    if ($id_jadwal && $id_pertemuan) {

        $jadwal = _fetchOneFromSql(
                sprintf(
                        " select * from jadwal where id_jadwal='%s' and jam_mulai <= '%s' and '%s' <= jam_selesai and id_hari='%s'  ",
                    $id_jadwal, date('H:i:s'), date('H:i:s'), date('N')
                )
        );
        if (!$jadwal) throw new Exception("Jadwal tidak ditemukan");

        $pertemuan = _fetchOneFromSql(
                sprintf(
                        " select * from pertemuan where id_jadwal='%s' and tanggal_pertemuan='%s'",
                    $jadwal['id_jadwal'], date('Y-m-d')
                )
        );

        if (!$pertemuan) throw new Exception("Dosen belum melakukan absensi");
        if (
        $pertemuan['jam_selesai'] && date('H:i:s') > $pertemuan['jam_selesai']
        ) throw new Exception("Pertemuan sudah selesai");

        $absen = _fetchOneFromSql(
            sprintf(
                " select * from absen where id_pertemuan='%s' and npm='%s' ",
                $id_pertemuan, $npm
            )
        );
        if ($absen) throw new Exception("Anda sudah pernah melakukan absen dengan status kehadiran ".$absen['status']);

        $status_hadir = 'hadir';
        $data = array(
            'id_pertemuan' => $id_pertemuan,
            'status' => $status_hadir,
            'waktu_absen' => date('H:i:s'),
            'tanggal_absen' => date('Y-m-d'),
            'latitude' => $latMahasiswa,
            'longitude' => $lngMahasiswa,
            'npm' => $npm
        );
        _insertData('absen', $data);


    } else {
        throw new Exception("ID Jadwal tidak ditemukan");
    }

    $status = 1;
    $message = "Absen Berhasil";
} catch (Exception $e) {
    $status = 0;
    $message = $e->getMessage();
    $data = array();
}
header("Content-Type:application/json");
echo json_encode(array(
    'status' => $status,
    'message' => $message,
    'data' => $data
));
?>