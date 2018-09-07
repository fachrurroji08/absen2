<?php redirectIfNotDosen();

$except = ['startAbsen', 'get_dosen_location', 'simpan_absensi'];
includeIfNotAction(DOSEN_DIR.'header.php', $except);

includeIfAction(DOSEN_DIR.'header_no_sidebar.php', ['startAbsen']);

$actionList = array(
	'index', 'startAbsen', 'get_dosen_location', 'simpan_pertemuan', 'pertemuan'
);

enableRoute($actionList);

includeIfNotAction(DOSEN_DIR.'footer.php', $except);
includeIfAction(DOSEN_DIR.'footer.php', ['startAbsen']);
