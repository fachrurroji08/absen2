<?php redirectIfNotDosen();

$except = ['startAbsen', 'get_dosen_location', 'simpan_absensi', 'do_buat_pertemuan', 'detail_kehadiran', 'do_lihat_pertemuan'];
includeIfNotAction(DOSEN_DIR.'header.php', $except);

includeIfAction(DOSEN_DIR.'header_no_sidebar.php', ['startAbsen']);

$actionList = array(
	'index', 'startAbsen', 'get_dosen_location', 'simpan_pertemuan', 'buat_pertemuan',
    'do_buat_pertemuan', 'lihat_pertemuan', 'detail_kehadiran', 'do_lihat_pertemuan'
);

enableRoute($actionList);

includeIfNotAction(DOSEN_DIR.'footer.php', $except);
includeIfAction(DOSEN_DIR.'footer.php', ['startAbsen']);
