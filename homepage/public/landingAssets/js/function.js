'use strict';
function nagrand_video() {
    $('.nagrand-video a').simpleLightboxVideo();
}
/*mobile_menu*/
function nagrand_clone_main_menu() {
    var _clone_menu = $('#header .clone-main-menu');
    var _target = $('#box-mobile-menu .clone-main-menu');
    var _data_width = $('#header .main-navigation').data('width');
    if ($(window).innerWidth() <= _data_width) {
        if (_clone_menu.length > 0) {
            _clone_menu.each(function () {
                $(this).appendTo('#box-mobile-menu .box-inner');
            });
        }
    } else {
        if (_target.length > 0) {
            _target.each(function () {
                $(this).appendTo('#header .main-navigation');
            });
        }
    }

    function action_addClass() {
        $('body').addClass('box-mobile-menu-open');
        return false;
    }

    function action_removeClass() {
        $('body').removeClass('box-mobile-menu-open');
        return false;
    }

    $(".mobile-navigation").on('click', action_addClass);
    $("#box-mobile-menu .close-menu, .body-overlay").on('click', action_removeClass);
}

function box_mobile_menu() {
    var _content = $('#box-mobile-menu .clone-main-menu');
    if ($(window).innerWidth() <= 1024) {
        _content.each(function () {
            var t = $(this);
            t.addClass('active');
            $(this).find('.toggle-submenu').on('click', function () {
                t.removeClass('active');
                var text_next = $(this).prev().text();
                $('#box-mobile-menu .box-title').html(text_next);
                t.find('li').removeClass('mobile-active');
                $(this).parent().addClass('mobile-active');
                $(this).parent().closest('.submenu').css({
                    'position': 'static',
                    'height': '0',
                });
                $('#box-mobile-menu #back-menu').css('display', 'block');
            })
        });
        $('#box-mobile-menu #back-menu').on('click', function () {
            _content.find('li.mobile-active').each(function () {
                _content.find('li').removeClass('mobile-active');
                if ($(this).parent().hasClass('main-menu')) {
                    _content.addClass('active');
                    $('#box-mobile-menu .box-title').html('MAIN MENU');
                    $('#box-mobile-menu #back-menu').css('display', 'none');
                } else {
                    _content.removeClass('active');
                    $(this).parent().parent().addClass('mobile-active');
                    $(this).parent().css({
                        'position': 'absolute',
                        'height': 'auto',
                    });
                    var text_prev = $(this).parent().parent().children('a').text();
                    $('#box-mobile-menu .box-title').html(text_prev);
                }
            })
        });
    }
    $('.mobile-navigation').on('click', function () {
        $('body').addClass('box-mobile-menu-open');
    });
    $('#box-mobile-menu .close-menu, .body-overlay').on('click', function () {
        $('body').removeClass('box-mobile-menu-open');
    });
}
function nagrand_get_scrollbar_width() {
    var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
        $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
        inner = $inner[0],
        outer = $outer[0];
    jQuery('body').append(outer);
    var width1 = inner.offsetWidth;
    $outer.css('overflow', 'scroll');
    var width2 = outer.clientWidth;
    $outer.remove();
    return (width1 - width2);
}
/* ---------------------------------------------
 Resize mega menu
 --------------------------------------------- */
function nagrand_resizeMegamenu() {
    var window_size = jQuery('body').innerWidth();
    window_size += nagrand_get_scrollbar_width();
    if (window_size > 991) {
        if ($('#header .main-menu-wrapper').length > 0) {
            var container = $('#header .main-menu-wrapper');
            if (container != 'undefined') {
                var container_width = 0;
                container_width = container.innerWidth();
                var container_offset = container.offset();
                setTimeout(function () {
                    $('.main-menu .item-megamenu').each(function (index, element) {
                        $(element).children('.megamenu').css({'max-width': container_width + 'px'});
                        var sub_menu_width = $(element).children('.megamenu').outerWidth();
                        var item_width = $(element).outerWidth();
                        $(element).children('.megamenu').css({'left': '-' + (sub_menu_width / 2 - item_width / 2) + 'px'});
                        var container_left = container_offset.left;
                        var container_right = (container_left + container_width);
                        var item_left = $(element).offset().left;
                        var overflow_left = (sub_menu_width / 2 > (item_left - container_left));
                        var overflow_right = ((sub_menu_width / 2 + item_left) > container_right);
                        if (overflow_left) {
                            var left = (item_left - container_left);
                            $(element).children('.megamenu').css({'left': -left + 'px'});
                        }
                        if (overflow_right && !overflow_left) {
                            var left = (item_left - container_left);
                            left = left - ( container_width - sub_menu_width );
                            $(element).children('.megamenu').css({'left': -left + 'px'});
                        }
                    })
                }, 100);
            }
        }
    }
}
new WOW().init();

