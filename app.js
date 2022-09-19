function toggleCountryCapitalMap(countryID, longitude, latitude){
    let countryContainer = document.getElementById("country_" + countryID + "_container");
    if (!countryContainer.classList.contains("open")) {
        let mapContainer = document.createElement("div");
        countryContainer.appendChild(mapContainer);
        mapContainer.setAttribute("id", "country_" + countryID + "_map_container");
        map = new OpenLayers.Map("country_" + countryID + "_map_container");
        map.addLayer(new OpenLayers.Layer.OSM());

        var lonLat = new OpenLayers.LonLat(longitude, latitude).transform(
            new OpenLayers.Projection("EPSG:4326"),
            map.getProjectionObject()
        );
        var zoom=5;
        var markers = new OpenLayers.Layer.Markers( "Markers" );
        map.addLayer(markers);
        markers.addMarker(new OpenLayers.Marker(lonLat));
        map.setCenter (lonLat, zoom);

        countryContainer.classList.add("open")
        countryContainer.classList.remove("closed")
    }
    else {
        document.getElementById("country_" + countryID + "_map_container").remove();
        countryContainer.classList.remove("open")
        countryContainer.classList.add("closed")
    }
}