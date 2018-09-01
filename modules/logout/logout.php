<?php
session_destroy();
$message = "Logout Berhasil!!";
flash()->success($message);
redirect(moduleUrl('login'));