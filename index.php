<?php
session_start();

require './vendor/autoload.php';
$dotenv = new \Dotenv\Dotenv(__DIR__);
$dotenv->load();

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