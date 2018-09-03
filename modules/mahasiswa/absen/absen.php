<?php redirectIfNotMahasiswa();

$except = ['startAbsen', 'get_dosen_location', 'simpan_absensi'];
includeIfNotAction(MAHASISWA_DIR.'header.php', $except);

includeIfAction(MAHASISWA_DIR.'header_no_sidebar.php', ['startAbsen']);

$actionList = array(
	'index', 'startAbsen', 'get_dosen_location', 'simpan_absensi'
);

enableRoute($actionList);

includeIfNotAction(MAHASISWA_DIR.'footer.php', $except);
includeIfAction(MAHASISWA_DIR.'footer.php', ['startAbsen']);
