"use strict";
var $ = jQuery.noConflict();

var mapStyles = [ {"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"on"},{"lightness":10}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.local","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":50}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]}, {featureType:'road.highway',elementType:'all',stylers:[{hue:'#dddbd7'},{saturation:-92},{lightness:60},{visibility:'on'}]}, {featureType:'landscape.natural',elementType:'all',stylers:[{hue:'#c8c6c3'},{saturation:-71},{lightness:-18},{visibility:'on'}]},  {featureType:'poi',elementType:'all',stylers:[{hue:'#d9d5cd'},{saturation:-70},{lightness:20},{visibility:'on'}]} ];

// Set map height to 100% ----------------------------------------------------------------------------------------------

var $body = $('body');
if( $body.hasClass('map-fullscreen') ) {
    if( $(window).width() > 768 ) {
        $('.map-canvas').height( $(window).height() - $('.header').height() );
    }
    else {
        $('.map-canvas #map').height( $(window).height() - $('.header').height() );
    }
}


function gMap(_latitude, _longitude, json){
	
    var mapCenter = new google.maps.LatLng(_latitude, _longitude);
    var mapOptions = {
        zoom: 14,
        center: mapCenter,
        disableDefaultUI: false,
        scrollwheel: false,
        styles: mapStyles,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        panControl: false,
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.RIGHT_TOP
        }
    };
    
    var mapElement = document.getElementById('map');
    var map = new google.maps.Map(mapElement, mapOptions);
    var newMarkers = [];
    var markerClicked = 0;
    var activeMarker = false;
    var lastClicked = false;
    
    
    //GOOGLE PLACES
    var google_place_icons = [
	    '/assets/img/google-places/bar.png',
	    '/assets/img/google-places/cafe.png',
	    '/assets/img/google-places/car_rental.png',
	    '/assets/img/google-places/store.png',
	    '/assets/img/google-places/restaurant.png',
    ];
    
    var google_place_types = ['bar', 'cafe', 'car_rental', 'store', 'restaurant'];
    
    var request = {
    	location: new google.maps.LatLng(_latitude, _longitude),
    	radius: '5000',
    	types: google_place_types
    };

    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(request, renderResults);
    	 
    function renderResults(results, status) {
	  if (status == google.maps.places.PlacesServiceStatus.OK) {
	    for (var i = 0; i < results.length; i++) {
	      var place = results[i];
	      var types = place.types;
	      var key = 0;
	      var arr = $.inArray(types[0], google_place_types);
	      if ( arr != -1 ){
	    	  key = arr;
	      } else{
	    	  arr = $.inArray(types[1], google_place_types);
	    	  if ( arr != -1 ){
	    		  key = arr;
	    	  } else{
	    		  key = 0;
	    	  }
	      }
	     /*for(var i = 0; i < types.length; i++){
	    	  var arr = $.inArray(types[i], google_place_types);
	    	  if ( arr != -1 ){
	    		  key = arr;
	    		  break;
	    	  }
	      }*/
	      
	      //console.log(place.name);
	      var content = '<img class="google-place" src="'+google_place_icons[key]+'" />';
	      var marker_place = new RichMarker({
		      map: map,
		      draggable: false,
		      content: content,
		      flat: true,
		      position: place.geometry.location
		  });
	      
	      var boxText = document.createElement("div");
	      boxText.style.cssText = "background: #F0E68C; padding: 5px; font-weight:bold;";
	      boxText.innerHTML = place.name + '<br/>' + place.vicinity;
	        
	      var myOptions = {
			 content: boxText
			,disableAutoPan: false
			,maxWidth: 0
			,pixelOffset: new google.maps.Size(-140, 0)
			,zIndex: null
			,boxStyle: { 
			  opacity: 0.75,width: "200px"
			 }
			,closeBoxMargin: "10px 2px 2px 2px"
			,closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif"
			,infoBoxClearance: new google.maps.Size(1, 1)
			,isHidden: false
			,pane: "floatPane"
			,enableEventPropagation: false
		};
	      
	      var ib = new InfoBox(myOptions);
	      google.maps.event.addListener(marker_place, 'click', function() {
	    	    ib.open(map, this);
		        map.panTo(new google.maps.LatLng(_latitude, _longitude));
		    });
	    }
	  }
	  
	}
    //<-GOOGLE PLACES
    

    for (var i = 0; i < json.data.length; i++) {

        var markerContent = document.createElement('DIV');
        markerContent.innerHTML =
            '<div class="map-marker ">' +
                '<div class="icon">' +
                '<img src="' + json.data[i].type_icon + '">' +
                '</div>' +
            '</div>';

        var marker = new RichMarker({
            position: new google.maps.LatLng(json.data[i].latitude, json.data[i].longitude),
            map: map,
            draggable: false,
            content: markerContent,
            flat: true
        });

        newMarkers.push(marker);

        // Create infobox for marker -----------------------------------------------------------------------------------

        var infoboxContent = document.createElement("div");
        var infoboxOptions = {
            content: infoboxContent,
            disableAutoPan: false,
            pixelOffset: new google.maps.Size(-18, -42),
            zIndex: null,
            alignBottom: true,
            boxClass: "infobox",
            enableEventPropagation: true,
            closeBoxMargin: "0px 0px -30px 0px",
            closeBoxURL: "assets/img/close.png",
            infoBoxClearance: new google.maps.Size(1, 1)
        };

        // Infobox HTML element ----------------------------------------------------------------------------------------

        var category = json.data[i].category;
        infoboxContent.innerHTML = drawInfobox(category, infoboxContent, json, i);

        // Create new markers ------------------------------------------------------------------------------------------

        newMarkers[i].infobox = new InfoBox(infoboxOptions);

        // Show infobox after click ------------------------------------------------------------------------------------

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                google.maps.event.addListener(map, 'click', function(event) {
                    lastClicked = newMarkers[i];
                });
                activeMarker = newMarkers[i];
                if( activeMarker != lastClicked ){
                    for (var h = 0; h < newMarkers.length; h++) {
                        newMarkers[h].content.className = 'marker-loaded';
                        newMarkers[h].infobox.close();
                    }
                    newMarkers[i].infobox.open(map, this);
                    newMarkers[i].infobox.setOptions({ boxClass:'fade-in-marker'});
                    newMarkers[i].content.className = 'marker-active marker-loaded';
                    markerClicked = 1;
                }
            }
        })(marker, i));

        // Fade infobox after close is clicked -------------------------------------------------------------------------

        google.maps.event.addListener(newMarkers[i].infobox, 'closeclick', (function(marker, i) {
            return function() {
                activeMarker = 0;
                newMarkers[i].content.className = 'marker-loaded';
                newMarkers[i].infobox.setOptions({ boxClass:'fade-out-marker' });
            }
        })(marker, i));
    }

    
    // Close infobox after click on map --------------------------------------------------------------------------------

    google.maps.event.addListener(map, 'click', function(event) {
        if( activeMarker != false && lastClicked != false ){
            if( markerClicked == 1 ){
                activeMarker.infobox.open(map);
                activeMarker.infobox.setOptions({ boxClass:'fade-in-marker'});
                activeMarker.content.className = 'marker-active marker-loaded';
            }
            else {
                markerClicked = 0;
                activeMarker.infobox.setOptions({ boxClass:'fade-out-marker' });
                activeMarker.content.className = 'marker-loaded';
                setTimeout(function() {
                    activeMarker.infobox.close();
                }, 350);
            }
            markerClicked = 0;
        }
        if( activeMarker != false ){
            google.maps.event.addListener(activeMarker, 'click', function(event) {
                markerClicked = 1;
            });
        }
        markerClicked = 0;
    });

    // Create marker clusterer -----------------------------------------------------------------------------------------

    var clusterStyles = [
        {
            url: 'assets/img/cluster.png',
            height: 34,
            width: 34
        }
    ];
    
    var markerCluster = new MarkerClusterer(map, newMarkers, { styles: clusterStyles, maxZoom: 19 });
    markerCluster.onClick = function(clickedClusterIcon, sameLatitude, sameLongitude) {
        return multiChoice(sameLatitude, sameLongitude, json);
    };

    // Dynamic loading markers and data from JSON ----------------------------------------------------------------------

    google.maps.event.addListener(map, 'idle', function() {
        var visibleArray = [];
        for (var i = 0; i < json.data.length; i++) {
            if ( map.getBounds().contains(newMarkers[i].getPosition()) ){
                visibleArray.push(newMarkers[i]);
                $.each( visibleArray, function (i) {
                    setTimeout(function(){
                        if ( map.getBounds().contains(visibleArray[i].getPosition()) ){
                            if( !visibleArray[i].content.className ){
                                visibleArray[i].setMap(map);
                                visibleArray[i].content.className += 'bounce-animation marker-loaded';
                                markerCluster.repaint();
                            }
                        }
                    }, i * 50);
                });
            } else {
                newMarkers[i].content.className = '';
                newMarkers[i].setMap(null);
            }
        }

        var visibleItemsArray = [];
        $.each(json.data, function(a) {
            if( map.getBounds().contains( new google.maps.LatLng( json.data[a].latitude, json.data[a].longitude ) ) ) {
                var category = json.data[a].category;
                pushItemsToArray(json, a, category, visibleItemsArray);
            }
        });

        // Create list of items in Results sidebar ---------------------------------------------------------------------

        $('ul.results').html(visibleItemsArray);


        // Check if images are cached, so will not be loaded again
        $.each(json.data, function(a) {
            if( map.getBounds().contains( new google.maps.LatLng( json.data[a].latitude, json.data[a].longitude ) ) ) {
                is_cached(json.data[a].gallery[0], a);
            }
        });

        // Call Rating function ----------------------------------------------------------------------------------------

        rating('.results .item');

        var $singleItem = $('.results .item');
        $singleItem.hover(
            function(){
            	var id = parseInt($(this).attr('id')) - 1;
            	//console.log(id);
                newMarkers[id].content.className = 'marker-active marker-loaded';
            },
            function() {
            	var id = parseInt($(this).attr('id')) - 1;
                newMarkers[id].content.className = 'marker-loaded';
            }
        );
        
    });

    redrawMap('google', map);

    function is_cached(src, a) {
        var image = new Image();
        var loadedImage = $('.results li #' + json.data[a].id + ' .image');
        image.src = src;
        if( image.complete ){
            $(".results").each(function() {
                loadedImage.removeClass('loading');
                loadedImage.addClass('loaded');
            });
        }
        else {
            $(".results").each(function() {
                $('.results li #' + json.data[a].id + ' .image').addClass('loading');
            });
            $(image).load(function(){
                loadedImage.removeClass('loading');
                loadedImage.addClass('loaded');
            });
        }
    }
     

}


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Item Detail Map - Google
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function itemDetailMap(json){
	var mapCenter = new google.maps.LatLng(json.latitude, json.longitude);
    var mapOptions = {
        zoom: 14,
        center: mapCenter,
        disableDefaultUI: true,
        scrollwheel: false,
        styles: mapStyles,
        panControl: false,
        zoomControl: false,
        draggable: true
    };
    var mapElement = document.getElementById('map-detail');
    var map = new google.maps.Map(mapElement, mapOptions);
    
    var icon = '';
    if( json.type_icon ){
    	icon = '<img src="' + json.type_icon + '">';
    }

    var markerContent = document.createElement('DIV');
    markerContent.innerHTML = '<div class="map-marker"><div class="icon">' + icon + '</div></div>';

    var marker = new RichMarker({
        position: new google.maps.LatLng(json.latitude, json.longitude),
        map: map,
        draggable: false,
        content: markerContent,
        flat: true
    });

    marker.content.className = 'marker-loaded';
}


