<?php

$id = antiInjection(@$_GET['id']);
if ($id) {
	$status = _deleteData('mahasiswa', 'npm='.$id);
	flash()->success("Hapus Data Mahasiswa");
	redirect(moduleUrl('admin/mahasiswa'));
}
else {
	flash()->error("ID Tidak ditemukan");
	redirect(moduleUrl('admin/mahasiswa'));
}