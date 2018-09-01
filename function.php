<?php

// Auth function
if (!function_exists('checkLogin')) {
	function checkLogin()
	{
		return checkLoginAdmin() || checkLoginDosen() || checkLoginMahasiswa();
	}
}
if (!function_exists('checkLoginAdmin')) {
	function checkLoginAdmin()
	{
		if (@$_SESSION['admin']) {
			return true;
		}
		return false;
	}
}

if (!function_exists('checkLoginDosen')) {
	function checkLoginDosen()
	{
		if (@$_SESSION['dosen']) {
			return true;
		}
		return false;
	}
}

if (!function_exists('checkLoginMahasiswa')) {
	function checkLoginMahasiswa()
	{
		if (@$_SESSION['mahasiswa']) {
			return true;
		}
		return false;
	}
}

if (!function_exists('redirectIfNotLogin')) {
	function redirectIfNotLogin()
	{
		if (
			!checkLogin()
		) {
			redirect(moduleUrl('login'));
		}
	}
}

if (!function_exists('redirectIfNotAdmin')) {
	function redirectIfNotAdmin()
	{
		if (
			!checkLoginAdmin()
		) {
			redirect(moduleUrl('login'));
		}
	}
}

if (!function_exists('redirectIfNotDosen')) {
	function redirectIfNotDosen()
	{
		if (
			!checkLoginDosen()
		) {
			redirect(moduleUrl('dosen'));
		}
	}
}

if (!function_exists('redirectIfNotMahasiswa')) {
	function redirectIfNotMahasiswa()
	{
		if (
			!checkLoginMahasiswa()
		) {
			redirect(moduleUrl('mahasiswa'));
		}
	}
}

if (!function_exists('getLevel')) {
	function getLevel()
	{
		return @$_SESSION['level'];
	}
}

// End Auth function

//Profile function
if (!function_exists('getProfile')) {
	function getProfile()
	{
		$level = getLevel();
		return @$_SESSION[$level];
	}
}

if (!function_exists('getNama')) {
	function getNama()
	{
		$level = getLevel();
		$profile = getProfile();
		return @$profile['nama_'.$level];
	}
}
//End Profil function

// Module function
if (!function_exists('getModule')) {
	function getModule()
	{
		return @$_GET['module'] ? antiInjection($_GET['module']) : 'home';
	}
}

if (!function_exists('getAction')) {
	function getAction()
	{
		return @$_GET['action'] ? antiInjection($_GET['action']) : 'index';
	}
}


if (!function_exists('isModuleExists')) {
	function isModuleExists($moduleName)
	{
		$moduleNameLast = explode("/", $moduleName);
		$moduleNameLast = $moduleNameLast[count($moduleNameLast)-1];
		$file1 = MODULE_DIR."$moduleName/$moduleNameLast.php";
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
	function moduleUrl($moduleName='', $moduleAction='', $otherGetData='')
	{
		if (is_array($otherGetData)) {
			$otherGetData = [];
			foreach ($otherGetData as $key => $value) {
			 	$otherGetData[] = "$key='$value'";
			}
			$otherGetData = implode("&", $otherGetData); 
		}
		return baseUrl("index.php?module=".$moduleName
			.($moduleAction?"&action=".$moduleAction : "")
			.($otherGetData?"&".$otherGetData:""));
	}
}

if (!function_exists('redirect')) {
	function redirect($url='')
	{
		header("Location:".$url);die();
	}
}

if (!function_exists('redirectJs')) {
	function redirectJs($url='')
	{
		echo sprintf("<script>window.location.href='%s'</script>", $url);die();
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
		if (!$query) return false;
		
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
		if (!$query) return false;
		return call_user_func_array($functionName, array($query) );
	}
}

if (!function_exists('_getMultipleData')) {
	function _getMultipleData($table, $where="1=1", $column="*", $group_by="", $order_by="") {
		$sql = sprintf("SELECT %s FROM %s WHERE %s %s %s", $column, $table, $column, 
			$group_by?("GROUP BY ".$group_by):"",
			$order_by?("ORDER BY ".$order_by):""
		);
		return _fetchMultipleFromSql($sql);
	}
}

if (!function_exists('_getOneData')) {
	function _getOneData($table, $where="1=1", $column="*", $group_by="", $order_by="") {
		$sql = sprintf("SELECT %s FROM %s WHERE %s %s %s", $column, $table, $where, 
			$group_by?("GROUP BY ".$group_by):"",
			$order_by?("ORDER BY ".$order_by):""
		);
		return _fetchOneFromSql($sql);
	}
}

if (!function_exists('_insertData')) {
	function _insertData($table, $columns) {
		$key = array_keys($columns);
		$sql = sprintf(
			"INSERT INTO %s (`%s`) VALUES ('%s')", 
			$table, 
			implode("`, `", $key), 
			implode("', '", $columns)
		);
		return _query($sql);
	}
}


if (!function_exists('_updateData')) {
	function _updateData($table, $columns, $where='1=1') {
		$newColumn = [];
		foreach ($columns as $key => $value) {
			$newColumn[] = sprintf("`%s`= '%s'", $key, $value);
		}
		$sql = sprintf(
			"UPDATE %s SET %s WHERE %s", 
			$table, 
			implode(", ", $newColumn), 
			$where
		);
		return _query($sql);
	}
}

if (!function_exists('_deleteData')) {
	function _deleteData($table, $where='1=1') {
		$sql = sprintf(
			"DELETE FROM %s WHERE %s", 
			$table,
			$where
		);
		return _query($sql);
	}
}


if (!function_exists('antiInjection')) {
	function antiInjection($data){
		$filter = mysqli_real_escape_string(connectDb(), 
			stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)))
		);
		return $filter;
	}
}

// End Database Function


// View Function
if (!function_exists('bufferStart')) {
	function bufferStart(){
		ob_start();
	}
}
if (!function_exists('bufferEnd')) {
	function bufferEnd($bufferName){
		$datas = (array) @$GLOBALS['datas'];
		if (!is_array($datas)) {
			$datas = [];
		}
		if (!array_key_exists($bufferName, $datas)) {
			$datas[$bufferName] = [];
		}
		$datas[$bufferName][] = ob_get_clean();
		$GLOBALS['datas'] = $datas;
	}
}
if (!function_exists('getBuffer')) {
	function getBuffer($bufferName){
		$datas = (array) @$GLOBALS['datas'];
		$data = (array) @$datas[$bufferName];
		return implode("", $data);
	}
}
if (!function_exists('includeIfNotAction')) {
	function includeIfNotAction($file, $actionExcept=[]){
		$action = getAction();
		if (!in_array($action, $actionExcept)) {
			include $file;
		}
	}
}
if (!function_exists('includeIfAction')) {
	function includeIfAction($file, $actionExcept=[]){
		$action = getAction();
		if (in_array($action, $actionExcept)) {
			include $file;
		}
	}
}

if (!function_exists('flashData')) {
	function flashData($flashName){
		$data = @$_SESSION[$flashName];
		unset($_SESSION[$flashName]);
		return $data;
	}
}


// End View Function



