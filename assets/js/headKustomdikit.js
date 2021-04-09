var myMarker;

function initAutocomplete() {
    const map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(-6.298790, 107.298793),
        zoom: 12,
        streetViewControl: false,
        controlSize: 25,
        zoomControlOptions: {
            position: google.maps.ControlPosition.RIGHT_BOTTOM,
        },
        mapTypeControlOptions: {
            position: google.maps.ControlPosition.LEFT_BOTTOM,
            mapTypeIds: ["roadmap", 'satellite'],
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude,
                };
                if (myMarker) {
                    myMarker.setPosition(pos);
                } else {
                    myMarker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        draggable: true,
                    });
                }
                document.getElementById("latitude").value = pos['lat'];
                document.getElementById("longitude").value = pos['lng'];
                map.setCenter(pos);

                myMarker.addListener('dragend', function(event) {
                    document.getElementById("latitude").value = event.latLng.lat();
                    document.getElementById("longitude").value = event.latLng.lng();
                });
            },
        );
    }

    google.maps.event.addListener(map, 'click', function(event) {
        if (myMarker) {
            myMarker.setPosition(event.latLng);
        } else {
            myMarker = new google.maps.Marker({
                position: event.latLng,
                map: map,
                draggable: true,
            });
        }

        document.getElementById("latitude").value = event.latLng.lat();
        document.getElementById("longitude").value = event.latLng.lng();

        myMarker.addListener('dragend', function(event) {
            document.getElementById("latitude").value = event.latLng.lat();
            document.getElementById("longitude").value = event.latLng.lng();
        });
    });

    const input = document.getElementById("pac-input");
    const searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    map.addListener("bounds_changed", () => {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];
    searchBox.addListener("places_changed", () => {
        const places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        markers.forEach((marker) => {
            marker.setMap(null);
        });
        markers = [];

        const bounds = new google.maps.LatLngBounds();
        places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) {
                console.log("Returned place contains no geometry");
                return;
            }

            if (myMarker) {
                myMarker.setPosition(place.geometry.location);
            } else {
                myMarker = new google.maps.Marker({
                    position: place.geometry.location,
                    map: map,
                    draggable: true,
                });
            }

            document.getElementById("latitude").value = place.geometry.location.lat();
            document.getElementById("longitude").value = place.geometry.location.lng();

            if (place.geometry.viewport) {
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }
        });
        map.fitBounds(bounds);
    });
}