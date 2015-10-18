var $ = jQuery.noConflict();


$(document).ready(function($){
    "use strict";
    
    rating();
    autoComplete();
    adaptBackgroundHeight();
    
    
    //$('#location').val('ΠΑΤΜΟΣ');
    $('#action').val('');
    

    var URL = window.location.href;
    var latitude, longitude;
    
    if ( URL.indexOf('search') != -1 || URL.indexOf('place') != -1 ){
    	latitude = parseFloat($('#lat').val());
    	longitude = parseFloat($('#lon').val());
    }

    if ( URL.indexOf('search') != -1 && URL.indexOf('experience') == -1 ){
    	var json = $.parseJSON($.trim($('#json-search-results').html()));
    	if ( json.data.length > 0 ){
    		latitude = json.data[0].latitude;
        	longitude = json.data[0].longitude;
    	}
    	gMap(latitude, longitude, json);
    } else if ( URL.indexOf('place') != -1 ){
    	var json = $.parseJSON($.trim($('#json-item').html()));
    	itemDetailMap(json);
    	initializeOwl(false);
    } else if ( URL.indexOf('newBusiness') != -1 ){
    	simpleMap(37.9736327, 23.7580017);
    	showCategoryTags();
    } else if ( URL.indexOf('pathMaps') != -1 ){
    	drawPaths('map-path');
    } else if ( URL.indexOf('businesses') != -1 ){
    	
    } 
    
    
    $(this).on('click', 'span.category-tag', function(){
    	var $elem = $(this).find('i.fa-check-square');
    	var parent = $(this).data('parent');
    	if ( $elem.hasClass('tag-inactive') ){
    		$elem.removeClass('tag-inactive').addClass('tag-active');
    		$('span.sub-category-tag[data-parent='+parent+']').removeClass('sub-cat-inactive').addClass('sub-cat-active');
    	} else{
    		$elem.removeClass('tag-active').addClass('tag-inactive');
    		$('span.sub-category-tag[data-parent='+parent+']').removeClass('sub-cat-active').addClass('sub-cat-inactive');
    	}
    	var subCatActives = $('span.sub-category-tag.sub-cat-active').length;
    	if ( subCatActives > 0 ){
    		$('div.sub-category-tag-wrap').show();
    	} else{
    		$('div.sub-category-tag-wrap').hide();
    	}
    });
    
    
    $(this).on('click', 'span.sub-category-tag', function(){
    	var $elem = $(this).find('i.fa-check-square');
    	if ( $elem.hasClass('tag-inactive') ){
    		$elem.removeClass('tag-inactive').addClass('tag-active');
    	}  else{
    		$elem.removeClass('tag-active').addClass('tag-inactive');
    	}
    });
    
    
    function showCategoryTags(){
    	var tags = [];
    	$('div.main-category-tag-wrap span.category-tag').each(function(){ tags.push($(this)); });
    	tags.sort( function(){ return ( Math.round( Math.random() ) - 0.5 ) } );
    	$(tags).each(function(k, v){
    		var delay = 500 * k;
    		v.delay(delay).animate({opacity:1}, 500);
    	});
    }
    

    //USER GEOLOCATION
    $('i.geolocation').on("click", function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setLocation);
        } else {
            console.log('GeoLocation is not supported');
        }
    });
    

    // Autocomplete address ------------------------------------------------------------------------------------------------
    function autoComplete(){
	 	if ( $('#location').length ){
	 	    var input = document.getElementById('location') ;
	 	    var autocomplete = new google.maps.places.Autocomplete(input, { types: ["geocode"] });
	 	    google.maps.event.addListener(autocomplete, 'place_changed', function(){
	 	        var place = autocomplete.getPlace();
	 	        if ( !place.geometry ) {
	 	            return;
	 	        }
	 	        if ( place ) {
	 	            
	 	            var lat = place.geometry.location.lat(),
	 	            lng = place.geometry.location.lng();

	 	            console.log(lat, lng);
	 	            $('#lat').val(lat);
	 	            $('#lon').val(lng);
	 	        }
	 	    });
	 	}
	 }
    //<-USER GEOLOCATION
    
    
    //BOOTSTRAP TOOLTIP
    $('[data-toggle="tooltip"]').tooltip();
    
    $('.off-canvas-navigation header').css('line-height', $('.header').height() + 'px');
    
    //ACTION IMAGE HOVER EFFECT
    $(this).on('mouseenter', 'img.action-img', function(){
    	$(this).stop().animate({opacity:1}, 500);
    	var data = $(this).data('literal');
    	$('div.action-literal[data-literal='+data+']').stop().animate({opacity:1, top:0}, 500);
    }).on('mouseleave', 'img.action-img', function(){
    	$(this).stop().animate({opacity:0.6}, 500);
    	$('div.action-literal').stop().animate({opacity:0, top:20}, 500);
    });
    //<-ACTION IMAGE HOVER EFFECT
    
    
    //SUBMIT FORM ON CLICK ACTION
    $(this).on('click', 'img.action-img', function(){
    	$('#action').val($(this).data('literal'));
    	$('form.main-search').submit();
    });
    //<-SUBMIT FORM ON CLICK ACTION
    
    
    if( $('body').hasClass('navigation-fixed') ){
        $('.off-canvas-navigation').css( 'top', - $('.header').height() );
        $('#page-canvas').css( 'margin-top',$('.header').height() );
    }


    $(this).on('click', 'div.quick-view', function(){
    	var name = $(this).closest('div.item').find('.item-name').html();
        var address = $(this).closest('div.item').find('.item-address').html();
        var description = $(this).closest('div.item').find('.item-description').html();
        var main_category = $(this).closest('div.item').find('.item-main-category').html();
        $('div.modal-quick-view .item-name').html(name);
        $('div.modal-quick-view .item-address').html(address);
        $('div.modal-quick-view .item-description').html(description);
        $('div.modal-quick-view .item-main-category').html(main_category);
        $('div.modal-quick-view').fadeIn('normal');
    });
    
    
    $(this).on('click', 'div.modal-close', function(){
    	$('div.modal-quick-view').hide();
    });
    
    
    //FILTER -> SORT RESULTS
    $(this).on('click', 'span.search-filter', function(){
    	var $results = $('ul.results'),
    	$li = $results.children('li'),
    	sortCoumn = $(this).attr('name');
    	if ( $('div.search-filters-container').attr('name') != sortCoumn ){
	    	$('span.search-filter-active').removeClass('search-filter-active');
	    	$(this).addClass('search-filter-active');
	    	$('div.search-filters-container').attr('name', sortCoumn);
	    	$li.sort(function(a,b){
		    	var an = parseFloat(a.getAttribute('data-'+sortCoumn)),
		    		bn = parseFloat(b.getAttribute('data-'+sortCoumn));
		    	if ( sortCoumn == 'distance' || sortCoumn == 'price' ){
			    	if(an > bn) {
			    		return 1;
			    	}
			    	if(an < bn) {
			    		return -1;
			    	}
		    	} else{
		    		if(an > bn) {
			    		return -1;
			    	}
			    	if(an < bn) {
			    		return 1;
			    	}
		    	}
		    	return 0;
		    });
	    	$li.detach().appendTo($results);
    	}
    });
    //<-FILTER -> SORT RESULTS
    

    //CUSTOM SCROLLBAR ON SEARCH RESULTS
    if( $('div.items-list').length > 0 ){
        $('div.items-list').mCustomScrollbar({
            mouseWheel:{ scrollAmount: 350 }
        });
    }
    //<-CUSTOM SCROLLBAR ON SEARCH RESULTS

    
    //BOOTSTRAP SELECT WIDGET
    var select = $('select');
    if ( select.length > 0 ){
        select.selectpicker();
    }
    var bootstrapSelect = $('.bootstrap-select');
    var dropDownMenu = $('.dropdown-menu');
    bootstrapSelect.on('shown.bs.dropdown', function () {
        dropDownMenu.removeClass('animation-fade-out');
        dropDownMenu.addClass('animation-fade-in');
    });
    bootstrapSelect.on('hide.bs.dropdown', function () {
        dropDownMenu.removeClass('animation-fade-in');
        dropDownMenu.addClass('animation-fade-out');
    });
    bootstrapSelect.on('hidden.bs.dropdown', function () {
        var _this = $(this);
        $(_this).addClass('open');
        setTimeout(function() {
            $(_this).removeClass('open');
        }, 100);
    });
    //<-BOOTSTRAP SELECT WIDGET

    
