<?php

$level = getLevel();
if ($level == 'admin' ) {
  redirect(moduleUrl('admin/dashboard'));
}
if ($level == 'dosen' ) {
  redirect(moduleUrl('dosen/dashboard'));
}
if ($level == 'mahasiswa' ) {
  redirect(moduleUrl('mahasiswa/dashboard'));
}
echo "Level tidak diketahui";