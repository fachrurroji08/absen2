<?php

$host = getenv('DATABASE_HOST');
$username = getenv('DATABASE_USER');
$password = getenv('DATABASE_PASS');
$database = getenv('DATABASE_NAME');

connectDb($host, $username, $password, $database);