//Simple Map (for new item screen)
function simpleMap(_latitude, _longitude){
    var mapCenter = new google.maps.LatLng(_latitude, _longitude);
    var mapOptions = {
        zoom: 14,
        center: mapCenter,
        disableDefaultUI: true,
        //scrollwheel: false,
        styles: mapStyles,
        panControl: false,
        zoomControl: false,
        draggable: true
    };
    var mapElement = document.getElementById('map-simple');
    var map = new google.maps.Map(mapElement, mapOptions);

    var markerContent = document.createElement('DIV');
    markerContent.innerHTML = '<div class="map-marker"><div class="icon"></div></div>';

    var marker = new RichMarker({
        position: new google.maps.LatLng( _latitude, _longitude),
        map: map,
        draggable: true,
        content: markerContent,
        flat: true
    });

    marker.content.className = 'marker-loaded';
}


function pushItemsToArray(json, a, category, visibleItemsArray){
    visibleItemsArray.push(
        '<li data-price="'+json.data[a].price+'" data-rating="'+json.data[a].rating+'">' +
            '<div class="item" id="'+json.data[a].id+'">' +
                '<a href="'+json.data[a].url+'" class="image">' +
                    '<div class="inner">' +
                        '<div class="item-specific">' +
                            drawItemSpecific(category, json, a) +
                        '</div>' +
                        '<img src="'+json.data[a].gallery[0]+'" alt="">' +
                    '</div>' +
                '</a>' +
                '<div class="wrapper">' +
                    '<a href="'+json.data[a].url+'" id="'+json.data[a].id +'"><h3>'+json.data[a].title+'</h3></a>' +
                    '<figure>'+json.data[a].location+'</figure>' +
                    drawPrice(json.data[a].price) +
                    '<div class="info">' +
                        '<div class="type">' +
                            '<i><img src="'+json.data[a].type_icon+'" alt=""></i>' +
                            '<span>'+json.data[a].type+'</span>' +
                        '</div>' +
                        '<div class="rating" data-rating="'+json.data[a].rating+'"></div>' +
                       drawDistance(json.data[a].distance) +
                    '</div>' +
                '</div>' +
            '</div>' +
        '</li>'
    );
    
    
    function drawDistance(distance){
    	if ( distance != '' ){
    		return '<div class="distance">'+distance+' meters</div>';
    	}
    	return '';
    }

    function drawPrice(price){
        if( price ){
        	return '<div class="price">'+price+' &euro;</div>';
        }
        return '';
    }
}

// Center map to marker position if function is called (disabled) ------------------------------------------------------

function centerMapToMarker(){
    $.each(json.data, function(a) {
        if( json.data[a].id == id ){
            var _latitude = json.data[a].latitude;
            var _longitude = json.data[a].longitude;
            var mapCenter = new google.maps.LatLng(_latitude,_longitude);
            map.setCenter(mapCenter);
        }
    });
}


function multiChoice(sameLatitude, sameLongitude, json) {
    var multipleItems = [];
    $.each(json.data, function(a) {
        if( json.data[a].latitude == sameLatitude && json.data[a].longitude == sameLongitude ) {
            pushItemsToArray(json, a, json.data[a].category, multipleItems);
        }
    });
}


// Redraw map after item list is closed --------------------------------------------------------------------------------

function redrawMap(mapProvider, map){
    $('.map .toggle-navigation').click(function() {
        $('.map-canvas').toggleClass('results-collapsed');
        $('.map-canvas .map').one("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
            if( mapProvider == 'osm' ){
                map.invalidateSize();
            }
            else if( mapProvider == 'google' ){
                google.maps.event.trigger(map, 'resize');
            }
        });
    });
}