//  Expand content on click --------------------------------------------------------------------------------------------

    $('.expand-content').on('click',  function(e){
        e.preventDefault();
        var children = $(this).attr('data-expand');
        var parentHeight = $(this).closest('.expandable-content').height();
        var contentSize = $( children + ' .content' ).height();
        $( children ).toggleClass('collapsed');
        $( this ).toggleClass('active');
        $( children ).css( 'height' , contentSize );
        if( !$( children).hasClass('collapsed') ){
            setTimeout(function() {
                $( children ).css('overflow', 'visible');
            }, 400);
        }
        else {
            $( children ).css('overflow', 'hidden');
        }
        $('.has-child').on('click',  function(e){
            var parent = $(this).closest('.expandable-content');
            var childHeight = $( $(this).attr('data-expand') + ' .content').height();
            if( $(this).hasClass('active') ){
                $(parent).height( parent.height() + childHeight )
            }
            else {
                $(parent).height(parentHeight);
            }
        });
    });


//  Smooth Navigation Scrolling ----------------------------------------------------------------------------------------

    $('.navigation .nav a[href^="#"], a[href^="#"].roll').on('click',function (e) {
        e.preventDefault();
        var target = this.hash, $target = $(target);
        if ($(window).width() > 768){
            $('html, body').stop().animate({'scrollTop': $target.offset().top - $('.navigation').height() }, 2000);
        } else {
            $('html, body').stop().animate({'scrollTop': $target.offset().top}, 2000);
        }
        return false;
    });

