(function ($) {
    $(function () {

function getQueryVariable(variable) {
    var query = window.location.search.substring(1);
    var vars = query.split('&');
    for (var i = 0; i < vars.length; i++) {
        var pair = vars[i].split('=');
        if (decodeURIComponent(pair[0]) == variable) {
            return decodeURIComponent(pair[1]);
        }
    }
    console.log('Query variable %s not found', variable);
}

function toEng() {
    if(window.location.pathname == '/') {
        window.location.pathname == '/en/';
    }
}


$(window).load(function(){



/**/

// --------------------------------------- //
// PRODUCTS FILTER HEADING //
// --------------------------------------- //

$('.products-filter-heading').click(function () {

  if ($(this).hasClass('active')) {
    $(this).removeClass('active');
    $('.products-filter-content').finish().slideUp();
    $(this).children('.toggle').text('Показать фильтр');
  } else {
    $(this).addClass('active');
    $('.products-filter-content').finish().slideDown();
    $(this).children('.toggle').text('Скрыть фильтр');
  }
  return false;
});

// --------------------------------------- //
// PRODUCTS FILTER SELECT //
// --------------------------------------- //

$('.products-filter-select .select-single').select2({
  minimumResultsForSearch: Infinity,
  theme: 'theme-single'
});

$('.products-filter-select .select-multiple').select2({
  closeOnSelect: false,
  theme: 'theme-multiple'
});

$('.products-filter-select .select-multiple').on('select2:opening select2:closing', function () {
  var $searchfield = $(this).parent().find('.select2-search__field');
  $searchfield.prop('disabled', true);
});

// --------------------------------------- //
// PRODUCTS FILTER RANGE //
// --------------------------------------- //

$('.products-filter-range').each(function () {
  var $this = $(this);
  $this.find('.slider').slider({
    range: true,
    min: $this.data('min'),
    max: $this.data('max'),
    step: 10,
    values: [$this.data('low'), $this.data('high')],
    create: function () {
      var $low = $('<span class="tooltip">' + $this.data('prefix') + $this.data('low') + '</span>');
      var $high = $('<span class="tooltip">' + $this.data('prefix') + $this.data('high') + '</span>');
      $this.find('.ui-slider-handle').eq(0).append($low);
      $this.find('.ui-slider-handle').eq(1).append($high);
    },
    slide: function (e, u) {
      $this.find('.ui-slider-handle').eq(0).find('.tooltip').html($this.data('prefix') + u.values[0]);
      $this.find('.ui-slider-handle').eq(1).find('.tooltip').html($this.data('prefix') + u.values[1]);
    },
    change: function (e, u) {
      $this.find('.ui-slider-handle').eq(0).find('.tooltip').html($this.data('prefix') + u.values[0]);
      $this.find('.ui-slider-handle').eq(1).find('.tooltip').html($this.data('prefix') + u.values[1]);
    }
  });
});

// --------------------------------------- //
// PRODUCTS FILTER TOGGLE //
// --------------------------------------- //

function setProdFilterToggleSwitch() {
  if ($('.products-filter-toggle').find('input').eq(0).prop('checked')) {
    $('.products-filter-toggle').find('.switch').removeClass('active');
  } else {
    $('.products-filter-toggle').find('.switch').addClass('active');
  }
}

setProdFilterToggleSwitch();

$('.products-filter-toggle input').change(function () {
  setProdFilterToggleSwitch();
});

$('.products-filter-toggle .switch').click(function () {
  $('.products-filter-toggle').find('input').eq(0).prop('checked', !$('.products-filter-toggle').find('input').eq(0).prop('checked'));
  $('.products-filter-toggle').find('input').eq(1).prop('checked', !$('.products-filter-toggle').find('input').eq(0).prop('checked'));
  $('.products-filter-toggle').find('input').trigger('change');
});

// --------------------------------------- //
// PRODUCTS FILTER RESET //
// --------------------------------------- //

$('.products-filter-controls .reset').click(function () {
  $('.products-filter-select').each(function () {
    $(this).find('select').val(null).trigger('change');
  });
  $('.products-filter-range').each(function () {
    var $this = $(this);
    $this.find('.slider').slider('values', [$this.data('low'), $this.data('high')]);
  });
  setTimeout(setProdFilterToggleSwitch, 1);
});




















    /**/

    $.get("https://query.yahooapis.com/v1/public/yql?q=select+*+from+yahoo.finance.xchange+where+pair+=+%22USDRUB,EURRUB%22&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys&callback=", function( data ) {
        console.log(data);
        $('.dollar-course').text(data.query.results.rate[0].Rate);       
        $('.euro-course').text(data.query.results.rate[1].Rate); 
    });

    if($('#clock-1').length != 0) {

        var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
        var t = new Date ();
        var h = t.getUTCHours()+3; if (h > 23) h -= 24; if (h < 0) h += 24;
        var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;

        console.log(t.getUTCHours());
        
        document.getElementById ('clock-1').innerHTML =
            [f (h), f (m)].join (':');

        var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
        var t = new Date ();
        var h = t.getUTCHours()+4; if (h > 23) h -= 24; if (h < 0) h += 24;
        var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;

        document.getElementById ('clock-2').innerHTML =
            [f (h), f (m)].join (':');

        var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
        var t = new Date ();
        var h = t.getUTCHours()+5; if (h > 23) h -= 24; if (h < 0) h += 24;
        var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;

        document.getElementById ('clock-3').innerHTML =
            [f (h), f (m)].join (':');

        var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
        var t = new Date ();
        var h = t.getUTCHours()+7; if (h > 23) h -= 24; if (h < 0) h += 24;
        var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;

        document.getElementById ('clock-4').innerHTML =
            [f (h), f (m)].join (':');
        
        setInterval(function() {

        	var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
    		var t = new Date ();
    		var h = t.getUTCHours()+3; if (h > 23) h -= 24; if (h < 0) h += 24;
    		var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;
     
    		document.getElementById ('clock-1').innerHTML =
        		[f (h), f (m)].join (':');

        	var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
    		var t = new Date ();
    		var h = t.getUTCHours()+4; if (h > 23) h -= 24; if (h < 0) h += 24;
    		var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;
     
    		document.getElementById ('clock-2').innerHTML =
        		[f (h), f (m)].join (':');

        	var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
    		var t = new Date ();
    		var h = t.getUTCHours()+5; if (h > 23) h -= 24; if (h < 0) h += 24;
    		var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;
     
    		document.getElementById ('clock-3').innerHTML =
        		[f (h), f (m)].join (':');

        	var f = function (x) {return (((x < 10) ? '0' : '') + x)}; 
    		var t = new Date ();
    		var h = t.getUTCHours()+7; if (h > 23) h -= 24; if (h < 0) h += 24;
    		var m = t.getUTCMinutes(); if (m > 59) { m -= 60; h += 1;} if (m < 0) { m += 60; h -= 1;} if (h > 23) h -= 24; if (h < 0) h += 24;
     
    		document.getElementById ('clock-4').innerHTML =
        		[f (h), f (m)].join (':');

        }, 60000);
    }

    $('.search-toggle').click(function() {

        if($('#fast-search').css('display') == 'none') {

            $('#menu-1').hide();
            $('#fast-search').show();

        } else {

            $('#fast-search').hide();
            $('#menu-1').show();

        }

        return false;
    });

    $('.result-expand-block-old').click(function() {

        $('.result-hidden-old').show();
    });

    $('.result-expand-block-new').click(function() {

        $('.result-hidden-new').show();
    });

    // --------------------------------------- //
    // MENU DROPDOWN //
    // --------------------------------------- //

    $('.menu-toggle').click(function(){
        $(this).toggleClass('active');
        $('.menu-dropdown').finish().slideToggle();
        return false;
    });

    // --------------------------------------- //
    // DOWNLOAD ALL //
    // --------------------------------------- //

    $('.download-all input[type="checkbox"]').click(function(){
        if ($(this).is(':checked')) {
            $(this).parent().parent().prev().find('input[type="checkbox"]').prop('checked', true);
            $('#download-files').css('background', '#0067ac url(/img/download-icon-white.png) 30px center no-repeat');
        } else {
            $(this).parent().parent().prev().find('input[type="checkbox"]').prop('checked', false);
            $('#download-files').css('background', 'grey url(/img/download-icon-white.png) 30px center no-repeat');
        }
    });

    $('.product-downloads .item').click(function() {
        window.scrollTo(0, $('.product-downloads').offset().top);

        var flag = false;

        $('.product-downloads').find('input[type="checkbox"]').each(function() {

            if($(this).prop('checked') == true) {

                flag = true;
            }
        });

        // console.log(flag);

        if(flag) {

            $('#download-files').css('background', '#0067ac url(/img/download-icon-white.png) 30px center no-repeat');
        } else {
            $('#download-files').css('background', 'grey url(/img/download-icon-white.png) 30px center no-repeat');
        }
    });

    // --------------------------------------- //
    // PRODUCT SERIES DROPDOWN //
    // --------------------------------------- //

    $('.product-series-toggle').click(function(){
        if ( $(this).hasClass('open') ) {
            $(this).removeClass('open');
            $('.product-series-content').finish().slideUp();
        } else {
            $('.product-series-toggle').removeClass('open');
            $(this).addClass('open');
            $('.product-series-content').finish().slideUp();
            $( $(this).attr('href') ).finish().slideDown();
        }
        return false;
    });

    // --------------------------------------- //
    // SUBNAV //
    // --------------------------------------- //

    $('.subnav-wrapper').height($(document).height() - 135);

    $('.subnav-toggle').click(function(){
        if ( $('.subnav-wrapper').is(':animated') ) return false;
        if ( $(this).parent().hasClass('active') ) {
            $(this).parent().removeClass('active');
            $($(this).attr('href')).fadeOut().children('.subnav-container').slideUp();
        } else if ( $('.subnav-wrapper:visible').length ) {
            $('.subnav-toggle').parent().removeClass('active');
            $(this).parent().addClass('active');
            $('.subnav-wrapper').hide().children('.subnav-container').hide();
            $($(this).attr('href')).show().children('.subnav-container').show();
        } else {
            $(this).parent().addClass('active');
            $($(this).attr('href')).fadeIn().children('.subnav-container').slideDown();
        }
        return false;
    });

    $('.subnav-wrapper').click(function(e){
        if ( $(e.target).hasClass('subnav-wrapper') ) {
            $('.subnav-toggle').parent().removeClass('active');
            $(this).fadeOut().children('.subnav-container').slideUp();
        }
    });

    // --------------------------------------- //
    // TOOL DROPDOWN //
    // --------------------------------------- //

    $('.tool-description-toggle').click(function(){
        var $element = $($(this).attr('href'));
        if ( $element.hasClass('open') ) {
            $element.removeClass('open').finish().slideUp();
            $(this).text('Подробнее');
        } else {
            $element.addClass('open').finish().slideDown();
            $(this).text('Скрыть');
        }
        return false;
    });

    // --------------------------------------- //
    // FAQ //
    // --------------------------------------- //

    $('.answer-toggle').click(function(){
        $(this).toggleClass('active');
        $(this).parent('.answer-container').finish().toggleClass('open', 300);
    });

    // --------------------------------------- //
    // VACANCY //
    // --------------------------------------- //

    $('.filebox input').change(function(){
        $(this).parent().next().html(
            "<small>Прикрепленный файл:</small><br/>" + $(this).val().replace(/.+[\\\/]/, "")
        );
    });

    $('.show-specs').click(function() {
        $('.product-section-cell').css('border', 'none');
        $(this).parent().css('border', '2px solid #dc4b14');
        $('.item-group-2').hide(400);
        $('.product-family').hide(0);
        $('#'+$(this).attr('data-href')).stop().show(400);

        $(window).scrollTop($('#'+$(this).attr('data-href')).offset().top);

        return false;
    });

    $('#download-files').click(function() {

        var files = [];

        if($('.product-downloads .item input:checked').length <= 0) {

            return false;
        }

        $('.product-downloads .item input:checked').next().next().next().each(function(index, value) {

            files.push($(value).attr('href'));
        });

        $.ajax({
            type: "POST",
            url: '/ru-production/archive.php',
            data: JSON.stringify(files)
        }).done(function(data) {
            data = data.replace(/\\\//g, '/');
            data = data.replace(/"/g, '');
            window.open(data);
        });

        return false;
    });
    
    //было закоменчино
    /*if ($('#map').length > 0) {
        $.ajax({
            url: "http://maps.google.com/maps/api/geocode/json?address=Москва&sensor=false",
        }).done(function(data) {

            var coords = new google.maps.LatLng(data.results[0].geometry.location.lat, data.results[0].geometry.location.lng);

            var myOptions = {
              zoom: 7,
              mapTypeId: google.maps.MapTypeId.ROADMAP,
              center: coords
            }

            map = new google.maps.Map(document.getElementById('map'), myOptions);

        });
    }*/

    $('#switch-1').click(function() {

        $(this).attr("checked", "checked");
        $(this).css({"border-color": "#dc4b14"});
        $('#switch-2').css({"border-color": "#e5e5e5"});
        $('#switch-2').removeAttr("checked");
        $('#switch-1-input').show();
        $('#switch-2-input').hide();
    });

    $('#switch-2').click(function() {

        $(this).attr("checked", "checked");
        $(this).css({"border-color": "#dc4b14"});
        $('#switch-1').css({"border-color": "#e5e5e5"});
        $('#switch-1').removeAttr("checked");
        $('#switch-2-input').show();
        $('#switch-1-input').hide();
    });

    $('#switch-3').click(function() {

        $('#h2').val('0.8');
        $(this).addClass("checked");
        $(this).css({"border-color": "#dc4b14"});
        $('#switch-4').css({"border-color": "#e5e5e5"});
        $('#switch-4').removeClass("checked");
        $('.calc-room-container img').attr("src", "/img/calculator/table.jpg");
        $('#h21').val('0.8');
    });

    $('#switch-4').click(function() {

        $('#h2').val('0');
        $(this).addClass("checked");
        $(this).css({"border-color": "#dc4b14"});
        $('#switch-3').css({"border-color": "#e5e5e5"});
        $('#switch-3').removeClass("checked");
        $('.calc-room-container img').attr("src", "/img/calculator/floor.jpg");
        $('#h21').val('0');
    });

    $('#a').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-length.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-length.jpg");
        }
    });

    $('#b').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-width.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-width.jpg");
        }
    });

    $('#h').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-height.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-height.jpg");
        }
    });

    $('.h01').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-h1.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-h1.jpg");
        }
    });

    $('#a1').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-length.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-length.jpg");
        }
    });

    $('#b1').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-width.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-width.jpg");
        }
    });

    $('#h1:not(.h01)').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-height.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-height.jpg");
        }
    });

    $('#h11').focus(function() {

        if($('#switch-3').hasClass("checked")) {

            $('.calc-room-container img').attr("src", "/img/calculator/table-h1.jpg");
        }
        else {

            $('.calc-room-container img').attr("src", "/img/calculator/floor-h1.jpg");
        }
    });

    $('#switch-calc-2-1').click(function() {

        if(!$(this).hasClass('active')) {

            $(this).addClass('active');
            $(this).css("border-color", "#dc4b14");
            $('#switch-calc-2-2').css("border-color", "#e5e5e5");
            $('#switch-calc-2-2').removeClass('active');
            $('#switch-calc-2-2').next().hide();
            $('.table-2').hide();
            $('.analog-info').hide();
            $('#result-2-2').show();
            $('#result-2-1').hide();
            $('.origin-hide-1234').css('display', 'none');
        }
    });

    $('#switch-calc-2-2').click(function() {

        if(!$(this).hasClass('active')) {

            $(this).addClass('active');
            $(this).css("border-color", "#dc4b14");
            $('#switch-calc-2-1').css("border-color", "#e5e5e5");
            $('#switch-calc-2-1').removeClass('active');
            $('#switch-calc-2-2').next().show();
            $('.table-2').show();
            $('.analog-info').show();
            $('#result-2-1').show();
            $('#result-2-2').hide();
            $('.origin-hide-1234').css('display', 'inline-block');
        }
    });

    $('.result-expand-block').click(function() {

        if($(this).hasClass('active')) {

            $('#result').hide();
            $(this).removeClass('active');
        } else {

            $('#result').show();
            $(this).addClass('active');
        }
    });

    $('.accessory_count').change(function() {

        var count = $(this).val();

        var price           = $(this).parent().parent().parent().parent().parent().find('.accessory_price').val();
        var length_netto    = $(this).parent().parent().parent().parent().parent().find('.accessory_length_netto').val();
        var width_netto     = $(this).parent().parent().parent().parent().parent().find('.accessory_width_netto').val(); 
        var height_netto    = $(this).parent().parent().parent().parent().parent().find('.accessory_height_netto').val();
        var weight_netto    = $(this).parent().parent().parent().parent().parent().find('.accessory_weight_netto').val(); 
        var length_brutto   = $(this).parent().parent().parent().parent().parent().find('.accessory_length_brutto').val();
        var width_brutto    = $(this).parent().parent().parent().parent().parent().find('.accessory_width_brutto').val(); 
        var height_brutto   = $(this).parent().parent().parent().parent().parent().find('.accessory_height_brutto').val();
        var weight_brutto   = $(this).parent().parent().parent().parent().parent().find('.accessory_weight_brutto').val();
        var lamp_quantity   = $(this).parent().parent().parent().parent().parent().find('.accessory_quantity').val();

        console.log(price);

        var packages = Math.ceil(count/lamp_quantity);
        var volume = length_brutto*width_brutto*height_brutto*packages;
        var weight = weight_brutto*packages;
        var full_price = price*count;

        $(this).parent().parent().parent().find('.accesorie-full-volume').text(volume);
        $(this).parent().parent().parent().find('.accesorie-full-weight').text(weight);
        $(this).parent().parent().parent().find('.accesorie-full-price').text(full_price);
        $(this).parent().parent().parent().find('.package_count').text(packages);

    });

    calc_onload();

});

