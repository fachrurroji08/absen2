<?php redirectIfNotMahasiswa(); ?>
<?php 
includeIfNotAction(MAHASISWA_DIR.'header.php', ['hapus', 'do_edit', 'do_input']);

$action = getAction();
if ($action == 'index') {
	include 'index.php';
} elseif ($action == 'hapus') {
	include 'hapus.php';
} elseif ($action == 'edit') {
	include 'edit.php';
} elseif ($action == 'do_edit') {
	include 'do_edit.php';
} elseif ($action == 'input') {
	include 'input.php';
} elseif ($action == 'do_input') {
	include 'do_input.php';
}

includeIfNotAction(MAHASISWA_DIR.'footer.php', ['hapus', 'do_edit', 'do_input']);
?>