//  iCheck -------------------------------------------------------------------------------------------------------------

    if ($('.checkbox').length > 0) {
        $('input').iCheck();
    }

    if ($('.radio').length > 0) {
        $('input').iCheck();
    }

    $('body').addClass('page-fade-in');

    $('a').on('click', function (e) {
        var attr = $(this).attr('href');
        if ( attr.indexOf('#') != 0 ) {
            e.preventDefault();
            var goTo = this.getAttribute("href");
            $('body').removeClass('page-fade-in');
            $('body').addClass('page-fade-out');
            setTimeout(function(){
                window.location = goTo;
            },200);
        }
        else if ( $(this).attr('href') == '#' ) {
            e.preventDefault();
        }
    });

//  Items scripts ------------------------------------------------------------------------------------------------------

    $('.item.admin-view .hide-item').on('click',function (e) {
        $(this).closest('.item').toggleClass('is-hidden');
    });

//  No UI Slider -------------------------------------------------------------------------------------------------------

    if( $('.ui-slider').length > 0 ){
        $('.ui-slider').each(function(){
            var step;
            if( $(this).attr('data-step') ) {
                step = parseInt( $(this).attr('data-step') );
            }
            else {
                step = 10;
            }
            var sliderElement = $(this).attr('id');
            var element = $( '#' + sliderElement);
            var valueMin = parseInt( $(this).attr('data-value-min') );
            var valueMax = parseInt( $(this).attr('data-value-max') );
            $(this).noUiSlider({
                start: [ valueMin, valueMax ],
                connect: true,
                range: {
                    'min': valueMin,
                    'max': valueMax
                },
                step: step
            });
            if( $(this).attr('data-value-type') == 'price' ) {
                if( $(this).attr('data-currency-placement') == 'before' ) {
                    $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ prefix: $(this).attr('data-currency'), decimals: 0, thousand: '.' }));
                    $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ prefix: $(this).attr('data-currency'), decimals: 0, thousand: '.' }));
                }
                else if( $(this).attr('data-currency-placement') == 'after' ){
                    $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ postfix: $(this).attr('data-currency'), decimals: 0, thousand: ' ' }));
                    $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ postfix: $(this).attr('data-currency'), decimals: 0, thousand: ' ' }));
                }
            }
            else {
                $(this).Link('lower').to( $(this).children('.values').children('.value-min'), null, wNumb({ decimals: 0 }));
                $(this).Link('upper').to( $(this).children('.values').children('.value-max'), null, wNumb({ decimals: 0 }));
            }
        });
    }

});

$(window).load(function(){
    var $equalHeight = $('.equal-height');
    for( var i=0; i<$equalHeight.length; i++ ){
        equalHeight( $equalHeight );
    }
});


$(window).resize(function(){
    adaptBackgroundHeight();
    var $equalHeight = $('.equal-height');
    for( var i=0; i<$equalHeight.length; i++ ){
        equalHeight( $equalHeight );
    }
});


function setLocation(position){
    var locationCenter = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        "latLng": locationCenter
    }, function (results, status) {
        if ( status == google.maps.GeocoderStatus.OK ){
            var placeName = '';
            var lat = results[0].geometry.location.lat();
            var lng = results[0].geometry.location.lng();
            if ( results[0].address_components[2].long_name ){
            	placeName = results[0].address_components[2].long_name;
            }
            console.log(lat, lng);
            $('#lat').val(lat);
            $('#lon').val(lng);
            $("#location").val(placeName);
        }
    });
}


