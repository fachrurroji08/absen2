<?php

try {
	$npm = @$_GET['id'];
	if (!$npm) throw new Exception("NPM harus diisi.", 1);

	$_SESSION['nama_mahasiswa'] = $_POST['nama_mahasiswa'];
	
	$nama_mahasiswa = antiInjection(@$_POST['nama_mahasiswa']);
	if (!$nama_mahasiswa) throw new Exception("Nama Mahasiswa harus diisi.", 1);

	$existsNpm = _getOneData('mahasiswa', "npm='$npm'");
	if (!$existsNpm) {
		 throw new Exception("NPM belum ada di database.", 1);
	}

	$data = compact('nama_mahasiswa');

	$status = _updateData('mahasiswa', $data, "npm='$npm'");
	if (!$status) {
		throw new Exception("Update Data Gagal.", 1);
	}
	flash()->success("Update Data Berhasil");
	redirect(moduleUrl('admin/mahasiswa', 'edit', "id=$npm"));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/mahasiswa', 'edit', "id=$npm"));
}