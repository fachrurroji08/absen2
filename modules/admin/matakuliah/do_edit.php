<?php

try {
	$kode_matakuliah = @$_GET['id'];
	if (!$kode_matakuliah) throw new Exception("kode Matakuliah harus diisi.", 1);

	$_SESSION['nama_matakuliah'] = $_POST['nama_matakuliah'];
	
	$nama_matakuliah = antiInjection(@$_POST['nama_matakuliah']);
	if (!$nama_matakuliah) throw new Exception("Nama Matakuliah harus diisi.", 1);

	$existskode_matakuliah = _getOneData('matakuliah', "kode_matakuliah='$kode_matakuliah'");
	if (!$existskode_matakuliah) {
		 throw new Exception("kode matakuliah belum ada di database.", 1);
	}

	$data = compact('nama_matakuliah');

	$status = _updateData('matakuliah', $data, "kode_matakuliah='$kode_matakuliah'");
	if (!$status) {
		throw new Exception("Update Data Gagal.", 1);
	}
	flash()->success("Update Data Berhasil");
	redirect(moduleUrl('admin/matakuliah', 'edit', "id=$kode_matakuliah"));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/matakuliah', 'edit', "id=$kode_matakuliah"));
}