function rating(element){
    var ratingElement =
        '<span class="stars">'+
            '<i class="fa fa-star s1" data-score="1"></i>'+
            '<i class="fa fa-star s2" data-score="2"></i>'+
            '<i class="fa fa-star s3" data-score="3"></i>'+
            '<i class="fa fa-star s4" data-score="4"></i>'+
            '<i class="fa fa-star s5" data-score="5"></i>'+
        '</span>'
    ;
    if( !element ) { element = ''; }
    $.each( $(element + ' .rating'), function(i) {
        $(this).append(ratingElement);
        if( $(this).hasClass('active') ){
            $(this).append('<input readonly hidden="" name="score_' + $(this).attr('data-name') +'" id="score_' + $(this).attr('data-name') +'">');
        }
        var rating = $(this).attr('data-rating');
        for( var e = 0; e < rating; e++ ){
            var rate = e+1;
            $(this).children('.stars').children( '.s' + rate ).addClass('active');
        }
    });

    var ratingActive = $('.rating.active i');
    ratingActive.on('hover',function(){
        for( var i=0; i<$(this).attr('data-score'); i++ ){
            var a = i+1;
            $(this).parent().children('.s'+a).addClass('hover');
        }
    },
    function(){
        for( var i=0; i<$(this).attr('data-score'); i++ ){
            var a = i+1;
            $(this).parent().children('.s'+a).removeClass('hover');
        }
    });
    ratingActive.on('click', function(){
        $(this).parent().parent().children('input').val( $(this).attr('data-score') );
        $(this).parent().children('.fa').removeClass('active');
        for( var i=0; i<$(this).attr('data-score'); i++ ){
            var a = i+1;
            $(this).parent().children('.s'+a).addClass('active');
        }
        return false;
    });
}

function lazyLoad(selector){
    selector.load(function() {
        $(this).parent().removeClass('loading');
    });
}

//  Equal heights ------------------------------------------------------------------------------------------------------

function equalHeight(container){
    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;

    $(container).find('.item, .price-box').each(function() {
        $el = $(this);
        $($el).height('auto');
        topPostion = $el.position().top;
        if (currentRowStart != topPostion) {
            for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
}

// Specific data for each item -----------------------------------------------------------------------------------------

function drawItemSpecific(category, json, a){
    var itemSpecific = '';
    if( category ){
        if( category == 'real_estate' ){
            if( json.data[a].item_specific ){
                if( json.data[a].item_specific.bedrooms ){
                    itemSpecific += '<span title="Bedrooms"><img src="assets/img/bedrooms.png">' + json.data[a].item_specific.bedrooms + '</span>';
                }
                if( json.data[a].item_specific.bathrooms ){
                    itemSpecific += '<span title="Bathrooms"><img src="assets/img/bathrooms.png">' + json.data[a].item_specific.bathrooms + '</span>';
                }
                if( json.data[a].item_specific.area ){
                    itemSpecific += '<span title="Area"><img src="assets/img/area.png">' + json.data[a].item_specific.area + '<sup>2</sup></span>';
                }
                if( json.data[a].item_specific.garages ){
                    itemSpecific += '<span title="Garages"><img src="assets/img/garages.png">' + json.data[a].item_specific.garages + '</span>';
                }
                return itemSpecific;
            }
        }
        else if ( category == 'bar_restaurant' ){
            if( json.data[a].item_specific ){
                if( json.data[a].item_specific.menu ){
                    itemSpecific += '<span>Menu from: ' + json.data[a].item_specific.menu + '</span>';
                }
                return itemSpecific;
            }
            return itemSpecific;
        }
    }
    else {
        return '';
    }
    return '';
}


// Adapt background height to block element ----------------------------------------------------------------------------
function adaptBackgroundHeight(){
    $('.background').each(function(){
        if( $(this).children('img').height() < $(this).height() ){
            //$(this).children('img').css('right', ( $(this).children('img').width()/2 -  $(window).width())/2 );
            $(this).children('img').css('width', 'auto');
            $(this).children('img').css('height', '100%');
        }
    });
}


function initializeOwl(_rtl){
    if ( $('.owl-carousel').length > 0 ){
        $(".item-slider").owlCarousel({
            rtl: _rtl,
            items: 1,
            autoHeight: true,
            responsiveBaseWidth: ".slide",
            nav: false,
            callbacks: true,
            URLhashListener: true,
            navText: ["",""]
        });
        $(".list-slider").owlCarousel({
            rtl: _rtl,
            items: 1,
            responsiveBaseWidth: ".slide",
            nav: true,
            navText: ["",""]
        });

        $('.item-gallery .thumbnails a').on('click', function(){
            $('.item-gallery .thumbnails a').each(function(){
                $(this).removeClass('active');
            });
            $(this).addClass('active');
        });
        $('.item-slider').on('translated.owl.carousel', function(event) {
            var thumbnailNumber = $('.item-slider .owl-item.active img').attr('data-hash');
            $( '.item-gallery .thumbnails #thumbnail-' + thumbnailNumber ).trigger('click');
        });
    }
}