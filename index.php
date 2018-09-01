<?php
session_start();

require './vendor/autoload.php';
include "config.php";
include "function.php";
include "connection.php";



$module = getModule();
$moduleExists = isModuleExists($module);

if ($moduleExists) {
	include $moduleExists;
} else {
	echo "Module Tidak Ditemukan";
}