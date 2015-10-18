function drawPaths(map_id){
	
  var path = $('#'+map_id).data('path');
  path = path.split('|');
  var latlngPoints = [];
  
  for(var i = 0; i < path.length; i++){
	  var l = path[i].split(','); 
	  latlngPoints.push({lat: parseFloat(l[0]), lng:parseFloat(l[1]) });
  }
  
  var mapCenter = latlngPoints[0];
  var mapOptions = {
      zoom: 14,
      center: mapCenter,
      styles: mapStyles,
      disableDefaultUI: false,
      scrollwheel: false,
      mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
          position: google.maps.ControlPosition.BOTTOM_CENTER
      },
  };
  
  var mapElement = document.getElementById(map_id);  
  var map = new google.maps.Map(mapElement, mapOptions);
  
  var trail = new google.maps.Polyline({
	   path: latlngPoints,
	   geodesic: true,
	   strokeColor: '#663399',
	   strokeOpacity: 1.0,
	   strokeWeight: 3,
	   travelMode: google.maps.TravelMode.DRIVING,
  });

  trail.setMap(map);
  
  for(var i = 0; i < latlngPoints.length; i++){
	  var cnt = 1;
	  if ( i % 2 == 0 ){ cnt = 2; }
	  var content = '<img class="marker-flag" src="/assets/img/marker-flag-'+cnt+'.png">';
	  var marker = new RichMarker({
	      position: new google.maps.LatLng(latlngPoints[i].lat, latlngPoints[i].lng),
	      map: map,
	      draggable: false,
	      content: content,
	      flat: true
	  });
  }
  
}