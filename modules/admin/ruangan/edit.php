<?php
$id_ruangan = antiInjection(@$_GET['id']);
if (!$id_ruangan) {
	echo "<script>alert('ID tidak diketahui');</script>";
	redirectJs(moduleUrl('admin/ruangan'));
}
$ruangan = _getOneData('ruangan', "id_ruangan='$id_ruangan'");
if (!$ruangan) {
	echo "<script>alert('Ruangan dengan ID $id_ruangan tidak ada.');</script>";
	redirectJs(moduleUrl('admin/ruangan'));
}
$defaultIdRuangan = $ruangan['id_ruangan'];
$defaultNamaRuangan = flashData('nama_ruangan');
$defaultKapasitas = flashData('kapasitas');
if (!$defaultNamaRuangan) $defaultNamaRuangan = $ruangan['nama_ruangan'];
if (!$defaultKapasitas) $defaultKapasitas = $ruangan['kapasitas'];
?>
<section class="content-header">
	<h2>Edit Ruangan</h2>
</section>
<style>
    #map {
        height: 400px;
    }
</style>

<!-- Main content -->
<section class="content container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="box">
				<div class="box-body">
					<?=flash()->display();?>
					<form role="form" action="<?=moduleUrl('admin/ruangan', 'do_edit', 'id='.$id_ruangan);?>" method="POST">
		                <div class="form-group">
		                  <label>ID Ruangan</label>
		                  <input type="text" class="form-control" placeholder="ID Ruangan" value="<?=$defaultIdRuangan;?>" name="id_ruangan"  required="required" disabled="disabled">
		                </div>
		                <div class="form-group">
		                  <label>Nama Ruangan</label>
		                  <input type="text" class="form-control" placeholder="Nama Ruangan" value="<?=$defaultNamaRuangan;?>" name="nama_ruangan" required="required">
		                </div>
		                <div class="form-group">
		                  <label>Kapasitas</label>
		                  <input type="text" class="form-control" placeholder="Kapasitas" value="<?=$defaultKapasitas;?>" name="kapasitas" required="required">
		                </div>

		                <div class="form-group">
		                  <label>Lokasi</label>
		                  <div class="input-group">
                              <input type="text" class="form-control latitude" id="latitude" placeholder="Latitude" value="" name="latitude" readonly="readonly">                              
                              <span class="input-group-btn" style="width:0px;"></span>
                              <input type="text" class="form-control longitude" id="longitude" placeholder="Longitude" value="" name="longitude" readonly="readonly">                           
                              <span class="input-group-btn">
                                  <button type="button" class="btn btn-primary aktifkan_lokasi" onclick="aktifkanLokasi(event, this)"><i class="fa fa-location-arrow"></i> Aktifkan</button>
                              </span>
                          </div>
                          <small for="" class="text-danger">Anda dapat merubah lokasi dengan menekan tombol "Aktifkan" atau mengarahkan marker google maps anda. </small>
		                </div>		               
		                <button type="submit" class="btn btn-primary">Edit</button>
                		<a href="<?=moduleUrl('admin/ruangan');?>" class="btn btn-default">Batal</a>
             		 </form>
				</div>
			</div>
		</div>
        <div class="col-md-6">
            <div id="map"></div>
        </div>
	</div>
</section>
<!-- /.content -->
<!-- /.content -->
<?php bufferStart();?>
<script>
    function changeLatLngInput(latLng) {
        $("#latitude").val(typeof latLng.lat == 'function' ? latLng.lat() : latLng.lat);
        $("#longitude").val(typeof latLng.lng == 'function' ? latLng.lng() : latLng.lng);
    }
    var map;
    var marker;
    var latitudeDb = parseFloat(<?=$ruangan['latitude'];?>);
    if (isNaN(latitudeDb)) {
    	latitudeDb = -7.3501714;
    }
    var longitudeDb = parseFloat(<?=$ruangan['longitude'];?>);
    if (isNaN(longitudeDb)) {
    	longitudeDb = 108.2227528;
    }
    var centerPoint = {lat: latitudeDb,lng: longitudeDb};

    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: centerPoint,
            zoom: 19
        });
        marker = new google.maps.Marker({
            position: centerPoint,
            map: map,
            draggable:true,
            title: 'Center Position'
        });
        map.addListener('click',function(event) {
            marker.setPosition( event.latLng );
            map.panTo(event.latLng)
            changeLatLngInput(event.latLng);
        });
        changeLatLngInput(centerPoint);
    }
    function aktifkanLokasi(event, el) {
        event.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var locationLocal = position.coords;
                var location = new google.maps.LatLng( locationLocal.latitude, locationLocal.longitude );
                marker.setPosition( location );
                map.panTo(location)
                changeLatLngInput(location);
            }, function (error) {
                alert("Pengaksesan lokasi tidak diizinkan. Anda tidak bisa melakukan absensi.");
            });
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?=getenv('API_KEY');?>&callback=initMap"
        async defer></script>
<?php bufferEnd('scripts');?>
                		