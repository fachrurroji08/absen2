<?php

try {
	$id_ruangan = @$_POST['id_ruangan'];
	if (!$id_ruangan) {
		throw new Exception("Silahkan masukkan id ruangan", 1);
	}
	$ruangan = _fetchOneFromSql(
            sprintf(
                " select * from ruangan where id_ruangan='%s' ",
                $id_ruangan
            )
        );
	if (!$ruangan) {
		throw new Exception("Ruangan tidak ditemukan.", 1);
	}
	$data = array(
		'latitude' => $ruangan['latitude'],
		'longitude' => $ruangan['longitude'],
	);

	$status=1;
	$message="Berhasil mengambil data lokasi";

} catch (Exception $e) {
	$message = $e->getMessage();
	$status=0;
	$data=array();
}

header("Content-Type:application/json");
echo json_encode(array(
    'status' => $status,
    'message' => $message,
    'data' => $data
));