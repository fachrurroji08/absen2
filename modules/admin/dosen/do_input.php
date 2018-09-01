<?php

try {
	$_SESSION['id_dosen'] = $_POST['id_dosen'];
	$_SESSION['nidn'] = $_POST['nidn'];
	$_SESSION['nama_dosen'] = $_POST['nama_dosen'];
	$_SESSION['gelar_depan'] = $_POST['gelar_depan'];
	$_SESSION['gelar_belakang'] = $_POST['gelar_belakang'];
	$_SESSION['jenis_kelamin'] = $_POST['jenis_kelamin'];

	$id_dosen = antiInjection(@$_POST['id_dosen']);
	if (!$id_dosen) throw new Exception("ID harus diisi.", 1);
	
	$nidn = antiInjection(@$_POST['nidn']);
	if (!$nidn) throw new Exception("NIDN harus diisi.", 1);

	$nama_dosen = antiInjection(@$_POST['nama_dosen']);
	if (!$nama_dosen) throw new Exception("Nama dosen harus diisi.", 1);

	$gelar_depan = antiInjection(@$_POST['gelar_depan']);
	// if (!$gelar_depan) throw new Exception("Gelar depan harus diisi.", 1);

	$gelar_belakang = antiInjection(@$_POST['gelar_belakang']);
	// if (!$gelar_belakang) throw new Exception("Gelar belakang harus diisi.", 1);

	$jenis_kelamin = antiInjection(@$_POST['jenis_kelamin']);
	if (!$jenis_kelamin) throw new Exception("Jenis kelamin harus diisi.", 1);
	if (!in_array($jenis_kelamin, array ('L', 'P'))) throw new Exception("Jenis kelamin harus diisi dengan L atau P.", 1);

	$existsIdDosen = _getOneData('dosen', "id_dosen='$id_dosen'");
	if ($existsIdDosen) {
		 throw new Exception("ID sudah ada di database.", 1);
	}
	$existsNidn = _getOneData('dosen', "nidn='$nidn'");
	if ($existsNidn) {
		 throw new Exception("NIDN sudah ada di database.", 1);
	}

	$data = compact('id_dosen', 'nidn', 'nama_dosen', 'gelar_depan', 'gelar_belakang', 'jenis_kelamin');

	$status = _insertData('dosen', $data);
	if (!$status) {
		throw new Exception("Input Data Gagal.", 1);
	}
	flash()->success("Input Data Berhasil");
	redirect(moduleUrl('admin/dosen'));

} catch (Exception $e) {
	flash()->error($e->getMessage());
	redirect(moduleUrl('admin/dosen', 'input'));
}