function creat_init_owl_carousel() {

    $('.slide-owl-carousel').each(function () {
        var $this = $(this),
            $loop = $this.attr('data-loop') == 'yes',
            $numberItem = parseInt($this.attr('data-number'), 10),
            $Nav = $this.attr('data-navControl') == 'yes',
            $Dots = $this.attr('data-Dots') == 'yes',
            $autoplay = $this.attr('data-autoPlay') == 'yes',
            $autoplayTimeout = parseInt($this.attr('data-autoPlayTimeout'), 10),
            $marginItem = parseInt($this.attr('data-margin'), 10),
            $rtl = $this.attr('data-rtl') == 'yes',
            $resNumber; // Responsive Settings
        $numberItem = (isNaN($numberItem)) ? 1 : $numberItem;
        $autoplayTimeout = (isNaN($autoplayTimeout)) ? 4000 : $autoplayTimeout;
        $marginItem = (isNaN($marginItem)) ? 0 : $marginItem;
        switch ($numberItem) {
            case 1 :
                $resNumber = {
                    0: {
                        items: 1
                    }
                };
                break;
            case 2 :
                $resNumber = {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: $numberItem
                    }
                };
                break;
            case 3 :
            case 4 :
                $resNumber = {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 2
                    },
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: $numberItem
                    }
                };
                break;
            default : // $numberItem > 4
                $resNumber = {
                    0: {
                        items: 1
                    },
                    480: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: $numberItem
                    }
                };
                break;
        } // Endswitch

        $(this).owlCarousel({
            loop: $loop,
            nav: $Nav,
            navText: ['', ''],
            dots: $Dots,
            autoplay: $autoplay,
            autoplayTimeout: $autoplayTimeout,
            margin: $marginItem,
            //responsiveClass:true,
            rtl: $rtl,
            responsive: $resNumber,
            autoplayHoverPause: true,
            //center: true,
            onRefreshed: function () {
                var total_active = $this.find('.owl-item.active').length;
                var i = 0;
                $this.find('.owl-item').removeClass('active-first active-last');
                $this.find('.owl-item.active').each(function () {
                    i++;
                    if (i == 1) {
                        $(this).addClass('active-first');
                    }
                    if (i == total_active) {
                        $(this).addClass('active-last');
                    }
                });
            },
            onTranslated: function () {
                var total_active = $this.find('.owl-item.active').length;
                var i = 0;
                $this.find('.owl-item').removeClass('active-first active-last');
                $this.find('.owl-item.active').each(function () {
                    i++;
                    if (i == 1) {
                        $(this).addClass('active-first');
                    }
                    if (i == total_active) {
                        $(this).addClass('active-last');
                    }
                });
            },
            onResized: function () {
            }
        });
    });
}

creat_init_owl_carousel();

function portfolio_isotope() {
    // init Isotope
    var $grid = $('.grid').isotope({
        itemSelector: '.portfolio-item',
        masonry: {
            columnWidth: '.isotope-sizer'
        },
        getSortData: {
            name: '.name',
            symbol: '.symbol',
            number: '.number parseInt',
            category: '[data-category]',
            weight: function (itemElem) {
                var weight = $(itemElem).find('.weight').text();
                return parseFloat(weight.replace(/[\(\)]/g, ''));
            }
        }
    });

    // filter functions
    var filterFns = {
        // show if number is greater than 50
        numberGreaterThan50: function () {
            var number = $(this).find('.number').text();
            return parseInt(number, 10) > 50;
        },
        // show if name ends with -ium
        ium: function () {
            var name = $(this).find('.name').text();
            return name.match(/ium$/);
        }
    };

    // filter button click
    $('#filters').on('click', '.portfolio-button', function () {
        var filterValue = $(this).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[filterValue] || filterValue;
        $grid.isotope({filter: filterValue});
    });

    //  sort button click
    $('#sorts').on('click', '.portfolio-button', function () {
        var sortByValue = $(this).attr('data-sort-by');
        $grid.isotope({sortBy: sortByValue});
    });

    // change is-checked class on buttons
    $('.porfolio-buttons').each(function (i, buttonGroup) {
        var $buttonGroup = $(buttonGroup);
        $buttonGroup.on('click', '.portfolio-button', function () {
            $buttonGroup.find('.is-checked').removeClass('is-checked');
            $(this).addClass('is-checked');
        });
    });
}

