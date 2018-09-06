<?php redirectIfNotAdmin(); ?>
<?php 
includeIfNotAction(ADMIN_DIR.'header.php', ['hapus', 'do_edit', 'do_input']);

basicCrud();

includeIfNotAction(ADMIN_DIR.'footer.php', ['hapus', 'do_edit', 'do_input']);
?>
