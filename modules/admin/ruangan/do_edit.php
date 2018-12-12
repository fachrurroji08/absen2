<?php

try {
	$id_ruangan = @$_GET['id'];
	if (!$id_ruangan) throw new Exception("ID harus diisi.", 1);

	$_SESSION['nama_ruangan'] = $_POST['nama_ruangan'];
	$_SESSION['kapasitas'] = $_POST['kapasitas'];
	
	$nama_ruangan = antiInjection(@$_POST['nama_ruangan']);
	if (!$nama_ruangan) throw new Exception("Nama Ruangan harus diisi.", 1);

	$kapasitas = antiInjection(@$_POST['kapasitas']);
	if (!$kapasitas) throw new Exception("Kapasitas harus diisi.", 1);

	$existsIdRuangan = _getOneData('ruangan', "id_ruangan='$id_ruangan'");
	if (!$existsIdRuangan) {
		 throw new Exception("ID belum ada di database.", 1);
	}
// if (!$latitude || !$longitude) throw new Exception("Lokasi harus diaktifkan terlebih dahulu");
	
	$data = compact('nama_ruangan','latitude','longitude','kapasitas');

	$status = _updateData('ruangan', $data, "id_ruangan='$id_ruangan'");
	if (!$status) {
		throw new Exception("Update Data Gagal.", 1);
	}
	flash()->success("Update Data Berhasil");
	redirect(moduleUrl('admin/ruangan', 'edit', "id=$id_ruangan"));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/ruangan', 'edit', "id=$id_ruangan"));
}