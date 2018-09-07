<?php
$id_jadwal = @$_GET['id_jadwal'];
try {
    if ($id_jadwal) {

        $jadwal = _fetchOneFromSql(
                sprintf(
                        " select * from jadwal where id_jadwal='%s' and jam_mulai <= '%s' and '%s' <= jam_selesai and id_hari='%s' ",
                    $id_jadwal, date('H:i:s'), date('H:i:s'), date('N')
                )
        );
        if (!$jadwal) throw new Exception("Jadwal tidak ditemukan");

        $pertemuan = _fetchOneFromSql(
                sprintf(
                        " select * from pertemuan where id_jadwal='%s' and tanggal_pertemuan='%s' ",
                    $jadwal['id_jadwal'], date('Y-m-d')
                )
        );

        if (!$pertemuan) throw new Exception("Dosen belum melakukan absensi");
        if (
        $pertemuan['jam_selesai'] && date('H:i:s') > $pertemuan['jam_selesai']
        ) throw new Exception("Pertemuan sudah selesai");

        $data = compact('jadwal', 'pertemuan');

    } else {
        throw new Exception("ID Jadwal tidak ditemukan");
    }

    $status = 1;
    $message = "Terdapat data pertemuan";
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