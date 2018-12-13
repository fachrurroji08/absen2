<?php

$id = antiInjection(@$_GET['id']);
if ($id) {
	$status = _deleteData('ruangan', 'id_ruangan='.$id);
	flash()->success("Hapus Data Ruangan");
	redirect(moduleUrl('admin/ruangan'));
}
else {
	flash()->error("ID Tidak ditemukan");
	redirect(moduleUrl('admin/ruangan'));
}