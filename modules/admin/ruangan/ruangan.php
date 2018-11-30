<?php redirectIfNotAdmin(); ?>
<?php 
includeIfNotAction(ADMIN_DIR.'header.php', ['startAbsen', 'hapus', 'do_edit', 'do_input', 'get_ruangan_location.php']);

basicCrud();

includeIfNotAction(ADMIN_DIR.'footer.php', ['startAbsen', 'hapus', 'do_edit', 'do_input', 'get_ruangan_location.php']);
?>
