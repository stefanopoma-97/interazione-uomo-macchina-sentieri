/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function mappa (id_map, id_elevation, link, detached ){
    //window.confirm("mappa");
    var elevation_options = {

    // Default chart colors: theme lime-theme, magenta-theme, ...
    theme: "lightblue-theme",

    // Chart container outside/inside map container
    detached: detached,

    // if (detached), the elevation chart container
    elevationDiv: "#"+id_elevation,

    // if (!detached) autohide chart profile on chart mouseleave
    autohide: false, 

    // if (!detached) initial state of chart profile control
    collapsed: false, //era false

    // if (!detached) control position on one of map corners
    position: "topright",

    // Autoupdate map center on chart mouseover.
    followMarker: true,

    // Chart distance/elevation units.
    imperial: false,

    // [Lat, Long] vs [Long, Lat] points. (leaflet default: [Lat, Long])
    reverseCoords: false,

    // Slope chart profile: true || "summary" || false
    slope: false,

    // Summary track info style: "line" || "multiline" || false
    summary: 'multiline',

    // Toggle chart ruler filter.
    ruler: true,

    // Toggle chart legend filter.
    legend: true

  };
  
  var bounds = [
  [-250, -500],
  [800, 800]
];

  // Instantiate map (leaflet-ui).
  var map = new L.Map(id_map, { mapTypeId: 'terrain', center: [33.960057, -6.916462], zoom: 5 });

  // Instantiate elevation control.
  var controlElevation = L.control.elevation(elevation_options).addTo(map);

  // Load track from url (allowed data types: "*.geojson", "*.gpx")
  controlElevation.load(link);


}