<?php

try {
	$_SESSION['nama_ruangan'] = $_POST['nama_ruangan'];
	$_SESSION['kapasitas'] = $_POST['kapasitas'];

	
	$nama_ruangan = antiInjection(@$_POST['nama_ruangan']);
	if (!$nama_ruangan) throw new Exception("Nama Ruangan harus diisi.", 1);

	$kapasitas = antiInjection(@$_POST['kapasitas']);
	if (!$kapasitas) throw new Exception("Kapasitas harus diisi.", 1);
	
	$data = compact('nama_ruangan','kapasitas');

	$status = _insertData('ruangan', $data);
	if (!$status) {
		throw new Exception("Input Data Gagal.", 1);
	}
	flash()->success("Input Data Berhasil");
	redirect(moduleUrl('admin/ruangan'));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/ruangan', 'input'));
}