<script type="text/javascript">
// MAP STUFF
var map;
var icon_home = "<?= the_field('map_icon','option'); ?>";
var marker = [];
var infowindow = new google.maps.InfoWindow();
var markers = [];
var infowindows = [];
commLat = <?php echo get_field('latitude') . ';' ?>
commLng = <?php echo get_field('longitude') . ';' ?>
centerLat = <?php echo get_field('latitude') . ';' ?>
centerLng = <?php echo get_field('longitude') . ';' ?>
$(window).on('load', function() {
  options = {
    center: new google.maps.LatLng(commLat,commLng),
    mapTypeControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    navigationControl: false,
    navigationControlOptions: {
      style: google.maps.NavigationControlStyle.NORMAL
    },
    zoomControl: false,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.HORIZONTAL_BAR,
      position: google.maps.ControlPosition.LEFT_CENTER
    },
    scrollwheel: false,
    streetViewControl: false,
    zoom: <?php echo get_field('mapzoom'); ?>,
    panControl: false,
    styles: [
      {
        stylers: [
          { hue: "<?php the_field('land_area_color_overlay','option'); ?>" }, // Overlays color onto land area
          { lightness: 0 },
          { saturation: -90 }
        ]
      },
      {
        featureType: "road.highway",  /// Fwys/Hwys
        elementType: "geometry",
        stylers: [
          { color: "<?php the_field('freewayhighway_color','option'); ?>" },
          { lightness: 0 },
          { saturation: 0 },
          { visibility: "simplified" }
        ]
      },{
        featureType: "road.arterial", /// Main Big Roads
        elementType: "geometry",
        stylers: [
          { color: "<?php the_field('main_big_road_color','option'); ?>" },
          { lightness: 0 },
          { saturation: 0 },
          { visibility: "simplified" }
        ]
      },{
        featureType: "road.local", /// Small roads
        elementType: "geometry",
        stylers: [
          { color: "<?php the_field('small_road_color','option'); ?>" },
          { lightness: 0 },
          { saturation: 0 },
          { visibility: "simplified" }
        ]
      },
      {
        featureType: "water", /// Self Explanatory
        elementType: "geometry",
        stylers: [
          { color: "<?php the_field('water_color','option'); ?>" },
          { lightness: 0 },
          { saturation: 0 },
          { visibility: "simplified" }
        ]
      }
    ]
  };
  map = new google.maps.Map(document.getElementById('map_canvas'), options);
  //////// ADD custom buttons for the zoom-in/zoom-out on the map
  function CustomZoomControl(controlDiv, map) {
    //grap the zoom elements from the DOM and insert them in the map
    controlUIzoomIn = document.getElementById('cd-zoom-in'),
    controlUIzoomOut = document.getElementById('cd-zoom-out');
    // Setup the click event listeners and zoom-in or out according to the clicked element
    google.maps.event.addDomListener(controlUIzoomIn, 'click', function() {
      map.setZoom(map.getZoom()+1)
    });
    google.maps.event.addDomListener(controlUIzoomOut, 'click', function() {
      map.setZoom(map.getZoom()-1)
    });
  }
  var zoomControlDiv = document.createElement('div');
  var zoomControl = new CustomZoomControl(zoomControlDiv, map);
  //insert the zoom div on the top left of the map
  map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);
  var latLng = new google.maps.LatLng(commLat, commLng);
  function setMarkers(map) {

    var image = {
      url: icon_home,
      scaledSize: new google.maps.Size(60, 60),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(30, 30)
    };

    var marker = new google.maps.Marker({
      map: map,
      icon: image,
      title: '<?php the_title(); ?>',
      position: latLng,
      zIndex: 1,
      animation: google.maps.Animation.DROP
    });
  }

  setMarkers(map);

});
$(document).ready(function() {
  $(".map-views").on('click', function(){
    $('.map-views2').show();
    $(this).hide();
    map.setMapTypeId(google.maps.MapTypeId.HYBRID);
  });
  $(".map-views2").on('click', function(){
    $('.map-views').show();
    $(this).hide();
    map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
  });
});

</script>
