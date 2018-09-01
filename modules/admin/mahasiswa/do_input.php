<?php

try {
	$_SESSION['npm'] = $_POST['npm'];
	$_SESSION['nama_mahasiswa'] = $_POST['nama_mahasiswa'];

	$npm = antiInjection(@$_POST['npm']);
	if (!$npm) throw new Exception("NPM harus diisi.", 1);
	
	$nama_mahasiswa = antiInjection(@$_POST['nama_mahasiswa']);
	if (!$nama_mahasiswa) throw new Exception("Nama Mahasiswa harus diisi.", 1);

	$existsNpm = _getOneData('mahasiswa', "npm='$npm'");
	if ($existsNpm) {
		 throw new Exception("NPM sudah ada di database.", 1);
	}

	$data = compact('npm', 'nama_mahasiswa');

	$status = _insertData('mahasiswa', $data);
	if (!$status) {
		throw new Exception("Input Data Gagal.", 1);
	}
	flash()->success("Input Data Berhasil");
	redirect(moduleUrl('admin/mahasiswa'));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/mahasiswa', 'input'));
}