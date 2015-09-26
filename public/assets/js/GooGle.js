function GoogleMaps () {
    this.markers = [];
    myLatLng = new google.maps.LatLng( 42.657854, 23.314953 ),
        myOptions = {
            zoom: 16,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

    this.map = new google.maps.Map( document.getElementById( 'map-canvas' ), myOptions );
}

GoogleMaps.prototype.addMarker = function(lat, lon) {
    var latLon = new google.maps.LatLng( lat, lon );
    var marker = new google.maps.Marker({
        position: latLon,
        icon: markers[i].icon,
        title: markers[i].title,
        map: this.map
    });

    this.map.setCenter(latLon);
}