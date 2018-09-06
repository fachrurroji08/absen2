<?php

// general function
if (!function_exists('getDayIndonesia')) {
    function getDayIndonesia($index) {
        $days = [
            'Minggu', 'Senin', 'Selasa',
            'Rabu', 'Kamis', 'Jum\'at',
            'Sabtu'
        ];
        return array_key_exists($index, $days)
            ? $days[$index]
            : "No Day" ;
    }
}
// end general function

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

// Route Function
if (!function_exists('enableRoute')) {
    function enableRoute($listUrls)
    {
        $bts =  debug_backtrace();
        $actionFind = false;
        foreach ($bts as $bt) {
            $dir = @dirname($bt['file']);
            if ($dir==BASE_DIR) continue;
            $action = getAction();

            $file = array_key_exists($action, $listUrls)
                ? $listUrls[$action]
                : (in_array($action, $listUrls) ? $action : "not-found");

            $fullFile = sprintf(
                "%s/%s%s",
                $file=="not-found"?MODULE_DIR:$dir,
                $file,
                substr($file, -4) <> ".php" ? ".php" : ""
            );

            if (file_exists($fullFile)) {
                $actionFind = true;
                include $fullFile;
                break;
            }
        }
        if (!$actionFind) {
            echo "Aksi tidak ditemukan";
        }

    }
}
if (!function_exists('basicCrud')) {
    function basicCrud($adder=[], $except = []) {
        $actionList = array(
            'index', 'hapus', 'edit',
            'do_edit', 'input', 'do_input',
        );
        $diff = array_diff($actionList, $except);
        $actionList = array_merge($diff, $adder);
        enableRoute($actionList);
    }
}
// End Route Function

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
		$functionName = $mode == 'object' ? "mysqli_fetch_object" : "mysqli_fetch_assoc";
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
		$functionName = $mode == 'object' ? "mysqli_fetch_object" : "mysqli_fetch_assoc";
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
	function includeIfAction($file, $actions=[]){
		$action = getAction();
		if (in_array($action, $actions)) {
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

// Haversine Formula
if (!function_exists('haversineGreatCircleDistance')) {
	/**
	 * Calculates the great-circle distance between two points, with
	 * the Haversine formula.
	 * @param float $latitudeFrom Latitude of start point in [deg decimal]
	 * @param float $longitudeFrom Longitude of start point in [deg decimal]
	 * @param float $latitudeTo Latitude of target point in [deg decimal]
	 * @param float $longitudeTo Longitude of target point in [deg decimal]
	 * @param float $earthRadius Mean earth radius in [m]
	 * @return float Distance between points in [m] (same as earthRadius)
	 */
	function haversineGreatCircleDistance(
	  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
	{
	  // convert from degrees to radians
	  $latFrom = deg2rad($latitudeFrom);
	  $lonFrom = deg2rad($longitudeFrom);
	  $latTo = deg2rad($latitudeTo);
	  $lonTo = deg2rad($longitudeTo);

	  $latDelta = $latTo - $latFrom;
	  $lonDelta = $lonTo - $lonFrom;

	  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
	    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
	  return $angle * $earthRadius;
	}
}
// End Haversine Formula