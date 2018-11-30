<?php

try {
	$_SESSION['kode_matakuliah'] = $_POST['kode_matakuliah'];
	$_SESSION['nama_matakuliah'] = $_POST['nama_matakuliah'];

	$kode_matakuliah = antiInjection(@$_POST['kode_matakuliah']);
	if (!$kode_matakuliah) throw new Exception("Kode Matakuliah harus diisi.", 1);
	
	$nama_matakuliah = antiInjection(@$_POST['nama_matakuliah']);
	if (!$nama_matakuliah) throw new Exception("Nama Matakuliah harus diisi.", 1);

	$existsKodeMatakuliah = _getOneData('matakuliah', "kode_matakuliah='$kode_matakuliah'");
	if ($existsKodeMatakuliah) {
		 throw new Exception("Kode Matakuliah sudah ada di database.", 1);
	}

	$data = compact('kode_matakuliah', 'nama_matakuliah');

	$status = _insertData('matakuliah', $data);
	if (!$status) {
		throw new Exception("Input Data Gagal.", 1);
	}
	flash()->success("Input Data Berhasil");
	redirect(moduleUrl('admin/matakuliah'));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/matakuliah', 'input'));
}