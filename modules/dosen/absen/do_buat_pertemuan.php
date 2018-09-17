<?php
/**
 * Created by PhpStorm.
 * User: tik_squad
 * Date: 9/17/18
 * Time: 9:07 PM
 */

try {
    $id_jadwal = antiInjection(@$_GET['id_jadwal']);
    if (!$id_jadwal) throw new Exception("ID Jadwal harus diisi");

    $pertemuan_minggu_ini = get_pertemuan_minggu_ini($id_jadwal);
    if ($pertemuan_minggu_ini) throw new Exception("Pertemuan minggu ini sudah diisi");

    $lastPertemuan = get_last_pertemuan($id_jadwal);
    $nextPertemuan = ((int) $lastPertemuan)+1;
    $pertemuan_ke = $nextPertemuan;

    $jadwal = get_jadwal_by_id_jadwal($id_jadwal);
    if (!$jadwal) throw new Exception("Jadwal tidak ditemukan");

    $detail_pertemuan = antiInjection(@$_POST['detail_pertemuan']);
    $tanggal_pertemuan = date('Y-m-d');
    $jam_mulai = antiInjection(@$_POST['jam_mulai']);
//    $jam_selesai = antiInjection(@$_POST['jam_selesai']);
    $latitude = antiInjection(@$_POST['latitude']);
    $longitude = antiInjection(@$_POST['longitude']);

    if (!$latitude || !$longitude) throw new Exception("Lokasi harus diaktifkan terlebih dahulu");


    $id_ruangan = $jadwal['id_ruangan'];
    $id_dosen = getProfile()['id_dosen'];

    _insertData('pertemuan', compact(
        'id_jadwal', 'pertemuan_ke',
        'id_ruangan', 'latitude', 'longitude', 'id_dosen',
        'detail_pertemuan', 'tanggal_pertemuan',
        'jam_mulai'
//        'jam_selesai'
    ));
    flash()->success("Input Pertemuan Berhasil");
    return redirect(moduleUrl('dosen/absen', 'lihat_pertemuan', 'id_jadwal='.@$_GET['id_jadwal']));

} catch (Exception $e) {
    flash()->error($e->getMessage());
    return redirect(moduleUrl('dosen/absen', 'buat_pertemuan', 'id_jadwal='.@$_GET['id_jadwal']));
}