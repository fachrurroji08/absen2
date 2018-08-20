<?php

// Auth function
if (!function_exists('checkLoginAdmin')) {
	function checkLoginAdmin()
	{
		if (@$_SESSION['admin']) {
			return true;
		}
		return false;
	}
}

if (!function_exists('redirectIfNotLogin')) {
	function redirectIfNotLogin()
	{
		if (!checkLoginAdmin() && getModule() != "login") {
			header("Location:index.php?module=login");die();
		}
	}
}
// End Auth function


// Module function
if (!function_exists('getModule')) {
	function getModule()
	{
		return @$_GET['module'] ? $_GET['module'] : 'home';
	}
}

if (!function_exists('getAction')) {
	function getAction()
	{
		return @$_GET['action'] ? $_GET['action'] : 'index';
	}
}


if (!function_exists('isModuleExists')) {
	function isModuleExists($moduleName)
	{
		$file1 = MODULE_DIR."$moduleName/$moduleName.php";
		$file2 = MODULE_DIR."$moduleName/index.php";

		if (file_exists($file1)) {
			return $file1;
		}
		else if (file_exists($file2)) {
			return $file2;
		}
		else {
			return false;
		}

	}
}
// End Module function

// Url Function 
if (!function_exists('baseUrl')) {
	function baseUrl($secondUrl='')
	{
		return BASE_URL.$secondUrl;

	}
}
if (!function_exists('moduleUrl')) {
	function moduleUrl($moduleName='', $moduleAction='')
	{
		return baseUrl("index.php?module=".$moduleName.($moduleAction?"&action=".$moduleAction : ""));
	}
}

if (!function_exists('redirect')) {
	function redirect($url='')
	{
		header("Location:".$url);die();
	}
}

// End Url function

// Database Function

if (!function_exists('connectDb')) {
	function connectDb($host='', $username='', $password='', $databaseName='') {
		static $database;

		if ($database == null) {
			$database = mysqli_connect($host, $username, $password, $databaseName);
			if (mysqli_connect_errno()) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
				die();
			}
			
		}
		return $database;
	}
}

if (!function_exists('_query')) {
	function _query($sql) {
		return mysqli_query(connectDb(), $sql);
	}
}

if (!function_exists('_fetchMultipleFromSql')) {
	function _fetchMultipleFromSql($sql, $mode="array") {
		$functionName = $mode == 'object' ? "mysqli_fetch_object" : "mysqli_fetch_array";
		$query = _query($sql);
		$results=[];
		
		while ($obj = call_user_func_array($functionName, array($query))) {
			$results[]=$obj;
		}
		return $results;
	}
}

if (!function_exists('_fetchOneFromSql')) {
	function _fetchOneFromSql($sql, $mode="array") {
		$functionName = $mode == 'object' ? "mysqli_fetch_object" : "mysqli_fetch_array";
		$query = _query($sql);
		$results=[];
		
		return call_user_func_array($functionName, array($query) );
	}
}


if (!function_exists('_fetchDataFromSql')) {
	function anti_injection($data){
		$filter = mysqli_real_escape_string(connectDb(), 
			stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)))
		);
		return $filter;
	}
}

// End Database Function