function downloadPDF(link) {
    //document.getElementById('preloader').style.display = 'block';

    $.ajax({
        type: "GET",
        url: link,
    }).done(function(data) {

        data = data.replace(/\\\//g, '/');
        data = data.replace(/"/g, '');
        //document.getElementById('preloader').style.display = 'none';
        window.open(data);
    });

    return false;
}

ymaps.ready(function(){
    //Диллеры страница /ru/dealers/
    if($("#map").get(0))
    {
        var myMap,myCollection;
        
        myMap = new ymaps.Map("map", {
            center: [55.755826, 37.6172999],   
            zoom: 11,
            controls:['zoomControl']    
            
        });
    
        var markers = [];
        //var arr = '';
        var pos;
    
        for(key in arr) {
    
            var marker = [];
    
            marker['longitude'] = arr[key].long;
            marker['latitude'] = arr[key].lat;
            marker['address'] = arr[key].address;
            marker['id'] = key
            marker['name'] = arr[key].name;
            marker['phone'] = arr[key].phone;
            marker['site'] = arr[key].site;
            marker['mail'] = arr[key].mail;
            marker['logo'] = arr[key].logo;
            marker['position'] = arr[key].position;
            
            markers.push(marker);
        } 
    
        objectManager = new ymaps.ObjectManager({
            clusterize: false
        });
    
        // Добавляем метки в коллекцию.
        markers.forEach(function(value, index) {
            if (value['position'] == 1) {
                pos = '<a href="/cp.pdf"><img src="/img/honor-icon.png" alt=""></a>';
            }else{
                pos = '';
            }
    
            var content = '<div style="width: 400px;"><div style="display: inline-block; width: 200px; vertical-align: top; text-align: center;"><img src="'+value['logo']+'" style="max-width: 100%;"><br>'+pos+'</div><div style="display: inline-block; width: 200px; vertical-align: top;"><h3>'+value['name']+'</h3><img src="/img/address-icon.png" alt="">'+value['address']+'<br><img src="/img/phone-icon.png" alt="">'+value['phone']+'<br><a class="more" href="mailto:'+value['mail']+'"><span class="email-icon"></span>'+
                '<span class="dotted-link"> '+value['mail']+'</span></a><br><noindex><a target="_blank" rel="nofollow" class="more" href="'+value['site']+'"><span class="site-icon"></span><span class="dotted-link"> '+value['site']+'</span>                               </a></noindex></div></div>';
    
            objectManager.add({"type": "Feature", "id": value['id'], "geometry": {"type": "Point", "coordinates": [value['latitude'], value['longitude']]}, "properties": {"balloonContent": content}});
        });
         
        myMap.geoObjects.add(objectManager);  
    }
    
    //Карта на странице контакты /ru/contacts/
    if($("#map_contacts").get(0))
    {
    	var myMap_2, myPlacemark_2;
    	 myMap_2 = new ymaps.Map("map_contacts", {
            center: [54.846285,46.338864],
            zoom: 16
        });
    	myPlacemark_2 = new ymaps.Placemark([54.846285,46.338864], {}, {});
       
        myMap_2.behaviors.disable("scrollZoom");
        myMap_2.geoObjects.add(myPlacemark_2);
    }
});


function centerMapOnMarker(id) {
    objectManager.objects.balloon.open(id);
    //google.maps.event.trigger(window.google_markers[id], 'click');
}

function mapSwitch(type, id, map_address, map_zoom) {
    if(type == 'region') {

        $('.marker-list, .city-list').css('display', 'none');
        $('.region-'+id).css('display', 'block');
    }
    else if(type == 'city') {

        $('.marker-list').css('display', 'none');
        $('.city-'+id).css('display', 'block');
    }
    
    //было закоменчино
    //$.ajax({
        //url: "http://maps.google.com/maps/api/geocode/json?address="+map_address+"&sensor=false",
    //}).done(function(data) {

        //map = window.map;

        //marker_coords = new google.maps.LatLng(data.results[0].geometry.location.lat, data.results[0].geometry.location.lng);
        //map.setCenter(marker_coords);
    //});

    $.ajax({
        url: "https://geocode-maps.yandex.ru/1.x/?format=json&geocode="+map_address,
    }).done(function(data) {

       res = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos;
       coords = res.split(' ')

       myMap.setCenter([coords[1], coords[0]],11);
    });
}


function showDealer(link) {

    window.location = link;
}

function showYear(id) {

    $('.container-year').hide();
    $('#year-'+id).show();
}

function scrollYear(id) {

    $('html, body').animate({
        scrollTop: $('#year-'+id).offset().top
    }, 800);
}

function calc1() {

    var e       = $('#e').val();
    var count   = $('#count').val();
    var a       = $('#a').val();
    var b       = $('#b').val();
    var h       = $('#h').val();
    var h1      = $('#h1').val();
    var h2      = $('#h2').val();
    var k       = $('#k').val();
    var z       = $('#z').val();
    var f       = $('#f').val();
    var origin_lamp_count = $('#origin_lamp_count').val();

    var id      = $('#id').val();

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    var ki006 = parseFloat($('#ki006').val());
    var ki008 = parseFloat($('#ki008').val());
    var ki010 = parseFloat($('#ki010').val());
    var ki125 = parseFloat($('#ki125').val());
    var ki150 = parseFloat($('#ki150').val());
    var ki200 = parseFloat($('#ki200').val());
    var ki250 = parseFloat($('#ki250').val());
    var ki300 = parseFloat($('#ki300').val());
    var ki400 = parseFloat($('#ki400').val());
    var ki500 = parseFloat($('#ki500').val());

    if(h2 < 0)  {

        h2 = 0.8;
        $('#h2').val('0.8');
    }

    if(isNaN(h2))  {

        h2 = 0;
        $('#h2').val('0');
    }

    var hp = h-h1-h2;

    if(hp <= 0) {

        $('.result').text('Высота комнаты должна быть больше высоты подвеса лампы и рабочей поверхности.');

        return false;
    }

    var nn = (a*b)/(hp*(a+b));

    var nnout = 0;

    if(nn < 0.7) {

        nnout = ki006;
    }
    else if(nn < 0.9) {

        nnout = ki008;
    }
    else if(nn < 1.125) {

        nnout = ki010;
    }
    else if(nn < 1.375) {

        nnout = ki125;
    }
    else if(nn < 1.75) {

        nnout = ki150;
    }
    else if(nn < 2.25) {

        nnout = ki200;
    }
    else if(nn < 2.75) {

        nnout = ki250;
    }
    else if(nn < 3.5) {

        nnout = ki300;
    }
    else if(nn < 4.5) {

        nnout = ki400;
    }
    else {

        nnout = ki500;
    }

    if($('#switch-2').attr("checked") == 'checked') {

        var count = (e*a*b*k*z*100)/(f*nnout*origin_lamp_count);

        var e_average = Math.ceil(count)*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        $('#lamp_count').val(count);

        if(isNaN(count)) {

            $('.result').text('Проверьте введенные данные');
        }
        else {

            $('.result').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('.result').html('Количество светильников <span>'+Math.ceil(count)+' шт</span>, при минимальной средней освещенности <span>'+Math.floor(e_average)+' лк</span>');
                $('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('.calc-button.download').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }  
    }
    else {

        var e = count*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        $('#lamp_count').val(count);

        if(isNaN(count)) {

            $('.result').text('Проверьте введенные данные');
        }
        else {

            $('.result').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('.result').html('Минимальная средняя освещенность <span>'+Math.floor(e)+' лк</span>');
                $('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('.calc-button.download').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }
    }
}

function economic(id, e, count, a, b, h, h1, h2, k, z, f) {

    if(typeof(e)==='undefined') e = 400;
    if(typeof(count)==='undefined') count = 10;
    if(typeof(a)==='undefined') a = 12;
    if(typeof(b)==='undefined') b = 8;
    if(typeof(h)==='undefined') h = 3.3;
    if(typeof(h1)==='undefined') h1 = 0;
    if(typeof(h2)==='undefined') h2 = 0;
    if(typeof(k)==='undefined') k = 1.5;
    if(typeof(z)==='undefined') z = 1.1;
    if(typeof(f)==='undefined') f = 0;

    window.location = '/ru/calculate/?modification='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'#tab-1';
}

function complect(id, e, count, a, b, h, h1, h2, k, z, f) {

    if(typeof(e)==='undefined') e = 400;
    if(typeof(count)==='undefined') count = 10;
    if(typeof(a)==='undefined') a = 12;
    if(typeof(b)==='undefined') b = 8;
    if(typeof(h)==='undefined') h = 3.3;
    if(typeof(h1)==='undefined') h1 = 0;
    if(typeof(h2)==='undefined') h2 = 0;
    if(typeof(k)==='undefined') k = 1.5;
    if(typeof(z)==='undefined') z = 1.1;
    if(typeof(f)==='undefined') f = 0;

    window.location = '/ru/calculate/?modification='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'#tab-2';
}

$(window).load(function() {

    window.rootcategory = getQueryVariable('root');
    window.category = getQueryVariable('category');

    $('#switch-2-input').css('display', 'none');

    $('.calculate-lamp-select').change(function() {
        
        window.location = '?modification='+$(this).val()+'&root='+window.rootcategory+'&category='+window.category;
    });

    $('#calculate-root-category').change(function() {
        $('.calculate-category').next().hide();
        $('#calculate-category-'+$(this).val()).next().show();

        console.log($(this).val());

        window.rootcategory = $(this).val();

        $('.calculate-lamp-select').next().hide();
        $('#calculate-lamp-select-m'+$(this).val()).next().show();
    });

    $('.calculate-category').change(function() {
        $('.calculate-lamp-select').next().hide();
        $('#calculate-lamp-select-'+$(this).val()).next().show();

        window.category = $(this).val();
    });
});

function calc2() { 

    $('#results').after('<img class="calc-2-preloader" src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 20px auto;">');

    setTimeout(function() {

        $('.calc-2-preloader').remove();

        var origin_name = $('.current-modification-name').text();
        var analog_name = $('.current-analog-name').text();

        var a   = parseFloat($('#a').val());
        var b   = parseFloat($('#b').val());
        var h   = parseFloat($('#h').val());
        var k   = parseFloat($('#k1').val());
        var z   = parseFloat($('#z1').val());
        var N   = parseInt($('#N').val());
        var H   = parseInt($('#H').val());
        var q   = parseFloat($('#q').val());
        var Kq  = parseFloat($('#Kq').val())/100;
        var M   = parseFloat($('#M').val());
        var Z   = parseFloat($('#Z').val());
        var pn  = parseFloat($('#pn').val());
        var t   = parseFloat($('#t').val());
        var d   = parseFloat($('#d').val());
        var ko  = parseFloat($('#ko').val());
        var h1  = parseFloat($('#h11').val());
        var h2  = parseFloat($('#h21').val());
        var count  = parseFloat($('#count_analog').val());
        var e      = parseFloat($('#e1').val());
        var f = parseFloat($('#f1').val());

        var origin_price      = parseFloat($('#original_price').val());
        var origin_price_part = parseFloat($('#original_price_part').val());
        var origin_pra_loss   = parseFloat($('#original_pra_loss').val());
        var origin_lamp_count = parseInt($('#original_lamp_count').val());
        var origin_capacity   = parseFloat($('#original_capacity').val());
        var origin_work_time  = parseInt($('#original_work_time').val());

        var analog_price      = parseFloat($('#analog_price').val());
        var analog_price_part = parseFloat($('#analog_price_part').val());
        var analog_pra_loss   = parseFloat($('#analog_pra_loss').val());
        var analog_lamp_count = parseInt($('#analog_lamp_count').val());
        var analog_capacity   = parseFloat($('#analog_capacity').val());
        var analog_work_time  = parseInt($('#analog_work_time').val());

        var ki006 = parseFloat($('#origin_ki006').val());
        var ki008 = parseFloat($('#origin_ki008').val());
        var ki010 = parseFloat($('#origin_ki010').val());
        var ki125 = parseFloat($('#origin_ki125').val());
        var ki150 = parseFloat($('#origin_ki150').val());
        var ki200 = parseFloat($('#origin_ki200').val());
        var ki250 = parseFloat($('#origin_ki250').val());
        var ki300 = parseFloat($('#origin_ki300').val());
        var ki400 = parseFloat($('#origin_ki400').val());
        var ki500 = parseFloat($('#origin_ki500').val());

        var hp = h-h1-h2;

        var nn = (a*b)/(hp*(a+b));

        var nnout = 0;

        if(nn < 0.7) {

            nnout = ki006;
        }
        else if(nn < 0.9) {

            nnout = ki008;
        }
        else if(nn < 1.125) {

            nnout = ki010;
        }
        else if(nn < 1.375) {

            nnout = ki125;
        }
        else if(nn < 1.75) {

            nnout = ki150;
        }
        else if(nn < 2.25) {

            nnout = ki200;
        }
        else if(nn < 2.75) {

            nnout = ki250;
        }
        else if(nn < 3.5) {

            nnout = ki300;
        }
        else if(nn < 4.5) {

            nnout = ki400;
        }
        else {

            nnout = ki500;
        }

        console.log('nnout'+nnout);

        var e = N*(f*nnout*origin_lamp_count)/(a*b*k*z*100);

        console.log('---');
        console.log(origin_lamp_count);
        console.log(analog_lamp_count);
        console.log('---');

        var fx = parseFloat($('#analog_light_flow').val());

        var analog_ki006 = parseFloat($('#analog_ki006').val());
        var analog_ki008 = parseFloat($('#analog_ki008').val());
        var analog_ki010 = parseFloat($('#analog_ki010').val());
        var analog_ki125 = parseFloat($('#analog_ki125').val());
        var analog_ki150 = parseFloat($('#analog_ki150').val());
        var analog_ki200 = parseFloat($('#analog_ki200').val());
        var analog_ki250 = parseFloat($('#analog_ki250').val());
        var analog_ki300 = parseFloat($('#analog_ki300').val());
        var analog_ki400 = parseFloat($('#analog_ki400').val());
        var analog_ki500 = parseFloat($('#analog_ki500').val());

        var nnout = 0;

        if(nn < 0.7) {

            nnout = analog_ki006;
        }
        else if(nn < 0.9) {

            nnout = analog_ki008;
        }
        else if(nn < 1.125) {

            nnout = analog_ki010;
        }
        else if(nn < 1.375) {

            nnout = analog_ki125;
        }
        else if(nn < 1.75) {

            nnout = analog_ki150;
        }
        else if(nn < 2.25) {

            nnout = analog_ki200;
        }
        else if(nn < 2.75) {

            nnout = analog_ki250;
        }
        else if(nn < 3.5) {

            nnout = analog_ki300;
        }
        else if(nn < 4.5) {

            nnout = analog_ki400;
        }
        else {

            nnout = analog_ki500;
        }

        var count_analog = Math.ceil((e*a*b*k*z*100)/(fx*nnout));

        $('#count_analog_2').text(count_analog);
        $('#ex').text(e.toFixed(0));

        //расчет для одного светильника

        var Nx = 1;

        var nn_originx = Nx*origin_lamp_count;

        console.log('nn_originx '+nn_originx);

        var hours_per_yearx = t*d;

        var lamps_per_year_originx = hours_per_yearx/origin_work_time;

        var total_capacity_originx = origin_pra_loss*origin_lamp_count*origin_capacity;

        var S = a*b;

        var maximum_capacity_allowed_originx = total_capacity_originx/S;

        var year_lamp_cost_originx = [];

        year_lamp_cost_originx[0] = 0;

        year_lamp_cost_originx[1] = parseInt(origin_price_part);

        for(var i = 2; i < H+1; i++) {

            year_lamp_cost_originx[i] = year_lamp_cost_originx[i-1]*Kq+year_lamp_cost_originx[i-1];
        }

        var linked_power_originx = total_capacity_originx*Nx/1000;

        var total_investment_cost_originx = Nx*(origin_price_part*origin_lamp_count+origin_price+M)+linked_power_originx*pn;

        var year_renew_originx = [];

        year_renew_originx[0] = 0;

        year_renew_originx[1] = parseInt(Z);

        for(var i = 2; i < H+1; i++) {

            year_renew_originx[i] = year_renew_originx[i-1]*Kq+year_renew_originx[i-1];
        }

        year_total_cost_originx = [];

        year_total_cost_originx[0] = 0;

        year_total_cost_originx[1] = parseInt(Nx*Z);

        total_year_total_cost_originx = year_total_cost_originx[0]+year_total_cost_originx[1];

        for(var i = 2; i < H+1; i++) {

            year_total_cost_originx[i] = Nx*(year_renew_originx[i]+origin_lamp_count*lamps_per_year_originx*year_lamp_cost_originx[i]);

            total_year_total_cost_originx += year_total_cost_originx[i]
        }

        year_energy_price_originx = [];

        year_energy_price_originx[0] = 0;

        year_energy_price_originx[1] = q;

        for(var i = 2; i < H+1; i++) {

            year_energy_price_originx[i] = parseFloat(year_energy_price_originx[i-1]*Kq+year_energy_price_originx[i-1]);
        }

        var consumed_power_originx = linked_power_originx*ko/100;
        var consumed_power_per_year_originx = consumed_power_originx*hours_per_yearx;

        var consumed_power_per_year_price_originx = [];

        consumed_power_per_year_price_originx[0] = 0;

        consumed_power_per_year_price_originx[1] = consumed_power_per_year_originx*year_energy_price_originx[1];

        var consumed_power_per_year_price_total_originx = consumed_power_per_year_price_originx[1];

        for(var i = 2; i < H+1; i++) {

            consumed_power_per_year_price_originx[i] = consumed_power_per_year_originx*year_energy_price_originx[i];

            consumed_power_per_year_price_total_originx += consumed_power_per_year_price_originx[i];
        }

        var total_cost_originx = consumed_power_per_year_price_total_originx+total_year_total_cost_originx+total_investment_cost_originx;

        var consumed_power_per_year_price_total_origin_percentx = consumed_power_per_year_price_total_originx/total_cost_originx*100;

        var total_year_total_cost_origin_percentx = total_year_total_cost_originx/total_cost_originx*100;

        var total_investment_cost_origin_percentx = total_investment_cost_originx/total_cost_originx*100;

        var overall_cost_originx = year_total_cost_originx[1]+consumed_power_per_year_price_originx[1];

        //конец расчета для одного светильника

        var count = count_analog;

        console.log('--------');

        console.log(N);
        console.log(count);

        var nn_origin = N*origin_lamp_count;
        var nn_analog = count*analog_lamp_count;

        var hours_per_year = t*d;

        var lamps_per_year_origin = hours_per_year/origin_work_time;
        var lamps_per_year_analog = hours_per_year/analog_work_time;

        var total_capacity_origin = origin_pra_loss*origin_lamp_count*origin_capacity;
        var total_capacity_analog = analog_pra_loss*analog_lamp_count*analog_capacity;

        var S = a*b;

        var maximum_capacity_allowed_origin = total_capacity_origin/S;
        var maximum_capacity_allowed_analog = total_capacity_analog/S;

        result_new = '';
        result_old = '';

        result = '<table style="width: 100%;">';

        var year_lamp_cost_origin = [];
        var year_lamp_cost_analog = [];

        year_lamp_cost_origin[0] = 0;
        year_lamp_cost_analog[0] = 0;

        year_lamp_cost_origin[1] = parseInt(origin_price_part);
        year_lamp_cost_analog[1] = parseInt(analog_price_part);

        result = result+'<tr><td></td><td>Оригинал</td><td>Аналог</td></tr>';
        result = result+'<tr><td>Стоимость источника света с учетом инфляции за 0 год</td><td>'+year_lamp_cost_origin[0]+'</td><td>'+year_lamp_cost_analog[0]+'</td></tr>';
        result = result+'<tr><td>Стоимость источника света с учетом инфляции за 1 год</td><td>'+year_lamp_cost_origin[1]+'</td><td>'+year_lamp_cost_analog[1]+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_lamp_cost_origin[i] = year_lamp_cost_origin[i-1]*Kq+year_lamp_cost_origin[i-1];
            year_lamp_cost_analog[i] = year_lamp_cost_analog[i-1]*Kq+year_lamp_cost_analog[i-1];

            result = result+'<tr><td>Стоимость источника света с учетом инфляции за '+parseInt(i)+' год</td><td>'+year_lamp_cost_origin[i].toFixed(0)+'</td><td>'+year_lamp_cost_analog[i].toFixed(0)+'</td></tr>';
        }

        var linked_power_origin = total_capacity_origin*N/1000;
        var linked_power_analog = total_capacity_analog*count/1000;

        var total_investment_cost_origin = N*(origin_price_part*origin_lamp_count+origin_price+M)+linked_power_origin*pn;
        var total_investment_cost_analog = count*(analog_price_part*analog_lamp_count+analog_price+M)+linked_power_analog*pn;

        result = result+'<tr><td>Общие инвестиционные затраты</td><td>'+total_investment_cost_origin.toFixed(0)+'</td><td>'+total_investment_cost_analog.toFixed(0)+'</td></tr>';

        result_new = result_new + '<tr><td>Общие инвестиционные затраты</td><td>'+total_investment_cost_origin.toFixed(0)+'</td><td>'+total_investment_cost_analog.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Общие инвестиционные затраты</td><td>'+total_investment_cost_origin.toFixed(0)+'</td><td> - </td></tr>';

        var temp43r5b = total_investment_cost_origin.toFixed(0);
        var temp43r6b = total_investment_cost_analog.toFixed(0);

        var year_renew_origin = [];
        var year_renew_analog = [];

        year_renew_origin[0] = 0;
        year_renew_analog[0] = 0;

        year_renew_origin[1] = parseInt(Z);
        year_renew_analog[1] = parseInt(Z);

        result = result+'<tr><td>Стоимость замены с учетом инфляции за 0 год</td><td>'+year_renew_origin[0]+'</td><td>'+year_renew_analog[0]+'</td></tr>';
        result = result+'<tr><td>Стоимость замены с учетом инфляции за 1 год</td><td>'+year_renew_origin[1]+'</td><td>'+year_renew_analog[1]+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_renew_origin[i] = year_renew_origin[i-1]*Kq+year_renew_origin[i-1];
            year_renew_analog[i] = year_renew_analog[i-1]*Kq+year_renew_analog[i-1];

            result = result+'<tr><td>Стоимость замены с учетом инфляции за '+parseInt(i)+' год</td><td>'+year_renew_origin[i].toFixed(0)+'</td><td>'+year_renew_analog[i].toFixed(0)+'</td></tr>';
        }

        year_total_cost_origin = [];
        year_total_cost_analog = [];

        year_total_cost_origin[0] = 0;
        year_total_cost_analog[0] = 0;

        year_total_cost_origin[1] = parseInt(N*Z);
        year_total_cost_analog[1] = parseInt(count*Z);  

        total_year_total_cost_origin = year_total_cost_origin[0]+year_total_cost_origin[1];
        total_year_total_cost_analog = year_total_cost_analog[0]+year_total_cost_analog[1];

        result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за 1 год</td><td>'+parseInt(N*Z)+'</td><td>'+parseInt(count*Z)+'</td></tr>';

        console.log('Общая стоимость эксплуатации и замены источников света');

        for(var i = 2; i < H+1; i++) {

            year_total_cost_origin[i] = N*(year_renew_origin[i]+origin_lamp_count*lamps_per_year_origin*year_lamp_cost_origin[i]);
            year_total_cost_analog[i] = count*(year_renew_analog[i]+analog_lamp_count*lamps_per_year_analog*year_lamp_cost_analog[i]);

            total_year_total_cost_origin += year_total_cost_origin[i];
            total_year_total_cost_analog += year_total_cost_analog[i];

            console.log(total_year_total_cost_origin);
            console.log(total_year_total_cost_analog);

            result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за '+parseInt(i)+' год</td><td>'+year_total_cost_origin[i].toFixed(0)+'</td><td>'+year_total_cost_analog[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за период</td><td>'+total_year_total_cost_origin.toFixed(0)+'</td><td>'+total_year_total_cost_analog.toFixed(0)+'</td></tr>';

        year_energy_price_origin = [];
        year_energy_price_analog = [];

        year_energy_price_origin[0] = 0;
        year_energy_price_analog[0] = 0;

        year_energy_price_origin[1] = q;
        year_energy_price_analog[1] = q;

        result = result+'<tr><td>Тариф за электроэнергию с учетом инфляции за 1 год</td><td>'+year_energy_price_origin[1]+'</td><td>'+year_energy_price_analog[1]+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_energy_price_origin[i] = parseFloat(year_energy_price_origin[i-1]*Kq+year_energy_price_origin[i-1]);
            year_energy_price_analog[i] = parseFloat(year_energy_price_analog[i-1]*Kq+year_energy_price_analog[i-1]);

            result = result+'<tr><td>Тариф за электроэнергию с учетом инфляции за '+parseInt(i)+' год</td><td>'+year_energy_price_origin[i].toFixed(0)+'</td><td>'+year_energy_price_analog[i].toFixed(0)+'</td></tr>';
        }

        var consumed_power_origin = linked_power_origin*ko/100;
        var consumed_power_analog = linked_power_analog*ko/100;

        var consumed_power_per_year_origin = consumed_power_origin*hours_per_year;
        var consumed_power_per_year_analog = consumed_power_analog*hours_per_year;

        var temp_consumed_power_origin = consumed_power_origin;
        var temp_consumed_power_analog = consumed_power_analog;

        result = result+'<tr><td>Общая присоединенная мощность</td><td>'+linked_power_origin.toFixed(0)+'</td><td>'+linked_power_analog.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общая потребляемая мощность</td><td>'+consumed_power_origin.toFixed(2)+'</td><td>'+consumed_power_analog.toFixed(2)+'</td></tr>';
        result = result+'<tr><td>Общее потребление осветительной установки за год</td><td>'+consumed_power_per_year_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_analog.toFixed(0)+'</td></tr>';

        result_new = result_new + '<tr><td>Общая потребляемая мощность, кВт/час</td><td>'+consumed_power_origin.toFixed(2)+'</td><td>'+consumed_power_analog.toFixed(2)+'</td></tr>';
        result_old = result_old + '<tr><td>Общая потребляемая мощность, кВт/час</td><td>'+consumed_power_origin.toFixed(2)+'</td><td>'+consumed_power_analog.toFixed(2)+'</td></tr>';

        result_new = result_new + '<tr><td>Общее потребление осветительной установки за год, кВт/час</td><td>'+consumed_power_per_year_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_analog.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Общее потребление осветительной установки за год, кВт/час</td><td>'+consumed_power_per_year_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_analog.toFixed(0)+'</td></tr>';

        var consumed_power_per_year_price_origin = [];
        var consumed_power_per_year_price_analog = [];

        consumed_power_per_year_price_origin[0] = 0;
        consumed_power_per_year_price_analog[0] = 0;

        consumed_power_per_year_price_origin[1] = consumed_power_per_year_origin*year_energy_price_origin[1];
        consumed_power_per_year_price_analog[1] = consumed_power_per_year_analog*year_energy_price_analog[1];

        var consumed_power_per_year_price_total_origin = consumed_power_per_year_price_origin[1];
        var consumed_power_per_year_price_total_analog = consumed_power_per_year_price_analog[1];

        for(var i = 2; i < H+1; i++) {

            consumed_power_per_year_price_origin[i] = consumed_power_per_year_origin*year_energy_price_origin[i];
            consumed_power_per_year_price_analog[i] = consumed_power_per_year_analog*year_energy_price_analog[i];

            consumed_power_per_year_price_total_origin += consumed_power_per_year_price_origin[i];
            consumed_power_per_year_price_total_analog += consumed_power_per_year_price_analog[i];

            result = result+'<tr><td>Затраты на электроэнергию за '+parseInt(i)+' год</td><td>'+consumed_power_per_year_price_origin[i].toFixed(0)+'</td><td>'+consumed_power_per_year_price_analog[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Общие затраты на электроэнергию</td><td>'+consumed_power_per_year_price_total_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog.toFixed(0)+'</td></tr>';

        result_new = result_new + '<tr><td>Общие затраты на электроэнергию, руб.</td><td>'+consumed_power_per_year_price_total_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Общие затраты на электроэнергию, руб.</td><td>'+consumed_power_per_year_price_total_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog.toFixed(0)+'</td></tr>';
        
        var temp_fg673 = consumed_power_per_year_price_total_origin.toFixed(0);
        var temp_fg674 = consumed_power_per_year_price_total_analog.toFixed(0);

        var consumed_power_per_year_price_total_origin_output = consumed_power_per_year_price_total_origin.toFixed(0);
        var consumed_power_per_year_price_total_analog_output = consumed_power_per_year_price_total_analog.toFixed(0);

        var total_cost_origin = consumed_power_per_year_price_total_origin+total_year_total_cost_origin+total_investment_cost_origin;
        var total_cost_analog = consumed_power_per_year_price_total_analog+total_year_total_cost_analog+total_investment_cost_analog;

        var consumed_power_per_year_price_total_origin_percent = consumed_power_per_year_price_total_origin/total_cost_origin*100;
        var consumed_power_per_year_price_total_analog_percent = consumed_power_per_year_price_total_analog/total_cost_analog*100;

        var total_year_total_cost_origin_percent = total_year_total_cost_origin/total_cost_origin*100;
        var total_year_total_cost_analog_percent = total_year_total_cost_analog/total_cost_analog*100;

        var total_investment_cost_origin_percent = total_investment_cost_origin/total_cost_origin*100;
        var total_investment_cost_analog_percent = total_investment_cost_analog/total_cost_analog*100;

        result = result+'<tr><td>Общая стоимость решения</td><td>'+total_cost_origin.toFixed(0)+'</td><td>'+total_cost_analog.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общие инвестиционные затраты, %</td><td>'+total_investment_cost_origin_percent.toFixed(0)+'</td><td>'+total_investment_cost_analog_percent.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за период, %</td><td>'+total_year_total_cost_origin_percent.toFixed(0)+'</td><td>'+total_year_total_cost_analog_percent.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общие затраты на электроэнергию, %</td><td>'+consumed_power_per_year_price_total_origin_percent.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog_percent.toFixed(0)+'</td></tr>';

        var result_economy_percent_new = 100 - 100*(total_cost_origin/total_cost_analog);

        //УСТАНОВКА НОВОГО

        result = result+'<tr><td colspan="3">Установка нового оборудования</td></tr>';

        var total_cost_origin = [];
        var total_cost_analog = [];

        total_cost_origin[0] = total_investment_cost_origin;
        total_cost_analog[0] = total_investment_cost_analog;

        var total_total_cost_origin = total_cost_origin[0];
        var total_total_cost_analog = total_cost_analog[0];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_origin[0].toFixed(0)+'</td><td>'+total_cost_analog[0].toFixed(0)+'</td></tr>';

        for(var i = 1; i < H+1; i++) {

            total_cost_origin[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i];
            total_cost_analog[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i];

            total_total_cost_origin += total_cost_origin[i];
            total_total_cost_analog += total_cost_analog[i];

            result = result+'<tr><td>Приведенные затраты за '+parseInt(i)+' год</td><td>'+total_cost_origin[i].toFixed(0)+'</td><td>'+total_cost_analog[i].toFixed(0)+'</td></tr>';
            result_new = result_new + '<tr><td>Эксплуатационные расходы за '+parseInt(i)+' год, руб</td><td>'+total_cost_origin[i].toFixed(0)+'</td><td>'+total_cost_analog[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_total_cost_origin.toFixed(0)+'</td><td>'+total_total_cost_analog.toFixed(0)+'</td></tr>';
        
        result_new = result_new + '<tr><td>Общая стоимость решения, руб</td><td>'+total_total_cost_origin.toFixed(0)+'</td><td>'+total_total_cost_analog.toFixed(0)+'</td></tr>';
        //общие эксплуатационные расходы

        var total_exp_charge_origin_new = 0;
        var total_exp_charge_analog_new = 0;

        for(var i = 1; i < H+1; i++) {

            total_exp_charge_origin_new += total_cost_origin[i];
            total_exp_charge_analog_new += total_cost_analog[i];
        }

        result_new = result_new + '<tr><td>Общая стоимость эксплуатации и замены источников света за период, руб.</td><td>'+total_exp_charge_origin_new.toFixed(0)+'</td><td>'+total_exp_charge_analog_new.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Общая стоимость эксплуатации и замены источников света за период, руб.</td><td>'+total_exp_charge_origin_new.toFixed(0)+'</td><td>'+total_exp_charge_analog_new.toFixed(0)+'</td></tr>';

        var temp_afr45n = total_exp_charge_origin_new.toFixed(0);
        var temp_afr46n = total_exp_charge_analog_new.toFixed(0);

        var economy_year = [];
        var total_economy_year = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year[i] = total_cost_analog[i] - total_cost_origin[i];

            total_economy_year += economy_year[i];

            result = result+'<tr><td>Экономия за период '+parseInt(i)+' лет</td><td>'+economy_year[i].toFixed(0)+'</td><td></td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_economy_year.toFixed(0)+'</td><td></td></tr>';

        total_economy_year_output = total_economy_year.toFixed(0);

        var total_cost_summ_origin = [];
        var total_cost_summ_analog = [];

        total_cost_summ_origin[0] = total_investment_cost_origin;
        total_cost_summ_analog[0] = total_investment_cost_analog;

        total_cost_summ_origin[1] = consumed_power_per_year_price_origin[1]+year_total_cost_origin[1]+total_cost_summ_origin[0];
        total_cost_summ_analog[1] = consumed_power_per_year_price_analog[1]+year_total_cost_analog[1]+total_cost_summ_analog[0];

        var total_total_cost_summ_origin = total_cost_summ_origin[1]+total_cost_summ_origin[1];
        var total_total_cost_summ_analog = total_cost_summ_analog[1]+total_cost_summ_analog[1];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_summ_origin[0].toFixed(0)+'</td><td>'+total_cost_summ_analog[0].toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Приведенные затраты за 1 год</td><td>'+total_cost_summ_origin[1].toFixed(0)+'</td><td>'+total_cost_summ_analog[1].toFixed(0)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            total_cost_summ_origin[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i]+total_cost_summ_origin[i-1];
            total_cost_summ_analog[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i]+total_cost_summ_analog[i-1];

            total_total_cost_summ_origin += total_cost_summ_origin[i];
            total_total_cost_summ_analog += total_cost_summ_analog[i];

            result = result+'<tr><td>Приведенные затраты (сумма) за '+parseInt(i)+' год</td><td>'+total_cost_summ_origin[i].toFixed(0)+'</td><td>'+total_cost_summ_analog[i].toFixed(0)+'</td></tr>';
        }

        //result = result+'<tr><td>Итого</td><td>'+total_total_cost_summ_origin.toFixed(0)+'</td><td>'+total_total_cost_summ_analog.toFixed(0)+'</td></tr>';

        var economy_year_summ = [];
        var total_economy_year = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year_summ[i] = total_cost_summ_analog[i] - total_cost_summ_origin[i];

            total_economy_year += economy_year_summ[i];

            result = result+'<tr><td>Экономия за '+parseInt(i)+' год</td><td>'+economy_year_summ[i].toFixed(0)+'</td><td></td></tr>';
        }

        //result = result+'<tr><td>Итого</td><td>'+total_economy_year.toFixed(0)+'</td><td></td></tr>';

        //ЗАМЕНА СТАРОГО

        result = result+'<tr><td colspan="3">Замена старого оборудования</td></tr>';

        var total_cost_origin_2 = [];
        var total_cost_analog_2 = [];

        total_cost_origin_2[0] = total_investment_cost_origin;
        total_cost_analog_2[0] = 0;
        total_cost_origin_2[1] = consumed_power_per_year_price_origin[1]+year_total_cost_origin[1];
        total_cost_analog_2[1] = consumed_power_per_year_price_analog[1]+year_total_cost_analog[1];

        var total_total_cost_origin_2 = total_cost_origin_2[0]+total_cost_origin_2[1];
        var total_total_cost_analog_2 = total_cost_analog_2[0]+total_cost_analog_2[1];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_origin_2[0].toFixed(0)+'</td><td>'+total_cost_analog_2[0].toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Приведенные затраты за 1 год</td><td>'+total_cost_origin_2[1].toFixed(0)+'</td><td>'+total_cost_analog_2[1].toFixed(0)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            total_cost_origin_2[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i];
            total_cost_analog_2[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i];

            total_total_cost_origin_2 += total_cost_origin_2[i];
            total_total_cost_analog_2 += total_cost_analog_2[i];

            result = result+'<tr><td>Приведенные затраты за '+parseInt(i)+' год</td><td>'+total_cost_origin_2[i].toFixed(0)+'</td><td>'+total_cost_analog_2[i].toFixed(0)+'</td></tr>';
            result_old = result_old + '<tr><td>Эксплуатационные расходы за '+parseInt(i)+' год</td><td>'+total_cost_origin_2[i].toFixed(0)+'</td><td>'+total_cost_analog_2[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_total_cost_origin_2.toFixed(0)+'</td><td>'+total_total_cost_analog_2.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Общая стоимость решения</td><td>'+total_total_cost_origin_2.toFixed(0)+'</td><td>'+total_total_cost_analog_2.toFixed(0)+'</td></tr>';

        //общие эксплуатационные расходы

        var total_exp_charge_origin_old = 0;
        var total_exp_charge_analog_old = 0;

        for(var i = 1; i < H+1; i++) {

            total_exp_charge_origin_old += total_cost_origin_2[i];
            total_exp_charge_analog_old += total_cost_analog_2[i];
        }

        var economy_year_2 = [];
        var total_economy_year_2 = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year_2[i] = total_cost_analog_2[i] - total_cost_origin_2[i];

            total_economy_year_2 += economy_year_2[i];

            result = result+'<tr><td>Экономия за период '+parseInt(i)+' лет</td><td>'+economy_year_2[i].toFixed(0)+'</td><td></td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_economy_year_2.toFixed(0)+'</td><td></td></tr>';

        total_economy_year_2_output = total_economy_year_2.toFixed(0);

        var total_cost_summ_origin_2 = [];
        var total_cost_summ_analog_2 = [];

        total_cost_summ_origin_2[0] = total_investment_cost_origin;
        total_cost_summ_analog_2[0] = 0;

        total_cost_summ_origin_2[1] = consumed_power_per_year_price_origin[1]+year_total_cost_origin[1]+total_cost_summ_origin_2[0];
        total_cost_summ_analog_2[1] = consumed_power_per_year_price_analog[1]+year_total_cost_analog[1]+total_cost_summ_analog_2[0];

        var total_total_cost_summ_origin_2 = total_cost_summ_origin_2[0]+total_cost_summ_origin_2[1];
        var total_total_cost_summ_analog_2 = total_cost_summ_analog_2[0]+total_cost_summ_analog_2[1];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_summ_origin_2[0].toFixed(0)+'</td><td>'+total_cost_summ_analog_2[0].toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Приведенные затраты за 1 год</td><td>'+total_cost_summ_origin_2[1].toFixed(0)+'</td><td>'+total_cost_summ_analog_2[1].toFixed(0)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            total_cost_summ_origin_2[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i]+total_cost_summ_origin_2[i-1];
            total_cost_summ_analog_2[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i]+total_cost_summ_analog_2[i-1];

            total_total_cost_summ_origin_2 += total_cost_summ_origin_2[i];
            total_total_cost_summ_analog_2 += total_cost_summ_analog_2[i];

            result = result+'<tr><td>Приведенные затраты (сумма) за '+parseInt(i)+' год</td><td>'+total_cost_summ_origin_2[i].toFixed(0)+'</td><td>'+total_cost_summ_analog_2[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_total_cost_summ_origin_2.toFixed(0)+'</td><td>'+total_total_cost_summ_analog_2.toFixed(0)+'</td></tr>';

        var economy_year_summ_2 = [];
        var total_economy_year_2 = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year_summ_2[i] = total_cost_summ_analog_2[i] - total_cost_summ_origin_2[i];

            total_economy_year_2 += economy_year_summ_2[i];

            result = result+'<tr><td>Экономия за '+parseInt(i)+' год</td><td>'+economy_year_summ_2[i].toFixed(0)+'</td><td></td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_economy_year_2.toFixed(0)+'</td><td></td></tr>';

        var overall_cost_origin = year_total_cost_origin[1]+consumed_power_per_year_price_origin[1];
        var overall_cost_analog = year_total_cost_analog[1]+consumed_power_per_year_price_analog[1];

        result = result+'<tr><td>Капитальные затраты</td><td>'+overall_cost_origin.toFixed(0)+'</td><td>'+overall_cost_analog.toFixed(0)+'</td></tr>';

        var overall_economy = overall_cost_analog-overall_cost_origin;

        result = result+'<tr><td>Экономия капитальных затрат</td><td>'+overall_economy.toFixed(0)+'</td><td></td></tr>';

        var time      = total_investment_cost_origin/overall_economy;
        var time_new  = (total_investment_cost_origin-total_investment_cost_analog)/overall_economy;

        result = result+'<tr><td>Срок окупаемости</td><td>'+time.toFixed(0)+'</td><td></td></tr>';

        result = result+'</table>';

        //$('#result').html(result);

        $('#results').show();

        if($('#switch-calc-2-1').hasClass('active')) {

            $('#result-2-2').show();
        } else {

            $('#result-2-1').show();
        }

        var years = [];

        for(i = 0; i < H+1; i++) {

            years[i] = parseInt(i)+' год';
        }

        var origin_name = $('#origin_name').val();
        var analog_name = $('#analog_name').val();

        $('#chart0-description').show();
        $('#chart1-description').show();
        $('#chart2-description').show();

        var trim_economy_year 			= economy_year;
        var trim_economy_year_summ 		= economy_year_summ;
        var trim_total_cost_summ_origin = total_cost_summ_origin;
        var trim_total_cost_summ_analog = total_cost_summ_analog;

        trim_economy_year.shift();
    	trim_economy_year_summ.shift();
    	trim_total_cost_summ_origin.shift();
    	trim_total_cost_summ_analog.shift();

    	console.log(total_cost_summ_analog);
    	console.log(trim_total_cost_summ_analog);

    	var trim_economy_year_2 		  = economy_year_2;
        var trim_economy_year_summ_2 	  = economy_year_summ_2;
        var trim_total_cost_summ_origin_2 = total_cost_summ_origin_2;
        var trim_total_cost_summ_analog_2 = total_cost_summ_analog_2;

        trim_economy_year_2.shift();
    	trim_economy_year_summ_2.shift();
    	trim_total_cost_summ_origin_2.shift();
    	trim_total_cost_summ_analog_2.shift();

    	var trim_years = years;
    	trim_years = trim_years.shift();

        $(function () {
            $('#chart1').highcharts({
            	lang: {
    		        numericSymbols: null
    		    },
                title: {
                    text: 'Динамика затрат накопительным итогом при установке нового оборудования, руб',
                    x: -20 //center
                },
                xAxis: {
                    categories: years
                },
                yAxis: {
                    title: {
                        text: 'Затраты, руб'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    labels: {
    			        formatter: function () {
    			            return this.value.toFixed(0);
    			        }
    			    }
                },
                tooltip: {
                    valueSuffix: 'руб.',
                    pointFormat: "{point.y:.0f} руб."
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: [{
                    name: 'Экономия за каждый год',
                    data: trim_economy_year,
                    type: 'area',
                    color: '#95CEFF',
                    fillOpacity: 0.6
                }, {
                    name: 'Общая экономия за период '+H+' лет',
                    data: trim_economy_year_summ,
                    type: 'area',
                    color: '#FF0000',
                    fillOpacity: 0.2
                }, {
                    name: origin_name,
                    data: trim_total_cost_summ_origin,
                    color: '#A9FF96'
                }, {
                    name: analog_name,
                    data: trim_total_cost_summ_analog,
                    color: 'orange'
                }]
            });
        });

        $(function () {
            $('#chart2').highcharts({
            	lang: {
    		        numericSymbols: null
    		    },
                title: {
                    text: 'Динамика затрат накопительным итогом при замене старого оборудования, руб',
                    x: -20 //center
                },
                xAxis: {
                    categories: years
                },
                yAxis: {
                    title: {
                        text: 'Затраты, руб'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    labels: {
    			        formatter: function () {
    			            return this.value.toFixed(0);
    			        }
    			    }
                },
                tooltip: {
                    valueSuffix: 'руб.',
                    pointFormat: "{point.y:.0f} руб."
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: [{
                    name: 'Экономия за каждый год',
                    data: trim_economy_year_2,
                    type: 'area',
                    color: '#95CEFF',
                    fillOpacity: 0.6
                }, {
                    name: 'Общая экономия за период '+H+' лет',
                    data: trim_economy_year_summ_2,
                    type: 'area',
                    color: '#FF0000',
                    fillOpacity: 0.2
                }, {
                    name: origin_name,
                    data: trim_total_cost_summ_origin_2,
                    color: '#A9FF96'
                }, {
                    name: analog_name,
                    data: trim_total_cost_summ_analog_2,
                    color: 'orange'
                }]
            });
        });

        var EXP_ORIGIN_0 = total_year_total_cost_originx.toFixed(0);
        var POWER_ORIGIN_0 = consumed_power_per_year_price_total_originx.toFixed(0);
        var INV_ORIGIN_0 = total_investment_cost_originx.toFixed(0);

        var temp_wefsdregr = parseFloat(total_investment_cost_origin)+parseFloat(consumed_power_per_year_price_total_origin_output)+parseFloat(total_year_total_cost_origin);

        $('.result-electricity').text(consumed_power_per_year_price_total_originx.toFixed(0));

        $('.result-profit-year-old').text(Math.ceil(time).toFixed(0));
        $('.result-profit-year-new').text(Math.ceil(time_new).toFixed(0));
        $('.result-economy-summ-new').text(total_economy_year_output);
        $('.result-period-new').text(H);
        $('.result-charge-new').text(temp_wefsdregr.toFixed(0));
        $('.result-electricity-new').text(consumed_power_per_year_price_total_origin_output);

        $('.result-economy-summ-old').text(total_economy_year_2_output);
        $('.result-period-old').text(H);
        $('.result-charge-old').text(temp_wefsdregr.toFixed(0));
        $('.result-electricity-old').text(consumed_power_per_year_price_total_origin_output);

        $('.result-period').text(H);

        var result_economy_percent_old = 100 - 100*(total_total_cost_origin/total_total_cost_analog_2);

        $('#lamp-count').text(H);

        $('.result-economy-percent-old').text(result_economy_percent_old.toFixed(0));
        $('.result-economy-percent-new').text(result_economy_percent_new.toFixed(0));

        if(result_economy_percent_old > 0) {

            if(time < 0) {

                $('.plus-result-old').hide();
            }
            else {

                $('.minus-result-old').hide();
                $('.not-efficient-old').hide();
            }

            $('.result-economy-block-old').html('Экономия до <span>'+result_economy_percent_old.toFixed(0)+'%</span>');
        }
        else {

            $('.result-economy-block-old').html('Экономии нет');

            $('.result-old-economy-hide').hide();
            $('.plus-result-old').hide();
            $('.minus-result-old').hide();
        }

        if(result_economy_percent_new > 0) {

            if(time_new < 0) {

                $('.plus-result-new').hide();
            }
            else {

                $('.minus-result-new').hide();
                $('.not-efficient-new').hide();
            }

            $('.result-economy-block-new').html('Экономия до <span>'+result_economy_percent_new.toFixed(0)+'%</span>');
        }
        else {

            $('.result-economy-block-new').html('Экономии нет');

            $('.result-new-economy-hide').hide();

            $('.plus-result-new').hide();
            $('.minus-result-new').hide();
        }

        if(time_new > 0) {

            $('.result-year-block-new').html('Период окупаемости <span>'+Math.ceil(time_new)+'</span> года/лет');
        } else {

            if(result_economy_percent_new > 0) {

                $('.result-year-block-new').html('Проект на '+$('.current-modification-name').text()+' выгоднее');
            }
            else {

                $('.result-year-block-new').html('Проект на '+$('.current-modification-name').text()+' не выгоден');
            }
        }

        if(time > 0) {

            $('.result-year-block-old').html('Период окупаемости <span>'+Math.ceil(time)+'</span> года/лет');
        } else {

            if(result_economy_percent_old > 0) {

                $('.result-year-block-old').html('Проект на '+$('.current-modification-name').text()+' выгоднее');
            }
            else {

                $('.result-year-block-old').html('Проект на '+$('.current-modification-name').text()+' не выгоден');
            }
        }

        var temp943tg = parseFloat(total_investment_cost_originx+consumed_power_per_year_price_total_originx+total_year_total_cost_originx);

        $('#result-2-2 .result-charge').text(temp943tg.toFixed(0));

        //УСТАНОВКА НОВОГО ОБОРУДОВАНИЯ
        $('#chart0').highcharts({
        	lang: {
    		    numericSymbols: null
    		},
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Сравнение затрат, руб'
            },
            xAxis: {
                categories: [origin_name, analog_name],
                
                formatter: function() {
                    return this.value;
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                },
                title: {
                    text: 'Затраты, руб'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function() {

                        return '';
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y.toFixed(0) + '<br/>' +
                        'Всего: ' + this.point.stackTotal.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    reversed: true,
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        formatter: function() {

                            var label = parseFloat(this.y);

                            return '';
                        }
                    }
                }
            },
            series: [{
                name: 'Общие затраты на эксплуатацию, руб',
                data: [parseFloat(total_year_total_cost_origin), parseFloat(total_year_total_cost_analog)],
                color: '#A9FF96'
            }, {
                name: 'Общие затраты на электроэнергию, руб',
                data: [parseFloat(consumed_power_per_year_price_total_origin_output), parseFloat(consumed_power_per_year_price_total_analog_output)],
                color: '#95CEFF'
            }, {
                name: 'Общие инвестиционные затраты (покупка оборудования), руб',
                data: [parseFloat(total_investment_cost_origin), parseFloat(total_investment_cost_analog)],
                color: '#5C5C61'
            }]
        });

        var result_new_table2 = '<tr><td>Общие инвестиционные затраты светильника, руб</td><td>'+temp43r5b+'</td><td></td></tr><tr><td>Общие затраты на электроэнергию светильника, руб</td><td>'+temp_fg673+'</td><td></td></tr><tr><td>Общие затраты на эксплуатацию светильника, руб</td><td>'+total_year_total_cost_origin.toFixed(0)+'</td><td></td></tr><tr><td>Общие инвестиционные затраты аналога, руб</td><td>'+temp43r6b+'</td><td></td></tr><tr><td>Общие затраты на электроэнергию аналога, руб</td><td>'+temp_fg674+'</td><td></td></tr><tr><td>Общие затраты на эксплуатацию аналога, руб</td><td>'+total_year_total_cost_analog.toFixed(0)+'</td><td></td></tr>';

        //ЗАМЕНА СТАРОГО ОБОРУДОВАНИЯ
        $('#chart01').highcharts({
        	lang: {
    	        numericSymbols: null
    	    },
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Сравнение затрат, руб'
            },
            xAxis: {
                categories: [origin_name, analog_name],
               
                formatter: function() {
                    return this.value;
                }
            },
            yAxis: {
                min: 0,
                formatter: function() {
                    return this.value;
                },
                title: {
                    text: 'Затраты, руб'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                },
                stackLabels: {
                    reversed: true,
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function() {

                        return '';
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y.toFixed(0) + '<br/>' +
                        'Всего: ' + this.point.stackTotal.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        formatter: function() {

                            var label = parseFloat(this.y);

                            return '';
                        }
                    }
                }
            },
            series: [{
                name: 'Общие затраты на эксплуатацию, руб',
                data: [parseFloat(total_year_total_cost_origin), parseFloat(total_year_total_cost_analog)],
                color: '#A9FF96'
            }, {
                name: 'Общие затраты на электроэнергию, руб',
                data: [parseFloat(consumed_power_per_year_price_total_origin_output), parseFloat(consumed_power_per_year_price_total_analog_output)],
                color: '#95CEFF'
            }, {
                name: 'Общие инвестиционные затраты (покупка оборудования), руб',
                data: [parseFloat(total_investment_cost_origin), 0],
                color: '#5C5C61'
            }]
        });

        var result_old_table2 = '<tr><td>Общие инвестиционные затраты светильника, руб</td><td>'+temp43r5b+'</td><td></td></tr><tr><td>Общие затраты на электроэнергию светильника, руб</td><td>'+temp_fg673+'</td><td></td></tr><tr><td>Общие затраты на эксплуатацию светильника, руб</td><td>'+total_year_total_cost_origin.toFixed(0)+'</td><td></td></tr><tr><td>Общие инвестиционные затраты аналога, руб</td><td> - </td><td></td></tr><tr><td>Общие затраты на электроэнергию аналога, руб</td><td>'+temp_fg674+'</td><td></td></tr><tr><td>Общие затраты на эксплуатацию аналога, руб</td><td>'+total_year_total_cost_analog.toFixed(0)+'</td><td></td></tr>';

        $('#chart3').highcharts({
            chart: {
                type: 'bar',
                lang: {
                    numericSymbols: null
                }
            },
            title: {
                text: 'Сравнение затрат, руб'
            },
            xAxis: {
                categories: [origin_name],
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                },
                title: {
                    text: 'Затраты, руб.'
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function() {

                        return '';
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y.toFixed(0) + '<br/>' +
                        'Всего: ' + this.point.stackTotal.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    reversed: true,
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        formatter: function() {

                            var label = parseFloat(this.y);

                            return  '';
                        }
                    }
                }
            },
            series: [{
                name: 'Общие затраты на эксплуатацию, руб',
                data: [parseFloat(total_year_total_cost_originx)],
                color: '#A9FF96'
            }, {
                name: 'Общие затраты на электроэнергию, руб',
                data: [parseFloat(consumed_power_per_year_price_total_originx)],
                color: '#95CEFF'
            }, {
                name: 'Общие инвестиционные затраты (покупка оборудования), руб',
                data: [parseFloat(total_investment_cost_originx)],
                color: '#5C5C61'
            }]
        });

        result_new_html = '<table class="product-specs-info" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_new;
        result_old_html = '<table class="product-specs-info" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_old;
        result_new_pdf = '<table class="product-specs-info pdf pdf-body-table" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_new;
        result_old_pdf = '<table class="product-specs-info pdf pdf-body-table" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_old;
        result_new_html = result_new_html + '</table>';
        result_old_html = result_old_html + '</table>';

        $('.result-hidden-new').html(result_new_html);
        $('.result-hidden-old').html(result_old_html);

        var data_x = {'ORIGINAL_COUNT' : N,
                    'ORIGIN_CAPACITY_CONSUMED' : temp_consumed_power_origin.toFixed(2),
                    'ANALOG_CAPACITY_CONSUMED' : temp_consumed_power_analog.toFixed(2),
                    'ANALOG_PRICE' : analog_price,
                    'ANALOG_COUNT' : $('#count_analog_2').text(),
                    'ANALOG_NAME' : analog_name,
                    'ECONOMIC_H' : H,
                    'ECONOMIC_Q' : q,
                    'ECONOMIC_KQ' : Kq,
                    'ECONOMIC_T' : t,
                    'ECONOMIC_D' : d,
                    'ECONOMIC_KO' : ko,
                    'ECONOMIC_PN' : pn,
                    'ROOM_A' : a,
                    'ROOM_B' : b,
                    'ROOM_H' : h,
                    'ROOM_H1' : h1,
                    'ROOM_E' : e.toFixed(0),
                    'PROFIT_YEAR_NEW' : Math.ceil(time_new),
                    'PROFIT_YEAR_OLD' : Math.ceil(time),
                    'RESULT_ECONOMY_SUMM_NEW' : total_economy_year_output,
                    'RESULT_ECONOMY_SUMM_OLD' : total_economy_year_2_output,
                    'RESULT_CHARGE' : temp943tg.toFixed(0),
                    'RESULT_CHARGE_2' : temp_wefsdregr.toFixed(0),
                    'RESULT_ELECTRICITY' : temp_fg673,
                    'POWER_ORIGIN_0' : POWER_ORIGIN_0,
                    'EXP_ORIGIN_0' : EXP_ORIGIN_0,
                    'INV_ORIGIN_0' : INV_ORIGIN_0,
                    'RESULT_NEW': result_new_pdf,
                    'RESULT_OLD': result_old_pdf,
                    'RESULT_ECONOMY_PERCENT_OLD': result_economy_percent_old,
                    'RESULT_ECONOMY_PERCENT_NEW': result_economy_percent_new,
                    'NEW_TABLE2': result_new_table2,
                    'OLD_TABLE2': result_old_table2
                };

        $('#q1').html(result);

        $('#pdf-2').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');

        $.post("/ru-production/generate.php?type=calc2&element="+$('#original_element_id').val(), {
            data: JSON.stringify(data_x),
            dataType: 'json'
        });
    }, 4000);
}

function calc3() {

    $('#result-3').after('<img class="calc-3-preloader" src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 20px auto;">');

    setTimeout(function() {

        $('.calc-3-preloader').remove();

        var lamp_count = parseInt($('#lamp_count').val());
        var nds        = parseFloat($('#nds').val());
        var price      = parseFloat($('#original_price_2').val());

        var lamp_name    = String($('#lamp_name').val());

        var length_netto    = String($('#length_netto').val());
        var width_netto     = String($('#width_netto').val()); 
        var height_netto    = String($('#height_netto').val());
        var weight_netto    = String($('#weight_netto').val()); 
        var length_brutto   = String($('#length_brutto').val());
        var width_brutto    = String($('#width_brutto').val()); 
        var height_brutto   = String($('#height_brutto').val());
        var weight_brutto   = String($('#weight_brutto').val());
        var lamp_quantity   = String($('#lamp_quantity').val());

        length_netto    = length_netto.split(",").join(".");
        width_netto     = width_netto.split(",").join(".");
        height_netto    = height_netto.split(",").join(".");
        weight_netto    = weight_netto.split(",").join(".");
        length_brutto   = length_brutto.split(",").join(".");
        width_brutto    = width_brutto.split(",").join(".");
        height_brutto   = height_brutto.split(",").join(".");
        weight_brutto   = weight_brutto.split(",").join(".");
        lamp_quantity   = lamp_quantity.split(",").join(".");

        length_netto    = parseFloat(length_netto);
        width_netto     = parseFloat(width_netto);
        height_netto    = parseFloat(height_netto);
        weight_netto    = parseFloat(weight_netto);
        length_brutto   = parseFloat(length_brutto);
        width_brutto    = parseFloat(width_brutto);
        height_brutto   = parseFloat(height_brutto);
        weight_brutto   = parseFloat(weight_brutto);
        lamp_quantity   = parseFloat(lamp_quantity);

        var packs      = Math.ceil(lamp_count/lamp_quantity);

        window.price_all       = (lamp_count*price)/((100+nds)/100);
        window.price_with_nds  = lamp_count*price;
        
        window.volume          = packs*length_brutto*width_brutto*height_brutto;
        window.weight          = packs*weight_brutto;

        var nds_all = window.price_with_nds - window.price_all;

        $('.accesorie-full-weight.first').text(packs*weight_brutto);
        $('.accesorie-full-volume.first').text(packs*length_brutto*width_brutto*height_brutto);
        $('.accesorie-price-without-nds.first').text((lamp_count*price)/((100+nds)/100));
        $('.accesorie-nds.first').text(lamp_count*price*nds/100);
        $('.accesorie-full-price.first').text(lamp_count*price);

        var table = '<br><br><table class="calc-3-table"><tr><td rowspan="2">Наименование</td><td rowspan="2">Масса брутто, кг</td><td rowspan="2">Объем, м3</td><td rowspan="2">Сумма без учета НДС, руб. коп.<td colspan="2">НДС</td><td rowspan="2">Сумма с учетом НДС, руб. коп.</td></tr><tr><td>Ставка, %</td><td>Сумма, руб. коп.</td></tr><tr><td>'+lamp_name+'</td><td>'+(packs*weight_brutto).toFixed(3)+'</td><td>'+(packs*length_brutto*width_brutto*height_brutto).toFixed(3)+'</td><td>'+((lamp_count*price)/((100+nds)/100)).toFixed(2)+'</td><td>18</td><td>'+(lamp_count*price*nds/100).toFixed(2)+'</td><td>'+(lamp_count*price).toFixed(2)+'</td></tr>';

        var i = 1;
        var data = {};

        data['d0'] = lamp_count;

        $('.accessory').each(function() {

            var count_acc = parseFloat($(this).find('.accessory_count').val());
            var price_acc = parseFloat($(this).find('.accessory_price').val());

            if((count_acc == '') || isNaN(count_acc) || (typeof(count_acc) == 'undefined') || (count_acc <= 0)) { } else {

            	var id = $(this).find('.accessory_id').val().toString();

	            data[''+id+''] = count_acc;

	            i += 1;

	            console.log(count_acc);

	            var name    = $(this).find('.accessory_name').val();

	            var length_netto    = $(this).find('.accessory_length_netto').val();
	            var width_netto     = $(this).find('.accessory_width_netto').val(); 
	            var height_netto    = $(this).find('.accessory_height_netto').val();
	            var weight_netto    = $(this).find('.accessory_weight_netto').val(); 
	            var length_brutto   = $(this).find('.accessory_length_brutto').val();
	            var width_brutto    = $(this).find('.accessory_width_brutto').val(); 
	            var height_brutto   = $(this).find('.accessory_height_brutto').val();
	            var weight_brutto   = $(this).find('.accessory_weight_brutto').val();
	            var lamp_quantity   = $(this).find('.accessory_quantity').val();
	        
	            length_netto    = parseFloat(length_netto);
	            width_netto     = parseFloat(width_netto);
	            height_netto    = parseFloat(height_netto);
	            weight_netto    = parseFloat(weight_netto);
	            length_brutto   = parseFloat(length_brutto);
	            width_brutto    = parseFloat(width_brutto);
	            height_brutto   = parseFloat(height_brutto);
	            weight_brutto   = parseFloat(weight_brutto);
	            lamp_quantity   = parseFloat(lamp_quantity);

	            var packs      = Math.ceil(count_acc/lamp_quantity);

	            var price_all      = (count_acc*price_acc)/((100+nds)/100);
	            var price_with_nds = count_acc*price_acc;
	            var volume         = packs*length_brutto*width_brutto*height_brutto;
	            var weight         = packs*weight_brutto;
	            var nds_all        = price_with_nds - price_all;

	            window.price_all      += price_all;
	            window.price_with_nds += price_with_nds;
	            window.volume         += volume;
	            window.weight         += weight;

	            $(this).find('.accesorie-full-weight').text(packs*weight_brutto);
	            $(this).find('.accesorie-full-volume').text(packs*length_brutto*width_brutto*height_brutto);
	            $(this).find('.accesorie-price-without-nds').text((count_acc*price_acc)/((100+nds)/100));
	            $(this).find('.accesorie-nds').text(count_acc*price_acc*nds/100);
	            $(this).find('.accesorie-full-price').text(count_acc*price_acc);

	            table = table + '<tr><td>'+name+'</td><td>'+(packs*weight_brutto).toFixed(3)+'</td><td>'+(packs*length_brutto*width_brutto*height_brutto).toFixed(3)+'</td><td>'+((count_acc*price_acc)/((100+nds)/100)).toFixed(2)+'</td><td>18</td><td>'+(count_acc*price_acc*nds/100).toFixed(2)+'</td><td>'+(count_acc*price_acc).toFixed(2)+'</td></tr>';
	        }
        });

        table = table + "<tr><td></td><td>"+window.weight.toFixed(3)+"</td><td>"+window.volume.toFixed(3)+"</td><td>"+window.price_all.toFixed(2)+"</td><td></td><td>"+nds_all.toFixed(2)+"</td><td>"+window.price_with_nds.toFixed(2)+"</td></tr></table>";

        console.log(data);

        var nds_all         = window.price_with_nds - window.price_all;

        $('#pdf-3').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
        $('#pdf-32').removeClass('download-2');

        $.post("/ru-production/generate2.php?element="+$('#original_element_id').val(), {
            data: JSON.stringify(data),
            dataType: 'json'
        });

        $('#result-3').html(table);
    }, 4000);
}

function calc10() {
    var e       = $('#e1').val();
    var count   = $('#count1').val();
    var a       = $('#a1').val();
    var b       = $('#b1').val();
    var h       = $('#h1').val();
    var h1      = $('#h11').val();
    var h2      = $('#h21').val();
    var k       = $('#k1').val();
    var z       = $('#z1').val();
    var f       = $('#f1').val();

    var origin_lamp_count = $('#original_lamp_count').val();

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    var ki006 = parseFloat($('#ki0061').val());
    var ki008 = parseFloat($('#ki0081').val());
    var ki010 = parseFloat($('#ki0101').val());
    var ki125 = parseFloat($('#ki1251').val());
    var ki150 = parseFloat($('#ki1501').val());
    var ki200 = parseFloat($('#ki2001').val());
    var ki250 = parseFloat($('#ki2501').val());
    var ki300 = parseFloat($('#ki3001').val());
    var ki400 = parseFloat($('#ki4001').val());
    var ki500 = parseFloat($('#ki5001').val());

    //Вывод сообщении о незаполненом поле
    var messageError = [  ];

    if(e > 0)  {
    }else{
        messageError.push("Не заполнено поле Требуемое освещение\n");
    }
    
    if(count > 0)  {
    }else{
        messageError.push("Не заполнено поле Количество светильников\n");
    }
    
    if(a > 0)  {
    }else{
        messageError.push("Не заполнено поле Длина\n");
    }
    
    if(b > 0)  {
    }else{
        messageError.push("Не заполнено поле Ширина\n");
    }
    
    if(h > 0)  {
    }else{
        messageError.push("Не заполнено поле Высота\n");
    }
    
    if(k > 0)  {
    }else{
        messageError.push("Не заполнено поле Коэффициент неравномерности освещения\n");
    }
    
    if(z > 0)  {
    }else{
        messageError.push("Не заполнено поле Коэффициент запаса\n");
    }
    
    if(f > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (Световой поток)\n");
    }
    
    if(origin_lamp_count > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (Количество ламп)\n");
    }

    if(ki006 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI06'])\n");
    }
    if(ki008 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI08'])\n");
    }
    if(ki010 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI1'])\n");
    }
    if(ki125 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI125'])\n");
    }
    if(ki150 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI15'])\n");
    }
    if(ki200 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI2'])\n");
    }
    if(ki250 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI25'])\n");
    }
    if(ki300 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI3'])\n");
    }
    if(ki400 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI4'] )\n");
    }
    if(ki500 > 0)  {
    }else{
        messageError.push("Не хватает данных о товаре (['KI5'])\n");
    }
    
    if(messageError.length > 0)
    {
        alert(messageError);
    }
    //end Вывод сообщении о незаполненом поле

    if(h2 < 0)  {
        h2 = 0.8;
        $('#h21').val('0.8');
    }

    if(isNaN(h2))  {
        h2 = 0;
        $('#h21').val('0');
    }

    var hp = h-h1-h2;

    if(hp <= 0) {
        $('.result-1').text('Высота комнаты должна быть больше высоты подвеса лампы и рабочей поверхности.');
        return false;
    }

    var nn = (a*b)/(hp*(a+b));

    var nnout = 0;

    if(nn < 0.7) {
        nnout = ki006;
    }
    else if(nn < 0.9) {
        nnout = ki008;
    }
    else if(nn < 1.125) {
        nnout = ki010;
    }
    else if(nn < 1.375) {
        nnout = ki125;
    }
    else if(nn < 1.75) {
        nnout = ki150;
    }
    else if(nn < 2.25) {
        nnout = ki200;
    }
    else if(nn < 2.75) {
        nnout = ki250;
    }
    else if(nn < 3.5) {
        nnout = ki300;
    }
    else if(nn < 4.5) {
        nnout = ki400;
    }
    else {
        nnout = ki500;
    }

    if($('#switch-2').attr("checked") == 'checked') {

        var count = (e*a*b*k*z*100)/(f*nnout*origin_lamp_count);

        var e_average = Math.ceil(count)*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        if(isNaN(count)) {

            $('.result-1').text('Проверьте введенные данные');
        }
        else {

            $('.result-1').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('#a').val(a);
                $('#b').val(b);
                $('#h').val(h);
                $('#N').val(Math.ceil(count));

                $('#lamp_count').val(Math.ceil(count));

                $('.result-1').html('Количество светильников <span>'+Math.ceil(count)+' шт</span>, при минимальной средней освещенности <span>'+Math.floor(e_average)+' лк</span>');
                //$('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('#pdf-1').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }  
    }
    else
    {
        var e = count*(f*nnout*origin_lamp_count)/(a*b*k*z*100);

        if(isNaN(count)) {

            $('.result-1').text('Проверьте введенные данные');
        }
        else {

            $('.result-1').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('#a').val(a);
                $('#b').val(b);
                $('#h').val(h);
                $('#N').val(count);

                $('#lamp_count').val(count);

                $('.result-1').html('Минимальная средняя освещенность <span>'+Math.floor(e)+' лк</span>');
                //$('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('#pdf-1').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }
    }

    var f = parseFloat($('#analog_light_flow').val());

    var analog_ki006 = parseFloat($('#analog_ki006').val());
    var analog_ki008 = parseFloat($('#analog_ki008').val());
    var analog_ki010 = parseFloat($('#analog_ki010').val());
    var analog_ki125 = parseFloat($('#analog_ki125').val());
    var analog_ki150 = parseFloat($('#analog_ki150').val());
    var analog_ki200 = parseFloat($('#analog_ki200').val());
    var analog_ki250 = parseFloat($('#analog_ki250').val());
    var analog_ki300 = parseFloat($('#analog_ki300').val());
    var analog_ki400 = parseFloat($('#analog_ki400').val());
    var analog_ki500 = parseFloat($('#analog_ki500').val());

    var nnout = 0;

    if(nn < 0.7) {
        nnout = analog_ki006;
    }
    else if(nn < 0.9) {
        nnout = analog_ki008;
    }
    else if(nn < 1.125) {
        nnout = analog_ki010;
    }
    else if(nn < 1.375) {
        nnout = analog_ki125;
    }
    else if(nn < 1.75) {
        nnout = analog_ki150;
    }
    else if(nn < 2.25) {
        nnout = analog_ki200;
    }
    else if(nn < 2.75) {
        nnout = analog_ki250;
    }
    else if(nn < 3.5) {
        nnout = analog_ki300;
    }
    else if(nn < 4.5) {
        nnout = analog_ki400;
    }
    else {
        nnout = analog_ki500;
    }

    var count_analog = Math.ceil((e*a*b*k*z*100)/(f*nnout));

    $('#count_analog').val(count_analog);
    $('#ex').text(e.toFixed(0));
    $('#count_analog_2').text(count_analog);
}

function calc_onload() {

    console.log('Стартовый калькулятора при загрузке страницы');

    var e       = $('#e1').val();
    var count   = $('#count1').val();
    var a       = $('#a1').val();
    var b       = $('#b1').val();
    var h       = $('#h1').val();
    var h1      = $('#h11').val();
    var h2      = $('#h21').val();
    var k       = $('#k1').val();
    var z       = $('#z1').val();
    var f       = $('#f1').val();

    var origin_lamp_count = $('#origin_lamp_count').val();

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    var ki006 = parseFloat($('#ki0061').val());
    var ki008 = parseFloat($('#ki0081').val());
    var ki010 = parseFloat($('#ki0101').val());
    var ki125 = parseFloat($('#ki1251').val());
    var ki150 = parseFloat($('#ki1501').val());
    var ki200 = parseFloat($('#ki2001').val());
    var ki250 = parseFloat($('#ki2501').val());
    var ki300 = parseFloat($('#ki3001').val());
    var ki400 = parseFloat($('#ki4001').val());
    var ki500 = parseFloat($('#ki5001').val());

    if(h2 < 0)  {
        h2 = 0.8;
        $('#h21').val('0.8');
    }

    if(isNaN(h2))  {
        h2 = 0;
        $('#h21').val('0');
    }

    var hp = h-h1-h2;

    if(hp <= 0) {
        return false;
    }

    var nn = (a*b)/(hp*(a+b));

    var nnout = 0;

    if(nn < 0.7) {
        nnout = ki006;
    }
    else if(nn < 0.9) {
        nnout = ki008;
    }
    else if(nn < 1.125) {
        nnout = ki010;
    }
    else if(nn < 1.375) {
        nnout = ki125;
    }
    else if(nn < 1.75) {
        nnout = ki150;
    }
    else if(nn < 2.25) {
        nnout = ki200;
    }
    else if(nn < 2.75) {
        nnout = ki250;
    }
    else if(nn < 3.5) {
        nnout = ki300;
    }
    else if(nn < 4.5) {
        nnout = ki400;
    }
    else {
        nnout = ki500;
    }

    if($('#switch-2').attr("checked") == 'checked') {

        var count = (e*a*b*k*z*100)/(f*nnout*origin_lamp_count);

        console.log(count);

        console.log(Math.ceil(count));

        var e_average = Math.ceil(count)*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        if(isNaN(count)) {

            console.log('Неверные данные');
        }
        else {

            $('#a').val(a);
            $('#b').val(b);
            $('#h').val(h);
            $('#N').val(Math.ceil(count));
        }  
    }
    else {

        var e = count*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        if(isNaN(count)) {

            console.log('Неверные данные');
        }
        else {

            $('#a').val(a);
            $('#b').val(b);
            $('#h').val(h);
            $('#N').val(count);
        }
    }

    var f = parseFloat($('#analog_light_flow').val());

    var analog_lamp_count = $('#analog_lamp_count').val();

    var analog_ki006 = parseFloat($('#analog_ki006').val());
    var analog_ki008 = parseFloat($('#analog_ki008').val());
    var analog_ki010 = parseFloat($('#analog_ki010').val());
    var analog_ki125 = parseFloat($('#analog_ki125').val());
    var analog_ki150 = parseFloat($('#analog_ki150').val());
    var analog_ki200 = parseFloat($('#analog_ki200').val());
    var analog_ki250 = parseFloat($('#analog_ki250').val());
    var analog_ki300 = parseFloat($('#analog_ki300').val());
    var analog_ki400 = parseFloat($('#analog_ki400').val());
    var analog_ki500 = parseFloat($('#analog_ki500').val());

    var nnout = 0;

    if(nn < 0.7) {
        nnout = analog_ki006;
    }
    else if(nn < 0.9) {
        nnout = analog_ki008;
    }
    else if(nn < 1.125) {
        nnout = analog_ki010;
    }
    else if(nn < 1.375) {
        nnout = analog_ki125;
    }
    else if(nn < 1.75) {
        nnout = analog_ki150;
    }
    else if(nn < 2.25) {
        nnout = analog_ki200;
    }
    else if(nn < 2.75) {
        nnout = analog_ki250;
    }
    else if(nn < 3.5) {
        nnout = analog_ki300;
    }
    else if(nn < 4.5) {
        nnout = analog_ki400;
    }
    else {
        nnout = analog_ki500;
    }

    var count_analog = Math.ceil((e*a*b*k*z*100)/(f*nnout*analog_lamp_count));

    $('#lamp_count').val(count);

    $('#count_analog').val(count_analog);
    $('#ex').text(e.toFixed(0));
    $('#count_analog_2').text(count_analog);
}

function print_calculator_1(link) {

    var e       = $('#e1').val();
    var count   = $('#count1').val();
    var a       = $('#a1').val();
    var b       = $('#b1').val();
    var h       = $('#h1').val();
    var h1      = $('#h11').val();
    var h2      = $('#h21').val();
    var k       = $('#k1').val();
    var z       = $('#z1').val();
    var f       = $('#f1').val();

    var origin_lamp_count = $('#origin_lamp_count').val();

    var id      = $(link).attr('data-mod');

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    if($('#switch-2').attr("checked") == 'checked') { 

        var switched = 1;
    }
    else {

        var switched = 0;
    }

    downloadPDF('/ru-production/print.php?calculator_1='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'&switch='+switched+'&origin_lamp_count='+origin_lamp_count);
}

function print_calculator_1x(link) {

    var e       = $('#e').val();
    var count   = $('#count').val();
    var a       = $('#a').val();
    var b       = $('#b').val();
    var h       = $('#h').val();
    var h1      = $('#h1').val();
    var h2      = $('#h2').val();
    var k       = $('#k').val();
    var z       = $('#z').val();
    var f       = $('#f').val();

    var origin_lamp_count = $('#origin_lamp_count').val();

    var id      = $(link).attr('data-mod');

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    if($('#switch-2').attr("checked") == 'checked') { 

        var switched = 1;
    }
    else {

        var switched = 0;
    }

    downloadPDF('/ru-production/print.php?calculator_1='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'&switch='+switched+'&origin_lamp_count='+origin_lamp_count);
}

function print_calculator_2(link) { 

    var id = $(link).attr('data-mod');

    if($('#switch-calc-2-1').hasClass('active')) {

        var switched = 0;
    }
    else {

        var switched = 1;
    }

    downloadPDF('/ru-production/print.php?calculator_2='+id+'&switched='+switched);
}

function print_calculator_3(link) { 

    var id = $(link).attr('data-mod');

    $('#file-to-send').val('/ru-production/pdf/calc-3-'+$('#current-modification-code').val()+'.pdf');

    downloadPDF('/ru-production/print.php?calculator_3='+id);
}

function downloadPDF_en(link) {

    //document.getElementById('preloader').style.display = 'block';

    $.ajax({
        type: "GET",
        url: link+'&en=true',
    }).done(function(data) {

        data = data.replace(/\\\//g, '/');
        data = data.replace(/"/g, '');
        window.open(data);
    });

    //document.getElementById('preloader').style.display = 'none';

    return false;
}

function calc1_en() {

    var e       = $('#e').val();
    var count   = $('#count').val();
    var a       = $('#a').val();
    var b       = $('#b').val();
    var h       = $('#h').val();
    var h1      = $('#h1').val();
    var h2      = $('#h2').val();
    var k       = $('#k').val();
    var z       = $('#z').val();
    var f       = $('#f').val();
    var origin_lamp_count = $('#origin_lamp_count').val();

    var id      = $('#id').val();

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    var ki006 = parseFloat($('#ki006').val());
    var ki008 = parseFloat($('#ki008').val());
    var ki010 = parseFloat($('#ki010').val());
    var ki125 = parseFloat($('#ki125').val());
    var ki150 = parseFloat($('#ki150').val());
    var ki200 = parseFloat($('#ki200').val());
    var ki250 = parseFloat($('#ki250').val());
    var ki300 = parseFloat($('#ki300').val());
    var ki400 = parseFloat($('#ki400').val());
    var ki500 = parseFloat($('#ki500').val());

    if(h2 < 0)  {

        h2 = 0.8;
        $('#h2').val('0.8');
    }

    if(isNaN(h2))  {

        h2 = 0;
        $('#h2').val('0');
    }

    var hp = h-h1-h2;

    if(hp <= 0) {

        $('.result').text('Summ of work area height and lamp suspensions height might be less than room height.');

        return false;
    }

    var nn = (a*b)/(hp*(a+b));

    var nnout = 0;

    if(nn < 0.7) {

        nnout = ki006;
    }
    else if(nn < 0.9) {

        nnout = ki008;
    }
    else if(nn < 1.125) {

        nnout = ki010;
    }
    else if(nn < 1.375) {

        nnout = ki125;
    }
    else if(nn < 1.75) {

        nnout = ki150;
    }
    else if(nn < 2.25) {

        nnout = ki200;
    }
    else if(nn < 2.75) {

        nnout = ki250;
    }
    else if(nn < 3.5) {

        nnout = ki300;
    }
    else if(nn < 4.5) {

        nnout = ki400;
    }
    else {

        nnout = ki500;
    }

    if($('#switch-2').attr("checked") == 'checked') {

        var count = (e*a*b*k*z*100)/(f*nnout*origin_lamp_count);

        var e_average = Math.ceil(count)*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        $('#lamp_count').val(count);

        if(isNaN(count)) {

            $('.result').text('Incorrect input data');
        }
        else {

            $('.result').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('.result').html('Quantity of luminaires <span>'+Math.ceil(count)+' pcs</span>, at minimal  average illuminance <span>'+Math.floor(e_average)+' lx</span>');
                $('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('.calc-button.download').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }  
    }
    else {

        var e = count*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        $('#lamp_count').val(count);

        if(isNaN(count)) {

            $('.result').text('Incorrect input data');
        }
        else {

            $('.result').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('.result').html('Minimal  average illuminance  <span>'+Math.floor(e)+' лк</span>');
                $('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('.calc-button.download').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }
    }
}

function calc2_en() { 

    $('#results').after('<img class="calc-2-preloader" src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 20px auto;">');

    setTimeout(function() {

        $('.calc-2-preloader').remove();

        var origin_name = $('.current-modification-name').text();
        var analog_name = $('.current-analog-name').text();

        var a   = parseFloat($('#a').val());
        var b   = parseFloat($('#b').val());
        var h   = parseFloat($('#h').val());
        var k   = parseFloat($('#k1').val());
        var z   = parseFloat($('#z1').val());
        var N   = parseInt($('#N').val());
        var H   = parseInt($('#H').val());
        var q   = parseFloat($('#q').val());
        var Kq  = parseFloat($('#Kq').val())/100;
        var M   = parseFloat($('#M').val());
        var Z   = parseFloat($('#Z').val());
        var pn  = parseFloat($('#pn').val());
        var t   = parseFloat($('#t').val());
        var d   = parseFloat($('#d').val());
        var ko  = parseFloat($('#ko').val());
        var h1  = parseFloat($('#h11').val());
        var h2  = parseFloat($('#h21').val());
        var count  = parseFloat($('#count_analog').val());
        var e      = parseFloat($('#e1').val());
        var f = parseFloat($('#f1').val());

        var origin_price      = parseFloat($('#original_price').val());
        var origin_price_part = parseFloat($('#original_price_part').val());
        var origin_pra_loss   = parseFloat($('#original_pra_loss').val());
        var origin_lamp_count = parseInt($('#original_lamp_count').val());
        var origin_capacity   = parseFloat($('#original_capacity').val());
        var origin_work_time  = parseInt($('#original_work_time').val());

        var analog_price      = parseFloat($('#analog_price').val());
        var analog_price_part = parseFloat($('#analog_price_part').val());
        var analog_pra_loss   = parseFloat($('#analog_pra_loss').val());
        var analog_lamp_count = parseInt($('#analog_lamp_count').val());
        var analog_capacity   = parseFloat($('#analog_capacity').val());
        var analog_work_time  = parseInt($('#analog_work_time').val());

        var ki006 = parseFloat($('#origin_ki006').val());
        var ki008 = parseFloat($('#origin_ki008').val());
        var ki010 = parseFloat($('#origin_ki010').val());
        var ki125 = parseFloat($('#origin_ki125').val());
        var ki150 = parseFloat($('#origin_ki150').val());
        var ki200 = parseFloat($('#origin_ki200').val());
        var ki250 = parseFloat($('#origin_ki250').val());
        var ki300 = parseFloat($('#origin_ki300').val());
        var ki400 = parseFloat($('#origin_ki400').val());
        var ki500 = parseFloat($('#origin_ki500').val());

        var hp = h-h1-h2;

        var nn = (a*b)/(hp*(a+b));

        var nnout = 0;

        if(nn < 0.7) {

            nnout = ki006;
        }
        else if(nn < 0.9) {

            nnout = ki008;
        }
        else if(nn < 1.125) {

            nnout = ki010;
        }
        else if(nn < 1.375) {

            nnout = ki125;
        }
        else if(nn < 1.75) {

            nnout = ki150;
        }
        else if(nn < 2.25) {

            nnout = ki200;
        }
        else if(nn < 2.75) {

            nnout = ki250;
        }
        else if(nn < 3.5) {

            nnout = ki300;
        }
        else if(nn < 4.5) {

            nnout = ki400;
        }
        else {

            nnout = ki500;
        }

        console.log('nnout'+nnout);

        var e = N*(f*nnout*origin_lamp_count)/(a*b*k*z*100);

        var fx = parseFloat($('#analog_light_flow').val());

        var analog_ki006 = parseFloat($('#analog_ki006').val());
        var analog_ki008 = parseFloat($('#analog_ki008').val());
        var analog_ki010 = parseFloat($('#analog_ki010').val());
        var analog_ki125 = parseFloat($('#analog_ki125').val());
        var analog_ki150 = parseFloat($('#analog_ki150').val());
        var analog_ki200 = parseFloat($('#analog_ki200').val());
        var analog_ki250 = parseFloat($('#analog_ki250').val());
        var analog_ki300 = parseFloat($('#analog_ki300').val());
        var analog_ki400 = parseFloat($('#analog_ki400').val());
        var analog_ki500 = parseFloat($('#analog_ki500').val());

        var nnout = 0;

        if(nn < 0.7) {

            nnout = analog_ki006;
        }
        else if(nn < 0.9) {

            nnout = analog_ki008;
        }
        else if(nn < 1.125) {

            nnout = analog_ki010;
        }
        else if(nn < 1.375) {

            nnout = analog_ki125;
        }
        else if(nn < 1.75) {

            nnout = analog_ki150;
        }
        else if(nn < 2.25) {

            nnout = analog_ki200;
        }
        else if(nn < 2.75) {

            nnout = analog_ki250;
        }
        else if(nn < 3.5) {

            nnout = analog_ki300;
        }
        else if(nn < 4.5) {

            nnout = analog_ki400;
        }
        else {

            nnout = analog_ki500;
        }

        var count_analog = Math.ceil((e*a*b*k*z*100)/(fx*nnout));

        $('#count_analog_2').text(count_analog);
        $('#ex').text(e.toFixed(0));

        //расчет для одного светильника

        var Nx = 1;

        var nn_originx = Nx*origin_lamp_count;

        console.log('nn_originx '+nn_originx);

        var hours_per_yearx = t*d;

        var lamps_per_year_originx = hours_per_yearx/origin_work_time;

        var total_capacity_originx = origin_pra_loss*origin_lamp_count*origin_capacity;

        var S = a*b;

        var maximum_capacity_allowed_originx = total_capacity_originx/S;

        var year_lamp_cost_originx = [];

        year_lamp_cost_originx[0] = 0;

        year_lamp_cost_originx[1] = parseInt(origin_price_part);

        for(var i = 2; i < H+1; i++) {

            year_lamp_cost_originx[i] = year_lamp_cost_originx[i-1]*Kq+year_lamp_cost_originx[i-1];
        }

        var linked_power_originx = total_capacity_originx*Nx/1000;

        var total_investment_cost_originx = Nx*(origin_price_part*origin_lamp_count+origin_price+M)+linked_power_origin*pn;

        var year_renew_originx = [];

        year_renew_originx[0] = 0;

        year_renew_originx[1] = parseInt(Z);

        for(var i = 2; i < H+1; i++) {

            year_renew_originx[i] = year_renew_originx[i-1]*Kq+year_renew_originx[i-1];
        }

        year_total_cost_originx = [];

        year_total_cost_originx[0] = 0;

        year_total_cost_originx[1] = parseInt(Nx*Z);

        total_year_total_cost_originx = year_total_cost_originx[0]+year_total_cost_originx[1];

        for(var i = 2; i < H+1; i++) {

            year_total_cost_originx[i] = Nx*(year_renew_originx[i]+origin_lamp_count*lamps_per_year_originx*year_lamp_cost_originx[i]);

            total_year_total_cost_originx += year_total_cost_originx[i]
        }

        year_energy_price_originx = [];

        year_energy_price_originx[0] = 0;

        year_energy_price_originx[1] = q;

        for(var i = 2; i < H+1; i++) {

            year_energy_price_originx[i] = parseFloat(year_energy_price_originx[i-1]*Kq+year_energy_price_originx[i-1]);
        }

        var consumed_power_originx = linked_power_originx*ko/100;
        var consumed_power_per_year_originx = consumed_power_originx*hours_per_yearx;

        var consumed_power_per_year_price_originx = [];

        consumed_power_per_year_price_originx[0] = 0;

        consumed_power_per_year_price_originx[1] = consumed_power_per_year_originx*year_energy_price_originx[1];

        var consumed_power_per_year_price_total_originx = consumed_power_per_year_price_originx[1];

        for(var i = 2; i < H+1; i++) {

            consumed_power_per_year_price_originx[i] = consumed_power_per_year_originx*year_energy_price_originx[i];

            consumed_power_per_year_price_total_originx += consumed_power_per_year_price_originx[i];
        }

        var total_cost_originx = consumed_power_per_year_price_total_originx+total_year_total_cost_originx+total_investment_cost_originx;

        var consumed_power_per_year_price_total_origin_percentx = consumed_power_per_year_price_total_originx/total_cost_originx*100;

        var total_year_total_cost_origin_percentx = total_year_total_cost_originx/total_cost_originx*100;

        var total_investment_cost_origin_percentx = total_investment_cost_originx/total_cost_originx*100;

        var overall_cost_originx = year_total_cost_originx[1]+consumed_power_per_year_price_originx[1];

        //конец расчета для одного светильника

        var count = count_analog;

        console.log('--------');

        console.log(N);
        console.log(count);

        var nn_origin = N*origin_lamp_count;
        var nn_analog = count*analog_lamp_count;

        var hours_per_year = t*d;

        var lamps_per_year_origin = hours_per_year/origin_work_time;
        var lamps_per_year_analog = hours_per_year/analog_work_time;

        var total_capacity_origin = origin_pra_loss*origin_lamp_count*origin_capacity;
        var total_capacity_analog = analog_pra_loss*analog_lamp_count*analog_capacity;

        var S = a*b;

        var maximum_capacity_allowed_origin = total_capacity_origin/S;
        var maximum_capacity_allowed_analog = total_capacity_analog/S;

        result_new = '';
        result_old = '';

        result = '<table style="width: 100%;">';

        var year_lamp_cost_origin = [];
        var year_lamp_cost_analog = [];

        year_lamp_cost_origin[0] = 0;
        year_lamp_cost_analog[0] = 0;

        year_lamp_cost_origin[1] = parseInt(origin_price_part);
        year_lamp_cost_analog[1] = parseInt(analog_price_part);

        result = result+'<tr><td></td><td>Оригинал</td><td>Аналог</td></tr>';
        result = result+'<tr><td>Стоимость источника света с учетом инфляции за 1 год</td><td>'+year_lamp_cost_origin[0]+'</td><td>'+year_lamp_cost_analog[0]+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_lamp_cost_origin[i] = year_lamp_cost_origin[i-1]*Kq+year_lamp_cost_origin[i-1];
            year_lamp_cost_analog[i] = year_lamp_cost_analog[i-1]*Kq+year_lamp_cost_analog[i-1];

            result = result+'<tr><td>Стоимость источника света с учетом инфляции за '+parseInt(i)+' год</td><td>'+year_lamp_cost_origin[i].toFixed(0)+'</td><td>'+year_lamp_cost_analog[i].toFixed(0)+'</td></tr>';
        }

        var linked_power_origin = total_capacity_origin*N/1000;
        var linked_power_analog = total_capacity_analog*count/1000;

        var total_investment_cost_origin = N*(origin_price_part*origin_lamp_count+origin_price+M)+linked_power_origin*pn;
        var total_investment_cost_analog = count*(analog_price_part*analog_lamp_count+analog_price)+M+linked_power_analog*pn;

        result = result+'<tr><td>Общие инвестиционные затраты</td><td>'+total_investment_cost_origin.toFixed(0)+'</td><td>'+total_investment_cost_analog.toFixed(0)+'</td></tr>';

        result_new = result_new + '<tr><td>Total investment cost, RUR</td><td>'+total_investment_cost_origin.toFixed(0)+'</td><td>'+total_investment_cost_analog.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Total investment cost, RUR</td><td>'+total_investment_cost_origin.toFixed(0)+'</td><td> - </td></tr>';

        var temp43r5b = total_investment_cost_origin.toFixed(0);
        var temp43r6b = total_investment_cost_analog.toFixed(0);

        var year_renew_origin = [];
        var year_renew_analog = [];

        year_renew_origin[0] = 0;
        year_renew_analog[0] = 0;

        year_renew_origin[1] = parseInt(Z);
        year_renew_analog[1] = parseInt(Z);

        result = result+'<tr><td>Стоимость замены с учетом инфляции за 1 год</td><td>'+year_renew_origin[0]+'</td><td>'+year_renew_analog[0]+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_renew_origin[i] = year_renew_origin[i-1]*Kq+year_renew_origin[i-1];
            year_renew_analog[i] = year_renew_analog[i-1]*Kq+year_renew_analog[i-1];

            result = result+'<tr><td>Стоимость замены с учетом инфляции за '+parseInt(i)+' год</td><td>'+year_renew_origin[i].toFixed(0)+'</td><td>'+year_renew_analog[i].toFixed(0)+'</td></tr>';
        }

        year_total_cost_origin = [];
        year_total_cost_analog = [];

        year_total_cost_origin[0] = 0;
        year_total_cost_analog[0] = 0;

        year_total_cost_origin[1] = parseInt(N*Z);
        year_total_cost_analog[1] = parseInt(count*Z);  

        total_year_total_cost_origin = year_total_cost_origin[0]+year_total_cost_origin[1];
        total_year_total_cost_analog = year_total_cost_analog[0]+year_total_cost_analog[1];

        result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за 1 год</td><td>'+parseInt(N*Z)+'</td><td>'+parseInt(count*Z)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_total_cost_origin[i] = N*(year_renew_origin[i]+origin_lamp_count*lamps_per_year_origin*year_lamp_cost_origin[i]);
            year_total_cost_analog[i] = count*(year_renew_analog[i]+analog_lamp_count*lamps_per_year_analog*year_lamp_cost_analog[i]);

            total_year_total_cost_origin += year_total_cost_origin[i];
            total_year_total_cost_analog += year_total_cost_analog[i];

            console.log(total_year_total_cost_origin);
            console.log(total_year_total_cost_analog);

            result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за '+parseInt(i)+' год</td><td>'+year_total_cost_origin[i].toFixed(0)+'</td><td>'+year_total_cost_analog[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за период</td><td>'+total_year_total_cost_origin.toFixed(0)+'</td><td>'+total_year_total_cost_analog.toFixed(0)+'</td></tr>';

        year_energy_price_origin = [];
        year_energy_price_analog = [];

        year_energy_price_origin[0] = 0;
        year_energy_price_analog[0] = 0;

        year_energy_price_origin[1] = q;
        year_energy_price_analog[1] = q;

        result = result+'<tr><td>Тариф за электроэнергию с учетом инфляции за 1 год</td><td>'+year_energy_price_origin[1]+'</td><td>'+year_energy_price_analog[1]+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            year_energy_price_origin[i] = parseFloat(year_energy_price_origin[i-1]*Kq+year_energy_price_origin[i-1]);
            year_energy_price_analog[i] = parseFloat(year_energy_price_analog[i-1]*Kq+year_energy_price_analog[i-1]);

            result = result+'<tr><td>Тариф за электроэнергию с учетом инфляции за '+parseInt(i)+' год</td><td>'+year_energy_price_origin[i].toFixed(0)+'</td><td>'+year_energy_price_analog[i].toFixed(0)+'</td></tr>';
        }

        var consumed_power_origin = linked_power_origin*ko/100;
        var consumed_power_analog = linked_power_analog*ko/100;

        var consumed_power_per_year_origin = consumed_power_origin*hours_per_year;
        var consumed_power_per_year_analog = consumed_power_analog*hours_per_year;

        var temp_consumed_power_origin = consumed_power_origin;
        var temp_consumed_power_analog = consumed_power_analog;

        result = result+'<tr><td>Общая присоединенная мощность</td><td>'+linked_power_origin.toFixed(0)+'</td><td>'+linked_power_analog.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общая потребляемая мощность</td><td>'+consumed_power_origin.toFixed(2)+'</td><td>'+consumed_power_analog.toFixed(2)+'</td></tr>';
        result = result+'<tr><td>Общее потребление осветительной установки за год</td><td>'+consumed_power_per_year_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_analog.toFixed(0)+'</td></tr>';

        result_new = result_new + '<tr><td>Total power consumption, kWh</td><td>'+consumed_power_origin.toFixed(2)+'</td><td>'+consumed_power_analog.toFixed(2)+'</td></tr>';
        result_old = result_old + '<tr><td>Total power consumption, kWh</td><td>'+consumed_power_origin.toFixed(2)+'</td><td>'+consumed_power_analog.toFixed(2)+'</td></tr>';

        result_new = result_new + '<tr><td>Total power consumption per year , kWh</td><td>'+consumed_power_per_year_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_analog.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Total power consumption per year , kWh</td><td>'+consumed_power_per_year_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_analog.toFixed(0)+'</td></tr>';

        var consumed_power_per_year_price_origin = [];
        var consumed_power_per_year_price_analog = [];

        consumed_power_per_year_price_origin[0] = 0;
        consumed_power_per_year_price_analog[0] = 0;

        consumed_power_per_year_price_origin[1] = consumed_power_per_year_origin*year_energy_price_origin[1];
        consumed_power_per_year_price_analog[1] = consumed_power_per_year_analog*year_energy_price_analog[1];

        var consumed_power_per_year_price_total_origin = consumed_power_per_year_price_origin[1];
        var consumed_power_per_year_price_total_analog = consumed_power_per_year_price_analog[1];

        for(var i = 2; i < H+1; i++) {

            consumed_power_per_year_price_origin[i] = consumed_power_per_year_origin*year_energy_price_origin[i];
            consumed_power_per_year_price_analog[i] = consumed_power_per_year_analog*year_energy_price_analog[i];

            consumed_power_per_year_price_total_origin += consumed_power_per_year_price_origin[i];
            consumed_power_per_year_price_total_analog += consumed_power_per_year_price_analog[i];

            result = result+'<tr><td>Затраты на электроэнергию за '+parseInt(i)+' год</td><td>'+consumed_power_per_year_price_origin[i].toFixed(0)+'</td><td>'+consumed_power_per_year_price_analog[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Общие затраты на электроэнергию</td><td>'+consumed_power_per_year_price_total_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog.toFixed(0)+'</td></tr>';

        result_new = result_new + '<tr><td>Total energy costs, RUR</td><td>'+consumed_power_per_year_price_total_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Total energy costs, RUR</td><td>'+consumed_power_per_year_price_total_origin.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog.toFixed(0)+'</td></tr>';
        
        var temp_fg673 = consumed_power_per_year_price_total_origin.toFixed(0);
        var temp_fg674 = consumed_power_per_year_price_total_analog.toFixed(0);

        var consumed_power_per_year_price_total_origin_output = consumed_power_per_year_price_total_origin.toFixed(0);
        var consumed_power_per_year_price_total_analog_output = consumed_power_per_year_price_total_analog.toFixed(0);

        var total_cost_origin = consumed_power_per_year_price_total_origin+total_year_total_cost_origin+total_investment_cost_origin;
        var total_cost_analog = consumed_power_per_year_price_total_analog+total_year_total_cost_analog+total_investment_cost_analog;

        var consumed_power_per_year_price_total_origin_percent = consumed_power_per_year_price_total_origin/total_cost_origin*100;
        var consumed_power_per_year_price_total_analog_percent = consumed_power_per_year_price_total_analog/total_cost_analog*100;

        var total_year_total_cost_origin_percent = total_year_total_cost_origin/total_cost_origin*100;
        var total_year_total_cost_analog_percent = total_year_total_cost_analog/total_cost_analog*100;

        var total_investment_cost_origin_percent = total_investment_cost_origin/total_cost_origin*100;
        var total_investment_cost_analog_percent = total_investment_cost_analog/total_cost_analog*100;

        result = result+'<tr><td>Общая стоимость решения</td><td>'+total_cost_origin.toFixed(0)+'</td><td>'+total_cost_analog.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общие инвестиционные затраты, %</td><td>'+total_investment_cost_origin_percent.toFixed(0)+'</td><td>'+total_investment_cost_analog_percent.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общая стоимость эксплуатации и замены источников света за период, %</td><td>'+total_year_total_cost_origin_percent.toFixed(0)+'</td><td>'+total_year_total_cost_analog_percent.toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Общие затраты на электроэнергию, %</td><td>'+consumed_power_per_year_price_total_origin_percent.toFixed(0)+'</td><td>'+consumed_power_per_year_price_total_analog_percent.toFixed(0)+'</td></tr>';

        var result_economy_percent_new = 100 - 100*(total_cost_origin/total_cost_analog);

        //УСТАНОВКА НОВОГО

        result = result+'<tr><td colspan="3">Установка нового оборудования</td></tr>';

        var total_cost_origin = [];
        var total_cost_analog = [];

        total_cost_origin[0] = total_investment_cost_origin;
        total_cost_analog[0] = total_investment_cost_analog;

        var total_total_cost_origin = total_cost_origin[0];
        var total_total_cost_analog = total_cost_analog[0];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_origin[0].toFixed(0)+'</td><td>'+total_cost_analog[0].toFixed(0)+'</td></tr>';

        for(var i = 1; i < H+1; i++) {

            total_cost_origin[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i];
            total_cost_analog[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i];

            total_total_cost_origin += total_cost_origin[i];
            total_total_cost_analog += total_cost_analog[i];

            result = result+'<tr><td>Приведенные затраты за '+parseInt(i)+' год</td><td>'+total_cost_origin[i].toFixed(0)+'</td><td>'+total_cost_analog[i].toFixed(0)+'</td></tr>';
            result_new = result_new + '<tr><td>Operating costs for '+parseInt(i)+' year, RUR</td><td>'+total_cost_origin[i].toFixed(0)+'</td><td>'+total_cost_analog[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_total_cost_origin.toFixed(0)+'</td><td>'+total_total_cost_analog.toFixed(0)+'</td></tr>';
        
        result_new = result_new + '<tr><td>The total cost of the solution, RUR</td><td>'+total_total_cost_origin.toFixed(0)+'</td><td>'+total_total_cost_analog.toFixed(0)+'</td></tr>';
        //общие эксплуатационные расходы

        var total_exp_charge_origin_new = 0;
        var total_exp_charge_analog_new = 0;

        for(var i = 1; i < H+1; i++) {

            total_exp_charge_origin_new += total_cost_origin[i];
            total_exp_charge_analog_new += total_cost_analog[i];
        }

        result_new = result_new + '<tr><td>Total operating costs and lighting sources replacement, RUR</td><td>'+total_exp_charge_origin_new.toFixed(0)+'</td><td>'+total_exp_charge_analog_new.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>Total operating costs and lighting sources replacement, RUR</td><td>'+total_exp_charge_origin_new.toFixed(0)+'</td><td>'+total_exp_charge_analog_new.toFixed(0)+'</td></tr>';

        var temp_afr45n = total_exp_charge_origin_new.toFixed(0);
        var temp_afr46n = total_exp_charge_analog_new.toFixed(0);

        var economy_year = [];
        var total_economy_year = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year[i] = total_cost_analog[i] - total_cost_origin[i];

            total_economy_year += economy_year[i];

            result = result+'<tr><td>Экономия за период '+parseInt(i)+' лет</td><td>'+economy_year[i].toFixed(0)+'</td><td></td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_economy_year.toFixed(0)+'</td><td></td></tr>';

        total_economy_year_output = total_economy_year.toFixed(0);

        var total_cost_summ_origin = [];
        var total_cost_summ_analog = [];

        total_cost_summ_origin[0] = total_investment_cost_origin;
        total_cost_summ_analog[0] = total_investment_cost_analog;

        total_cost_summ_origin[1] = consumed_power_per_year_price_origin[1]+year_total_cost_origin[1]+total_cost_summ_origin[0];
        total_cost_summ_analog[1] = consumed_power_per_year_price_analog[1]+year_total_cost_analog[1]+total_cost_summ_analog[0];

        var total_total_cost_summ_origin = total_cost_summ_origin[1]+total_cost_summ_origin[1];
        var total_total_cost_summ_analog = total_cost_summ_analog[1]+total_cost_summ_analog[1];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_summ_origin[0].toFixed(0)+'</td><td>'+total_cost_summ_analog[0].toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Приведенные затраты за 1 год</td><td>'+total_cost_summ_origin[1].toFixed(0)+'</td><td>'+total_cost_summ_analog[1].toFixed(0)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            total_cost_summ_origin[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i]+total_cost_summ_origin[i-1];
            total_cost_summ_analog[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i]+total_cost_summ_analog[i-1];

            total_total_cost_summ_origin += total_cost_summ_origin[i];
            total_total_cost_summ_analog += total_cost_summ_analog[i];

            result = result+'<tr><td>Приведенные затраты (сумма) за '+parseInt(i)+' год</td><td>'+total_cost_summ_origin[i].toFixed(0)+'</td><td>'+total_cost_summ_analog[i].toFixed(0)+'</td></tr>';
        }

        //result = result+'<tr><td>Итого</td><td>'+total_total_cost_summ_origin.toFixed(0)+'</td><td>'+total_total_cost_summ_analog.toFixed(0)+'</td></tr>';

        var economy_year_summ = [];
        var total_economy_year = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year_summ[i] = total_cost_summ_analog[i] - total_cost_summ_origin[i];

            total_economy_year += economy_year_summ[i];

            result = result+'<tr><td>Экономия за '+parseInt(i)+' год</td><td>'+economy_year_summ[i].toFixed(0)+'</td><td></td></tr>';
        }

        //result = result+'<tr><td>Итого</td><td>'+total_economy_year.toFixed(0)+'</td><td></td></tr>';

        //ЗАМЕНА СТАРОГО

        result = result+'<tr><td colspan="3">Замена старого оборудования</td></tr>';

        var total_cost_origin_2 = [];
        var total_cost_analog_2 = [];

        total_cost_origin_2[0] = total_investment_cost_origin;
        total_cost_analog_2[0] = 0;
        total_cost_origin_2[1] = consumed_power_per_year_price_origin[1]+year_total_cost_origin[1];
        total_cost_analog_2[1] = consumed_power_per_year_price_analog[1]+year_total_cost_analog[1];

        var total_total_cost_origin_2 = total_cost_origin_2[0]+total_cost_origin_2[1];
        var total_total_cost_analog_2 = total_cost_analog_2[0]+total_cost_analog_2[1];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_origin_2[0].toFixed(0)+'</td><td>'+total_cost_analog_2[0].toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Приведенные затраты за 1 год</td><td>'+total_cost_origin_2[1].toFixed(0)+'</td><td>'+total_cost_analog_2[1].toFixed(0)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            total_cost_origin_2[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i];
            total_cost_analog_2[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i];

            total_total_cost_origin_2 += total_cost_origin_2[i];
            total_total_cost_analog_2 += total_cost_analog_2[i];

            result = result+'<tr><td>Приведенные затраты за '+parseInt(i)+' год</td><td>'+total_cost_origin_2[i].toFixed(0)+'</td><td>'+total_cost_analog_2[i].toFixed(0)+'</td></tr>';
            result_old = result_old + '<tr><td>Operating costs for '+parseInt(i)+' year, RUR</td><td>'+total_cost_origin_2[i].toFixed(0)+'</td><td>'+total_cost_analog_2[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_total_cost_origin_2.toFixed(0)+'</td><td>'+total_total_cost_analog_2.toFixed(0)+'</td></tr>';
        result_old = result_old + '<tr><td>The total cost of the solution, RUR</td><td>'+total_total_cost_origin_2.toFixed(0)+'</td><td>'+total_total_cost_analog_2.toFixed(0)+'</td></tr>';

        //общие эксплуатационные расходы

        var total_exp_charge_origin_old = 0;
        var total_exp_charge_analog_old = 0;

        for(var i = 1; i < H+1; i++) {

            total_exp_charge_origin_old += total_cost_origin_2[i];
            total_exp_charge_analog_old += total_cost_analog_2[i];
        }

        var economy_year_2 = [];
        var total_economy_year_2 = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year_2[i] = total_cost_analog_2[i] - total_cost_origin_2[i];

            total_economy_year_2 += economy_year_2[i];

            result = result+'<tr><td>Экономия за период '+parseInt(i)+' лет</td><td>'+economy_year_2[i].toFixed(0)+'</td><td></td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_economy_year_2.toFixed(0)+'</td><td></td></tr>';

        total_economy_year_2_output = total_economy_year_2.toFixed(0);

        var total_cost_summ_origin_2 = [];
        var total_cost_summ_analog_2 = [];

        total_cost_summ_origin_2[0] = total_investment_cost_origin;
        total_cost_summ_analog_2[0] = 0;

        total_cost_summ_origin_2[1] = consumed_power_per_year_price_origin[1]+year_total_cost_origin[1]+total_cost_summ_origin_2[0];
        total_cost_summ_analog_2[1] = consumed_power_per_year_price_analog[1]+year_total_cost_analog[1]+total_cost_summ_analog_2[0];

        var total_total_cost_summ_origin_2 = total_cost_summ_origin_2[0]+total_cost_summ_origin_2[1];
        var total_total_cost_summ_analog_2 = total_cost_summ_analog_2[0]+total_cost_summ_analog_2[1];

        result = result+'<tr><td>Приведенные затраты за 0 год</td><td>'+total_cost_summ_origin_2[0].toFixed(0)+'</td><td>'+total_cost_summ_analog_2[0].toFixed(0)+'</td></tr>';
        result = result+'<tr><td>Приведенные затраты за 1 год</td><td>'+total_cost_summ_origin_2[1].toFixed(0)+'</td><td>'+total_cost_summ_analog_2[1].toFixed(0)+'</td></tr>';

        for(var i = 2; i < H+1; i++) {

            total_cost_summ_origin_2[i] = consumed_power_per_year_price_origin[i]+year_total_cost_origin[i]+total_cost_summ_origin_2[i-1];
            total_cost_summ_analog_2[i] = consumed_power_per_year_price_analog[i]+year_total_cost_analog[i]+total_cost_summ_analog_2[i-1];

            total_total_cost_summ_origin_2 += total_cost_summ_origin_2[i];
            total_total_cost_summ_analog_2 += total_cost_summ_analog_2[i];

            result = result+'<tr><td>Приведенные затраты (сумма) за '+parseInt(i)+' год</td><td>'+total_cost_summ_origin_2[i].toFixed(0)+'</td><td>'+total_cost_summ_analog_2[i].toFixed(0)+'</td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_total_cost_summ_origin_2.toFixed(0)+'</td><td>'+total_total_cost_summ_analog_2.toFixed(0)+'</td></tr>';

        var economy_year_summ_2 = [];
        var total_economy_year_2 = 0;

        for(var i = 0; i < H+1; i++) {

            economy_year_summ_2[i] = total_cost_summ_analog_2[i] - total_cost_summ_origin_2[i];

            total_economy_year_2 += economy_year_summ_2[i];

            result = result+'<tr><td>Экономия за '+parseInt(i)+' год</td><td>'+economy_year_summ_2[i].toFixed(0)+'</td><td></td></tr>';
        }

        result = result+'<tr><td>Итого</td><td>'+total_economy_year_2.toFixed(0)+'</td><td></td></tr>';

        var overall_cost_origin = year_total_cost_origin[1]+consumed_power_per_year_price_origin[1];
        var overall_cost_analog = year_total_cost_analog[1]+consumed_power_per_year_price_analog[1];

        result = result+'<tr><td>Капитальные затраты</td><td>'+overall_cost_origin.toFixed(0)+'</td><td>'+overall_cost_analog.toFixed(0)+'</td></tr>';

        var overall_economy = overall_cost_analog-overall_cost_origin;

        result = result+'<tr><td>Экономия капитальных затрат</td><td>'+overall_economy.toFixed(0)+'</td><td></td></tr>';

        var time      = total_investment_cost_origin/overall_economy;
        var time_new  = (total_investment_cost_origin-total_investment_cost_analog)/overall_economy;

        result = result+'<tr><td>Срок окупаемости</td><td>'+time.toFixed(0)+'</td><td></td></tr>';

        result = result+'</table>';

        //$('#result').html(result);

        $('#results').show();

        if($('#switch-calc-2-1').hasClass('active')) {

            $('#result-2-2').show();
        } else {

            $('#result-2-1').show();
        }

        var years = [];

        for(i = 0; i < H+1; i++) {

            years[i] = parseInt(i)+' год';
        }

        var origin_name = $('#origin_name').val();
        var analog_name = $('#analog_name').val();

        $('#chart0-description').show();
        $('#chart1-description').show();
        $('#chart2-description').show();

        var trim_economy_year 			= economy_year;
        var trim_economy_year_summ 		= economy_year_summ;
        var trim_total_cost_summ_origin = total_cost_summ_origin;
        var trim_total_cost_summ_analog = total_cost_summ_analog;

        trim_economy_year.shift();
    	trim_economy_year_summ.shift();
    	trim_total_cost_summ_origin.shift();
    	trim_total_cost_summ_analog.shift();

    	console.log(total_cost_summ_analog);
    	console.log(trim_total_cost_summ_analog);

    	var trim_economy_year_2 		  = economy_year_2;
        var trim_economy_year_summ_2 	  = economy_year_summ_2;
        var trim_total_cost_summ_origin_2 = total_cost_summ_origin_2;
        var trim_total_cost_summ_analog_2 = total_cost_summ_analog_2;

        trim_economy_year_2.shift();
    	trim_economy_year_summ_2.shift();
    	trim_total_cost_summ_origin_2.shift();
    	trim_total_cost_summ_analog_2.shift();

    	var trim_years = years;
    	trim_years = trim_years.shift();

        $(function () {
            $('#chart1').highcharts({
            	lang: {
    		        numericSymbols: null
    		    },
                title: {
                    text: 'Dynamics of cumulative costs on Installation of new luminaires',
                    x: -20 //center
                },
                xAxis: {
                    categories: years
                },
                yAxis: {
                    title: {
                        text: 'Cost, RUR'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    labels: {
    			        formatter: function () {
    			            return this.value.toFixed(0);
    			        }
    			    }
                },
                tooltip: {
                    valueSuffix: 'RUR',
                    pointFormat: "{point.y:.0f} RUR"
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: [{
                    name: 'Savings per year',
                    data: trim_economy_year,
                    type: 'area',
                    color: '#95CEFF',
                    fillOpacity: 0.6
                }, {
                    name: 'Total savings for '+H+' years',
                    data: trim_economy_year_summ,
                    type: 'area',
                    color: '#FF0000',
                    fillOpacity: 0.2
                }, {
                    name: origin_name,
                    data: trim_total_cost_summ_origin,
                    color: '#A9FF96'
                }, {
                    name: analog_name,
                    data: trim_total_cost_summ_analog,
                    color: 'orange'
                }]
            });
        });

        $(function () {
            $('#chart2').highcharts({
            	lang: {
    		        numericSymbols: null
    		    },
                title: {
                    text: 'Dynamics of cumulative costs on replacement of old luminaires',
                    x: -20 //center
                },
                xAxis: {
                    categories: years
                },
                yAxis: {
                    title: {
                        text: 'Cost, RUR'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }],
                    labels: {
    			        formatter: function () {
    			            return this.value.toFixed(0);
    			        }
    			    }
                },
                tooltip: {
                    valueSuffix: 'RUR',
                    pointFormat: "{point.y:.0f} RUR"
                },
                legend: {
                    layout: 'vertical',
                    align: 'center',
                    verticalAlign: 'bottom',
                    borderWidth: 0
                },
                series: [{
                    name: 'Savings per year',
                    data: trim_economy_year_2,
                    type: 'area',
                    color: '#95CEFF',
                    fillOpacity: 0.6
                }, {
                    name: 'Total savings for '+H+' years',
                    data: trim_economy_year_summ_2,
                    type: 'area',
                    color: '#FF0000',
                    fillOpacity: 0.2
                }, {
                    name: origin_name,
                    data: trim_total_cost_summ_origin_2,
                    color: '#A9FF96'
                }, {
                    name: analog_name,
                    data: trim_total_cost_summ_analog_2,
                    color: 'orange'
                }]
            });
        });

        var EXP_ORIGIN_0 = total_year_total_cost_originx.toFixed(0);
        var POWER_ORIGIN_0 = consumed_power_per_year_price_total_originx.toFixed(0);
        var INV_ORIGIN_0 = total_investment_cost_originx.toFixed(0);

        var temp_wefsdregr = parseFloat(total_investment_cost_origin)+parseFloat(consumed_power_per_year_price_total_origin_output)+parseFloat(total_year_total_cost_origin);

        $('.result-electricity').text(consumed_power_per_year_price_total_originx.toFixed(0));

        $('.result-profit-year-old').text(Math.ceil(time).toFixed(0));
        $('.result-profit-year-new').text(Math.ceil(time_new).toFixed(0));
        $('.result-economy-summ-new').text(total_economy_year_output);
        $('.result-period-new').text(H);
        $('.result-charge-new').text(temp_wefsdregr.toFixed(0));
        $('.result-electricity-new').text(consumed_power_per_year_price_total_origin_output);

        $('.result-economy-summ-old').text(total_economy_year_2_output);
        $('.result-period-old').text(H);
        $('.result-charge-old').text(temp_wefsdregr.toFixed(0));
        $('.result-electricity-old').text(consumed_power_per_year_price_total_origin_output);

        $('.result-period').text(H);

        var result_economy_percent_old = 100 - 100*(total_total_cost_origin/total_total_cost_analog_2);

        $('#lamp-count').text(H);

        console.log(result_economy_percent_old);
        console.log(result_economy_percent_new);

        $('.result-economy-percent-old').text(result_economy_percent_old.toFixed(0));
        $('.result-economy-percent-new').text(result_economy_percent_new.toFixed(0));

        if(result_economy_percent_old > 0) {

            if(time < 0) {

                $('.plus-result-old').hide();
            }
            else {

                $('.minus-result-old').hide();
                $('.not-efficient-old').hide();
            }

            $('.result-economy-block-old').html('Savings up <span>'+result_economy_percent_old.toFixed(0)+'%</span>');
        }
        else {

            $('.result-economy-block-old').html('No savings');

            $('.result-old-economy-hide').hide();
            $('.plus-result-old').hide();
            $('.minus-result-old').hide();
        }

        if(result_economy_percent_new > 0) {

            if(time_new < 0) {

                $('.plus-result-new').hide();
            }
            else {

                $('.minus-result-new').hide();
                $('.not-efficient-new').hide();
            }

            $('.result-economy-block-new').html('Savings up <span>'+result_economy_percent_new.toFixed(0)+'%</span>');
        }
        else {

            $('.result-economy-block-new').html('No savings');

            $('.result-new-economy-hide').hide();

            $('.plus-result-new').hide();
            $('.minus-result-new').hide();
        }

        console.log(time_new);

        if(time_new > 0) {

            $('.result-year-block-new').html('Pay back period <span>'+Math.ceil(time_new)+'</span> years');
        } else {

            if(result_economy_percent_new > 0) {

                $('.result-year-block-new').html('The project at '+$('.current-modification-name').text()+' is profitable');
            }
            else {

                $('.result-year-block-new').html('The project at '+$('.current-modification-name').text()+' is not profitable');
            }
        }

        if(time > 0) {

            $('.result-year-block-old').html('Pay back period <span>'+Math.ceil(time)+'</span> years');
        } else {

            if(result_economy_percent_old > 0) {

                $('.result-year-block-old').html('The project at '+$('.current-modification-name').text()+' is profitable');
            }
            else {

                $('.result-year-block-old').html('The project at '+$('.current-modification-name').text()+' is not profitable');
            }
        }

        var temp943tg = parseFloat(total_investment_cost_originx+consumed_power_per_year_price_total_originx+total_year_total_cost_originx);

        $('#result-2-2 .result-charge').text(temp943tg.toFixed(0));

        

        //УСТАНОВКА НОВОГО ОБОРУДОВАНИЯ
        $('#chart0').highcharts({
        	lang: {
    		    numericSymbols: null
    		},
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Cost collation'
            },
            xAxis: {
                categories: [origin_name, analog_name],
                
                formatter: function() {
                    return this.value;
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                },
                title: {
                    text: 'Cost, RUR'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function() {

                        return '';
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y.toFixed(0) + '<br/>' +
                        'Всего: ' + this.point.stackTotal.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    reversed: true,
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        formatter: function() {

                            var label = parseFloat(this.y);

                            return '';
                        }
                    }
                }
            },
            series: [{
                name: 'Total operating costs, RUR',
                data: [parseFloat(total_year_total_cost_origin), parseFloat(total_year_total_cost_analog)],
                color: '#A9FF96'
            }, {
                name: 'Total energy costs, RUR',
                data: [parseFloat(consumed_power_per_year_price_total_origin_output), parseFloat(consumed_power_per_year_price_total_analog_output)],
                color: '#95CEFF'
            }, {
                name: 'Total investment cost, RUR',
                data: [parseFloat(total_investment_cost_origin), parseFloat(total_investment_cost_analog)],
                color: '#5C5C61'
            }]
        });

        var result_new_table2 = '<tr><td>Total investment cost, RUR</td><td>'+temp43r5b+'</td><td></td></tr><tr><td>Total energy costs, RUR</td><td>'+temp_fg673+'</td><td></td></tr><tr><td>Total operating costs, RUR</td><td>'+total_year_total_cost_origin.toFixed(0)+'</td><td></td></tr><tr><td>Analog total investment cost, RUR</td><td>'+temp43r6b+'</td><td></td></tr><tr><td>Analog total energy costs, RUR</td><td>'+temp_fg674+'</td><td></td></tr><tr><td>Analog total operating costs, RUR</td><td>'+total_year_total_cost_analog.toFixed(0)+'</td><td></td></tr>';

        //ЗАМЕНА СТАРОГО ОБОРУДОВАНИЯ
        $('#chart01').highcharts({
        	lang: {
    	        numericSymbols: null
    	    },
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Cost collation'
            },
            xAxis: {
                categories: [origin_name, analog_name],
               
                formatter: function() {
                    return this.value;
                }
            },
            yAxis: {
                min: 0,
                formatter: function() {
                    return this.value;
                },
                title: {
                    text: 'Cost, RUR'
                },
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                },
                stackLabels: {
                    reversed: true,
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function() {

                        return '';
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y.toFixed(0) + '<br/>' +
                        'Всего: ' + this.point.stackTotal.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        formatter: function() {

                            var label = parseFloat(this.y);

                            return '';
                        }
                    }
                }
            },
            series: [{
                name: 'Total operating costs, RUR',
                data: [parseFloat(total_year_total_cost_origin), parseFloat(total_year_total_cost_analog)],
                color: '#A9FF96'
            }, {
                name: 'Total energy costs, RUR',
                data: [parseFloat(consumed_power_per_year_price_total_origin_output), parseFloat(consumed_power_per_year_price_total_analog_output)],
                color: '#95CEFF'
            }, {
                name: 'Total investment cost, RUR',
                data: [parseFloat(total_investment_cost_origin), 0],
                color: '#5C5C61'
            }]
        });

        var result_old_table2 = '<tr><td>Total investment cost, RUR</td><td>'+temp43r5b+'</td><td></td></tr><tr><td>Total energy costs, RUR</td><td>'+temp_fg673+'</td><td></td></tr><tr><td>Total operating costs, RUR</td><td>'+total_year_total_cost_origin.toFixed(0)+'</td><td></td></tr><tr><td>Analog total operating costs, RUR</td><td> - </td><td></td></tr><tr><td>Analog total energy costs, RUR</td><td>'+temp_fg674+'</td><td></td></tr><tr><td>Analog total operating costs, RUR</td><td>'+total_year_total_cost_analog.toFixed(0)+'</td><td></td></tr>';

        $('#chart3').highcharts({
            chart: {
                type: 'bar',
                lang: {
                    numericSymbols: null
                }
            },
            title: {
                text: 'Cost collation'
            },
            xAxis: {
                categories: [origin_name],
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                }
            },
            yAxis: {
                min: 0,
                labels: {
                    formatter: function() {
                        return this.value;
                    }
                },
                title: {
                    text: 'Cost, RUR'
                },
                stackLabels: {
                    enabled: false,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    },
                    formatter: function() {

                        return '';
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'center',
                verticalAlign: 'bottom',
                borderWidth: 0
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.x + '</b><br/>' +
                        this.series.name + ': ' + this.y.toFixed(0) + '<br/>' +
                        'Всего: ' + this.point.stackTotal.toFixed(0);
                }
            },
            plotOptions: {
                bar: {
                    reversed: true,
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
                        style: {
                            textShadow: '0 0 3px black, 0 0 3px black'
                        },
                        formatter: function() {

                            var label = parseFloat(this.y);

                            return  '';
                        }
                    }
                }
            },
            series: [{
                name: 'Total operating costs, RUR',
                data: [parseFloat(total_year_total_cost_originx)],
                color: '#A9FF96'
            }, {
                name: 'Total energy costs, RUR',
                data: [parseFloat(consumed_power_per_year_price_total_originx)],
                color: '#95CEFF'
            }, {
                name: 'Total investment cost, RUR',
                data: [parseFloat(total_investment_cost_originx)],
                color: '#5C5C61'
            }]
        });

        result_new_html = '<table class="product-specs-info" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_new;
        result_old_html = '<table class="product-specs-info" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_old;
        result_new_pdf = '<table class="product-specs-info pdf" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_new;
        result_old_pdf = '<table class="product-specs-info pdf" style="font-size: 80%; width: 80%; margin-bottom: 20px;"><tr><td></td><td>'+origin_name+'</td><td>'+analog_name+'</td></tr>'+result_old;
        result_new_html = result_new_html + '</table>';
        result_old_html = result_old_html + '</table>';

        $('.result-hidden-new').html(result_new_html);
        $('.result-hidden-old').html(result_old_html);

        var data_x = {'ORIGINAL_COUNT' : N,
                    'ORIGIN_CAPACITY_CONSUMED' : temp_consumed_power_origin.toFixed(2),
                    'ANALOG_CAPACITY_CONSUMED' : temp_consumed_power_analog.toFixed(2),
                    'ANALOG_PRICE' : analog_price,
                    'ANALOG_COUNT' : $('#count_analog_2').text(),
                    'ANALOG_NAME' : analog_name,
                    'ECONOMIC_H' : H,
                    'ECONOMIC_Q' : q,
                    'ECONOMIC_KQ' : Kq,
                    'ECONOMIC_T' : t,
                    'ECONOMIC_D' : d,
                    'ECONOMIC_KO' : ko,
                    'ECONOMIC_PN' : pn,
                    'ROOM_A' : a,
                    'ROOM_B' : b,
                    'ROOM_H' : h,
                    'ROOM_H1' : h1,
                    'ROOM_E' : e.toFixed(0),
                    'PROFIT_YEAR_NEW' : Math.ceil(time_new),
                    'PROFIT_YEAR_OLD' : Math.ceil(time),
                    'RESULT_ECONOMY_SUMM_NEW' : total_economy_year_output,
                    'RESULT_ECONOMY_SUMM_OLD' : total_economy_year_2_output,
                    'RESULT_CHARGE' : temp943tg.toFixed(0),
                    'RESULT_CHARGE_2' : temp_wefsdregr.toFixed(0),
                    'RESULT_ELECTRICITY' : temp_fg673,
                    'POWER_ORIGIN_0' : POWER_ORIGIN_0,
                    'EXP_ORIGIN_0' : EXP_ORIGIN_0,
                    'INV_ORIGIN_0' : INV_ORIGIN_0,
                    'RESULT_NEW': result_new_pdf,
                    'RESULT_OLD': result_old_pdf,
                    'RESULT_ECONOMY_PERCENT_OLD': result_economy_percent_old,
                    'RESULT_ECONOMY_PERCENT_NEW': result_economy_percent_new,
                    'NEW_TABLE2': result_new_table2,
                    'OLD_TABLE2': result_old_table2
                };

        $('#pdf-2').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');

        $.post("/en-production/generate.php?type=calc2&element="+$('#original_element_id').val(), {
            data: JSON.stringify(data_x),
            dataType: 'json'
        });
    }, 4000);
}

function calc3_en() {

    $('#result-3').after('<img class="calc-3-preloader" src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 20px auto;">');

    setTimeout(function() {

        $('.calc-3-preloader').remove();

        var lamp_count = parseInt($('#lamp_count').val());
        var nds        = parseFloat($('#nds').val());
        var price      = parseFloat($('#original_price_2').val());

        var lamp_name    = String($('#lamp_name').val());

        var length_netto    = String($('#length_netto').val());
        var width_netto     = String($('#width_netto').val()); 
        var height_netto    = String($('#height_netto').val());
        var weight_netto    = String($('#weight_netto').val()); 
        var length_brutto   = String($('#length_brutto').val());
        var width_brutto    = String($('#width_brutto').val()); 
        var height_brutto   = String($('#height_brutto').val());
        var weight_brutto   = String($('#weight_brutto').val());
        var lamp_quantity   = String($('#lamp_quantity').val());

        length_netto    = length_netto.split(",").join(".");
        width_netto     = width_netto.split(",").join(".");
        height_netto    = height_netto.split(",").join(".");
        weight_netto    = weight_netto.split(",").join(".");
        length_brutto   = length_brutto.split(",").join(".");
        width_brutto    = width_brutto.split(",").join(".");
        height_brutto   = height_brutto.split(",").join(".");
        weight_brutto   = weight_brutto.split(",").join(".");
        lamp_quantity   = lamp_quantity.split(",").join(".");

        length_netto    = parseFloat(length_netto);
        width_netto     = parseFloat(width_netto);
        height_netto    = parseFloat(height_netto);
        weight_netto    = parseFloat(weight_netto);
        length_brutto   = parseFloat(length_brutto);
        width_brutto    = parseFloat(width_brutto);
        height_brutto   = parseFloat(height_brutto);
        weight_brutto   = parseFloat(weight_brutto);
        lamp_quantity   = parseFloat(lamp_quantity);

        var packs      = Math.ceil(lamp_count/lamp_quantity);

        window.price_all       = (lamp_count*price)/((100+nds)/100);
        window.price_with_nds  = lamp_count*price;
        
        window.volume          = packs*length_brutto*width_brutto*height_brutto;
        window.weight          = packs*weight_brutto;

        var nds_all = window.price_with_nds - window.price_all;

        $('.accesorie-full-weight.first').text(packs*weight_brutto);
        $('.accesorie-full-volume.first').text(packs*length_brutto*width_brutto*height_brutto);
        $('.accesorie-price-without-nds.first').text((lamp_count*price)/((100+nds)/100));
        $('.accesorie-nds.first').text(lamp_count*price*nds/100);
        $('.accesorie-full-price.first').text(lamp_count*price);

        var table = '<br><br><table class="calc-3-table"><tr><td rowspan="2">Name</td><td rowspan="2">Gross weight, kg</td><td rowspan="2">Volume, m3</td><td rowspan="2">Amount excluding VAT, RUR<td colspan="2">VAT</td><td rowspan="2">Amount including VAT, RUR</td></tr><tr><td>VAT rate, %</td><td>Amount, RUR </td></tr><tr><td>'+lamp_name+'</td><td>'+(packs*weight_brutto).toFixed(3)+'</td><td>'+(packs*length_brutto*width_brutto*height_brutto).toFixed(3)+'</td><td>'+((lamp_count*price)/((100+nds)/100)).toFixed(2)+'</td><td>18</td><td>'+(lamp_count*price*nds/100).toFixed(2)+'</td><td>'+(lamp_count*price).toFixed(2)+'</td></tr>';

        var i = 1;
        var data = {};

        data['d0'] = lamp_count;

        $('.accessory').each(function() {

            var count_acc = parseFloat($(this).find('.accessory_count').val());
            var price_acc = parseFloat($(this).find('.accessory_price').val());

            if((count_acc == '') || isNaN(count_acc) || (typeof(count_acc) == 'undefined') || (count_acc <= 0)) { } else {

            	var id = $(this).find('.accessory_id').val().toString();

	            data[''+id+''] = count_acc;

	            i += 1;

	            var name    = $(this).find('.accessory_name').val();

	            var length_netto    = $(this).find('.accessory_length_netto').val();
	            var width_netto     = $(this).find('.accessory_width_netto').val(); 
	            var height_netto    = $(this).find('.accessory_height_netto').val();
	            var weight_netto    = $(this).find('.accessory_weight_netto').val(); 
	            var length_brutto   = $(this).find('.accessory_length_brutto').val();
	            var width_brutto    = $(this).find('.accessory_width_brutto').val(); 
	            var height_brutto   = $(this).find('.accessory_height_brutto').val();
	            var weight_brutto   = $(this).find('.accessory_weight_brutto').val();
	            var lamp_quantity   = $(this).find('.accessory_quantity').val();
	        
	            length_netto    = parseFloat(length_netto);
	            width_netto     = parseFloat(width_netto);
	            height_netto    = parseFloat(height_netto);
	            weight_netto    = parseFloat(weight_netto);
	            length_brutto   = parseFloat(length_brutto);
	            width_brutto    = parseFloat(width_brutto);
	            height_brutto   = parseFloat(height_brutto);
	            weight_brutto   = parseFloat(weight_brutto);
	            lamp_quantity   = parseFloat(lamp_quantity);

	            var packs      = Math.ceil(count_acc/lamp_quantity);

	            var price_all      = (count_acc*price_acc)/((100+nds)/100);
	            var price_with_nds = count_acc*price_acc;
	            var volume         = packs*length_brutto*width_brutto*height_brutto;
	            var weight         = packs*weight_brutto;
	            var nds_all        = price_with_nds - price_all;

	            window.price_all      += price_all;
	            window.price_with_nds += price_with_nds;
	            window.volume         += volume;
	            window.weight         += weight;

	            $(this).find('.accesorie-full-weight').text(packs*weight_brutto);
	            $(this).find('.accesorie-full-volume').text(packs*length_brutto*width_brutto*height_brutto);
	            $(this).find('.accesorie-price-without-nds').text((count_acc*price_acc)/((100+nds)/100));
	            $(this).find('.accesorie-nds').text(count_acc*price_acc*nds/100);
	            $(this).find('.accesorie-full-price').text(count_acc*price_acc);

	            table = table + '<tr><td>'+name+'</td><td>'+(packs*weight_brutto).toFixed(3)+'</td><td>'+(packs*length_brutto*width_brutto*height_brutto).toFixed(3)+'</td><td>'+((count_acc*price_acc)/((100+nds)/100)).toFixed(2)+'</td><td>18</td><td>'+(count_acc*price_acc*nds/100).toFixed(2)+'</td><td>'+(count_acc*price_acc).toFixed(2)+'</td></tr>';
	        }
        });

        table = table + "<tr><td></td><td>"+window.weight.toFixed(3)+"</td><td>"+window.volume.toFixed(3)+"</td><td>"+window.price_all.toFixed(2)+"</td><td></td><td>"+nds_all.toFixed(2)+"</td><td>"+window.price_with_nds.toFixed(2)+"</td></tr></table>";

        var nds_all         = window.price_with_nds - window.price_all;

        $('#pdf-3').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
        $('#pdf-32').removeClass('download-2');

        $.post("/en-production/generate2.php?element="+$('#original_element_id').val(), {
            data: JSON.stringify(data),
            dataType: 'json'
        });

        $('#result-3').html(table);
    }, 4000);
}

function calc10_en() {

    var e       = $('#e1').val();
    var count   = $('#count1').val();
    var a       = $('#a1').val();
    var b       = $('#b1').val();
    var h       = $('#h1').val();
    var h1      = $('#h11').val();
    var h2      = $('#h21').val();
    var k       = $('#k1').val();
    var z       = $('#z1').val();
    var f       = $('#f1').val();

    var origin_lamp_count = $('#original_lamp_count').val();

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    var ki006 = parseFloat($('#ki0061').val());
    var ki008 = parseFloat($('#ki0081').val());
    var ki010 = parseFloat($('#ki0101').val());
    var ki125 = parseFloat($('#ki1251').val());
    var ki150 = parseFloat($('#ki1501').val());
    var ki200 = parseFloat($('#ki2001').val());
    var ki250 = parseFloat($('#ki2501').val());
    var ki300 = parseFloat($('#ki3001').val());
    var ki400 = parseFloat($('#ki4001').val());
    var ki500 = parseFloat($('#ki5001').val());

    if(h2 < 0)  {

        h2 = 0.8;
        $('#h21').val('0.8');
    }

    if(isNaN(h2))  {

        h2 = 0;
        $('#h21').val('0');
    }

    var hp = h-h1-h2;

    if(hp <= 0) {

        $('.result-1').text('Summ of work area height and lamp suspension height might be less than room height.');

        return false;
    }

    var nn = (a*b)/(hp*(a+b));

    var nnout = 0;

    if(nn < 0.7) {

        nnout = ki006;
    }
    else if(nn < 0.9) {

        nnout = ki008;
    }
    else if(nn < 1.125) {

        nnout = ki010;
    }
    else if(nn < 1.375) {

        nnout = ki125;
    }
    else if(nn < 1.75) {

        nnout = ki150;
    }
    else if(nn < 2.25) {

        nnout = ki200;
    }
    else if(nn < 2.75) {

        nnout = ki250;
    }
    else if(nn < 3.5) {

        nnout = ki300;
    }
    else if(nn < 4.5) {

        nnout = ki400;
    }
    else {

        nnout = ki500;
    }

    if($('#switch-2').attr("checked") == 'checked') {

        var count = (e*a*b*k*z*100)/(f*nnout*origin_lamp_count);

        var e_average = Math.ceil(count)*(f*nnout)*origin_lamp_count/(a*b*k*z*100);

        if(isNaN(count)) {

            $('.result-1').text('Incorrect input data');
        }
        else {

            $('.result-1').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('#a').val(a);
                $('#b').val(b);
                $('#h').val(h);
                $('#N').val(Math.ceil(count));

                $('#lamp_count').val(Math.ceil(count));

                $('.result-1').html('Quantity of luminaire <span>'+Math.ceil(count)+' pcs</span> at minimal  average illuminance <span>'+Math.floor(e_average)+' lx</span>');
                $('#pdf-1').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }  
    }
    else {

        var e = count*(f*nnout*origin_lamp_count)/(a*b*k*z*100);

        if(isNaN(count)) {

            $('.result-1').text('Incorrect input data');
        }
        else {

            $('.result-1').html('<img src="/img/calculator/preloader.GIF" style="height: 50px; display: block; margin: 0 auto;">');

            setTimeout(function() {

                $('#a').val(a);
                $('#b').val(b);
                $('#h').val(h);
                $('#N').val(count);

                $('#lamp_count').val(count);

                $('.result-1').html('Minimal  average illuminance  <span>'+Math.floor(e)+' lx</span>');
                //$('#economic').attr('onclick', 'economic('+id+', '+e+', '+count+', '+a+', '+b+', '+h+', '+h1+', '+h2+', '+k+', '+z+', '+f+')');
                $('#pdf-1').css('background', 'url(/img/calculator/pict-download.png) 15px center no-repeat #0167B1');
            }, 2000);
        }
    }

    var f            = parseFloat($('#analog_light_flow').val());

    var analog_ki006 = parseFloat($('#analog_ki006').val());
    var analog_ki008 = parseFloat($('#analog_ki008').val());
    var analog_ki010 = parseFloat($('#analog_ki010').val());
    var analog_ki125 = parseFloat($('#analog_ki125').val());
    var analog_ki150 = parseFloat($('#analog_ki150').val());
    var analog_ki200 = parseFloat($('#analog_ki200').val());
    var analog_ki250 = parseFloat($('#analog_ki250').val());
    var analog_ki300 = parseFloat($('#analog_ki300').val());
    var analog_ki400 = parseFloat($('#analog_ki400').val());
    var analog_ki500 = parseFloat($('#analog_ki500').val());

    var nnout = 0;

    if(nn < 0.7) {

        nnout = analog_ki006;
    }
    else if(nn < 0.9) {

        nnout = analog_ki008;
    }
    else if(nn < 1.125) {

        nnout = analog_ki010;
    }
    else if(nn < 1.375) {

        nnout = analog_ki125;
    }
    else if(nn < 1.75) {

        nnout = analog_ki150;
    }
    else if(nn < 2.25) {

        nnout = analog_ki200;
    }
    else if(nn < 2.75) {

        nnout = analog_ki250;
    }
    else if(nn < 3.5) {

        nnout = analog_ki300;
    }
    else if(nn < 4.5) {

        nnout = analog_ki400;
    }
    else {

        nnout = analog_ki500;
    }

    var count_analog = Math.ceil((e*a*b*k*z*100)/(f*nnout));

    console.log(count);

    $('#count_analog').val(count_analog);
    $('#ex').text(e.toFixed(0));
    $('#count_analog_2').text(count_analog);
}

function print_calculator_1_en(link) {

    var e       = $('#e1').val();
    var count   = $('#count1').val();
    var a       = $('#a1').val();
    var b       = $('#b1').val();
    var h       = $('#h1').val();
    var h1      = $('#h11').val();
    var h2      = $('#h21').val();
    var k       = $('#k1').val();
    var z       = $('#z1').val();
    var f       = $('#f1').val();

    var origin_lamp_count = $('#origin_lamp_count').val();

    var id      = $(link).attr('data-mod');

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    if($('#switch-2').attr("checked") == 'checked') { 

        var switched = 1;
    }
    else {

        var switched = 0;
    }

    downloadPDF_en('/en-production/print.php?calculator_1='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'&switch='+switched+'&origin_lamp_count='+origin_lamp_count);
}

function print_calculator_1x_en(link) {

    var e       = $('#e').val();
    var count   = $('#count').val();
    var a       = $('#a').val();
    var b       = $('#b').val();
    var h       = $('#h').val();
    var h1      = $('#h1').val();
    var h2      = $('#h2').val();
    var k       = $('#k').val();
    var z       = $('#z').val();
    var f       = $('#f').val();

    var origin_lamp_count = $('#origin_lamp_count').val();

    var id      = $(link).attr('data-mod');

    e       = String(e);
    count   = String(count);
    a       = String(a);
    b       = String(b);
    h       = String(h);
    h1      = String(h1);
    h2      = String(h2);
    k       = String(k);
    z       = String(z);
    f       = String(f);

    e       = e.split(",").join(".");
    count   = count.split(",").join(".");
    a       = a.split(",").join(".");
    b       = b.split(",").join(".");
    h       = h.split(",").join(".");
    h1      = h1.split(",").join(".");
    h2      = h2.split(",").join(".");
    k       = k.split(",").join(".");
    z       = z.split(",").join(".");
    f       = f.split(",").join(".");

    e       = parseFloat(e);
    count   = parseFloat(count);
    a       = parseFloat(a);
    b       = parseFloat(b);
    h       = parseFloat(h);
    h1      = parseFloat(h1);
    h2      = parseFloat(h2);
    k       = parseFloat(k);
    z       = parseFloat(z);
    f       = parseFloat(f);

    if($('#switch-2').attr("checked") == 'checked') { 

        var switched = 1;
    }
    else {

        var switched = 0;
    }

    downloadPDF_en('/en-production/print.php?calculator_1='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'&switch='+switched+'&origin_lamp_count='+origin_lamp_count);
}

function print_calculator_2_en(link) { 

    var id = $(link).attr('data-mod');

    if($('#switch-calc-2-1').hasClass('active')) {

        var switched = 0;
    }
    else {

        var switched = 1;
    }

    downloadPDF_en('/en-production/print.php?calculator_2='+id+'&switched='+switched);
}

function print_calculator_3_en(link) { 

    var id = $(link).attr('data-mod');

    $('#file-to-send').val('/en-production/pdf/calc-3-'+$('#current-modification-code').val()+'.pdf');

    downloadPDF_en('/en-production/print.php?calculator_3='+id);
}

function economic_en(id, e, count, a, b, h, h1, h2, k, z, f) {

    if(typeof(e)==='undefined') e = 400;
    if(typeof(count)==='undefined') count = 10;
    if(typeof(a)==='undefined') a = 12;
    if(typeof(b)==='undefined') b = 8;
    if(typeof(h)==='undefined') h = 3.3;
    if(typeof(h1)==='undefined') h1 = 0;
    if(typeof(h2)==='undefined') h2 = 0;
    if(typeof(k)==='undefined') k = 1.5;
    if(typeof(z)==='undefined') z = 1.1;
    if(typeof(f)==='undefined') f = 0;

    window.location = '/en/calculate/?modification='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'#tab-1';
}

function complect_en(id, e, count, a, b, h, h1, h2, k, z, f) {

    if(typeof(e)==='undefined') e = 400;
    if(typeof(count)==='undefined') count = 10;
    if(typeof(a)==='undefined') a = 12;
    if(typeof(b)==='undefined') b = 8;
    if(typeof(h)==='undefined') h = 3.3;
    if(typeof(h1)==='undefined') h1 = 0;
    if(typeof(h2)==='undefined') h2 = 0;
    if(typeof(k)==='undefined') k = 1.5;
    if(typeof(z)==='undefined') z = 1.1;
    if(typeof(f)==='undefined') f = 0;

    window.location = '/en/calculate/?modification='+id+'&e='+e+'&count='+count+'&a='+a+'&b='+b+'&h='+h+'&h1='+h1+'&h2='+h2+'&k='+k+'&z='+z+'&f='+f+'#tab-2';
}

/*
Snow Fall 1 - no images - Java Script
Visit http://rainbow.arch.scriptmania.com/scripts/
  for this script and many more
*/

// Set the number of snowflakes (more than 30 - 40 not recommended)
var snowmax=35

// Set the colors for the snow. Add as many colors as you like
var snowcolor=new Array("#b9dff5","#b9dff5","#b9dff5","#b9dff5","#b9dff5")

// Set the fonts, that create the snowflakes. Add as many fonts as you like
var snowtype=new Array("Times")

// Set the letter that creates your snowflake (recommended: * )
var snowletter="*"

// Set the speed of sinking (recommended values range from 0.3 to 2)
var sinkspeed=0.6

// Set the maximum-size of your snowflakes
var snowmaxsize=35

// Set the minimal-size of your snowflakes
var snowminsize=8

// Set the snowing-zone
// Set 1 for all-over-snowing, set 2 for left-side-snowing
// Set 3 for center-snowing, set 4 for right-side-snowing
var snowingzone=1

///////////////////////////////////////////////////////////////////////////
// CONFIGURATION ENDS HERE
///////////////////////////////////////////////////////////////////////////


// Do not edit below this line
var snow=new Array()
var marginbottom = 100
var marginright
var timer
var i_snow=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)
var browserok=ie5||ns6||opera

function randommaker(range) {
        rand=Math.floor(range*Math.random())
    return rand
}

function initsnow() {
        if (ie5 || opera) {
                marginbottom = document.body.scrollHeight
                marginright = document.body.clientWidth-15
        }
        else if (ns6) {
                marginbottom = document.body.scrollHeight
                marginright = window.innerWidth-15
        }
        var snowsizerange=snowmaxsize-snowminsize
        for (i=0;i<=snowmax;i++) {
                crds[i] = 0;
            lftrght[i] = Math.random()*15;
            x_mv[i] = 0.03 + Math.random()/10;
                snow[i]=document.getElementById("s"+i)
                snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)]
                snow[i].size=randommaker(snowsizerange)+snowminsize
                snow[i].style.fontSize=snow[i].size+'px';
                snow[i].style.color=snowcolor[randommaker(snowcolor.length)]
                snow[i].style.zIndex=1000
                snow[i].sink=sinkspeed*snow[i].size/5
                if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
                if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
                if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
                if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
                snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size)
                snow[i].style.left=snow[i].posx+'px';
                snow[i].style.top=snow[i].posy+'px';
        }
        movesnow()
}

function movesnow() {
        for (i=0;i<=snowmax;i++) {
                crds[i] += x_mv[i];
                snow[i].posy+=snow[i].sink
                snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+'px';
                snow[i].style.top=snow[i].posy+'px';

                if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
                        if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
                        if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
                        if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
                        if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
                        snow[i].posy=0
                }
        }
        var timer=setTimeout("movesnow()",50)
}

for (i=0;i<=snowmax;i++) {
        document.write("<span id='s"+i+"' style='position:absolute;top:-"+snowmaxsize+"px'>"+snowletter+"</span>")
}

//setTimeout("initsnow()",2000)

});
})(jQuery);