// smooths croll
function smooth_scroll() {
    $(function () {
        // This will select everything with the class smoothScroll
        // This should prevent problems with carousel, scrollspy, etc...
        $('a[href*="#"]:not([href="#"]):not([href*="#mm-"]):not([href="#primary-navigation"])').not('a[data-toggle="tab"]').on('click', function () {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').stop().animate({
                        scrollTop: target.offset().top
                    }, 1000); // The number here represents the speed of the scroll in milliseconds
                    return false;
                }
            }
        });
    });
}

// Change the speed to whatever you want
// Personally i think 1000 is too much
// Try 800 or below, it seems not too much but it will make a difference

$(window).on('scroll', function () {
    if ($(window).scrollTop() > 100) {
        $('.main-header.header-fixed').addClass('menu-bg');
    } else {
        $('.main-header.header-fixed').removeClass('menu-bg')
    }
});
function nagrand_google_maps() {
    if ($('.nagrand-google-maps').length <= 0) {
        return;
    }
    $('.nagrand-google-maps').each(function () {
        var $this = $(this),
            $id = $this.attr('id'),
            $title_maps = $this.attr('data-title_maps'),
            $phone = $this.attr('data-phone'),
            $email = $this.attr('data-email'),
            $zoom = parseInt($this.attr('data-zoom'), 10),
            $latitude = $this.attr('data-latitude'),
            $longitude = $this.attr('data-longitude'),
            $address = $this.attr('data-address'),
            $map_type = $this.attr('data-map-type'),
            $pin_icon = $this.attr('data-pin-icon'),
            $modify_coloring = true,
            $saturation = $this.attr('data-saturation'),
            $hue = $this.attr('data-hue'),
            $map_style = $this.data('map-style'),
            $styles;

        if ($modify_coloring == true) {
            var $styles = [
                {
                    stylers: [
                        {hue: $hue},
                        {invert_lightness: false},
                        {saturation: $saturation},
                        {lightness: 1},
                        {
                            featureType: "landscape.man_made",
                            stylers: [{
                                visibility: "on"
                            }]
                        }
                    ]
                }, {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#e9e9e9"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 17
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 29
                        },
                        {
                            "weight": 0.2
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 18
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f5f5f5"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#dedede"
                        },
                        {
                            "lightness": 21
                        }
                    ]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [
                        {
                            "visibility": "on"
                        },
                        {
                            "color": "#ffffff"
                        },
                        {
                            "lightness": 16
                        }
                    ]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [
                        {
                            "saturation": 36
                        },
                        {
                            "color": "#333333"
                        },
                        {
                            "lightness": 40
                        }
                    ]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "color": "#f2f2f2"
                        },
                        {
                            "lightness": 19
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.fill",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 20
                        }
                    ]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry.stroke",
                    "stylers": [
                        {
                            "color": "#fefefe"
                        },
                        {
                            "lightness": 17
                        },
                        {
                            "weight": 1.2
                        }
                    ]
                }
            ];
        }
        var map;
        var bounds = new google.maps.LatLngBounds();
        var mapOptions = {
            zoom: $zoom,
            panControl: true,
            zoomControl: true,
            mapTypeControl: true,
            scaleControl: true,
            draggable: true,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId[$map_type],
            styles: $styles
        };

        map = new google.maps.Map(document.getElementById($id), mapOptions);
        map.setTilt(45);

        // Multiple Markers
        var markers = [];
        var infoWindowContent = [];

        if ($latitude != '' && $longitude != '') {
            markers[0] = [$address, $latitude, $longitude];
            infoWindowContent[0] = [$address];
        }

        var infoWindow = new google.maps.InfoWindow(), marker, i;

        for (i = 0; i < markers.length; i++) {
            var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
            bounds.extend(position);
            marker = new google.maps.Marker({
                position: position,
                map: map,
                title: markers[i][0],
                icon: $pin_icon
            });

            map.fitBounds(bounds);
        }

        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function (event) {
            this.setZoom($zoom);
            google.maps.event.removeListener(boundsListener);
        });
    });
}
$(document).on("scroll", function () {
    200 < $(window).scrollTop() ? $(".backtotop").addClass("active") : $(".backtotop").removeClass("active")
}),
    $(window).on("resize", function () {
        nagrand_clone_main_menu();
        nagrand_resizeMegamenu();
    });
$(document).on("ready", function () {
    nagrand_google_maps();
    nagrand_clone_main_menu();
    nagrand_resizeMegamenu();
    box_mobile_menu();
});
$(window).on("load", function () {
    smooth_scroll();
    portfolio_isotope();
    nagrand_clone_main_menu();
    box_mobile_menu();
});
nagrand_video();
//for counter-up
$('.counter').counterUp({
    delay: 10,
    time: 1000
});

