<?php

$id = antiInjection(@$_GET['id']);
if ($id) {
	$status = _deleteData('matakuliah', 'kode_matakuliah="'.$id.'"');
	flash()->success("Hapus Data matakuliah");
	redirect(moduleUrl('admin/matakuliah'));
}
else {
	flash()->error("ID Tidak ditemukan");
	redirect(moduleUrl('admin/matakuliah'));
}