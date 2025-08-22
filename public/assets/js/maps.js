// Default infoBox Rating Type
var infoBoxRatingType = 'star-rating';

(function ($) {
    "use strict";

    // marker icon
    var markerIcon = {
        anchor: new google.maps.Point(10, 15),
        url: 'images/map-marker.png',
    };

    /*================ Start ZoomControl  ===============*/
    // Create the DIV to hold the control and call the ZoomControl() constructor
    // passing in this DIV.
    var zoomControlDiv = document.createElement('div');
    zoomControlDiv.index = 1;

    function ZoomControl(controlDiv, map) {
        // Creating divs & styles for custom zoom control
        controlDiv.style.margin = '10px';
        controlDiv.className = 'zoom-control';

        // Creating div for zoomIn
        var zoomInButton = document.createElement('div');
        zoomInButton.className = 'zoom-in';
        zoomInButton.setAttribute('title', 'Zoom in');
        controlDiv.appendChild(zoomInButton);

        // Creating icon element for zoomIn
        var zoomInIcon = document.createElement('i');
        zoomInIcon.className = 'fal fa-plus';
        zoomInButton.appendChild(zoomInIcon);

        // Creating div for zoomOut
        var zoomOutButton = document.createElement('div');
        zoomOutButton.className = 'zoom-out';
        zoomOutButton.setAttribute('title', 'Zoom out');
        controlDiv.appendChild(zoomOutButton);

        // Creating icon element for zoomOut
        var zoomOutIcon = document.createElement('i');
        zoomOutIcon.className = 'fal fa-minus';
        zoomOutButton.appendChild(zoomOutIcon);

        // Setup the click event listener - zoomIn
        google.maps.event.addDomListener(zoomInButton, 'click', function() {
            map.setZoom(map.getZoom() + 1);
        });

        // Setup the click event listener - zoomOut
        google.maps.event.addDomListener(zoomOutButton, 'click', function() {
            map.setZoom(map.getZoom() - 1);
        });

    }
    /*================ End ZoomControl  ===============*/

    /*==================================================
            Start Main Map
     =================================================*/
    function mainMapFunc() {
        var ib = new InfoBox();

        /*======= Start location data ======*/
        function locationData(locationURL, locationImg, locationTitle, locationAddress, locationRating, locationRatingCounter, locationStatus) {
            return(''+
                '<span class="close-button" title="Close"><i class="fal fa-times"></i></span>'+
                '<a href="'+ locationURL +'" class="popup-box-img-container">'+
                '<img src="'+ locationImg +'" alt="Listhub - Directory & Listing HTML5 Template">'+
                '</a>'+
                '<div class="popup-box-content">'+
                '<h3>'+'<a href="'+ locationURL +'">'+ locationTitle +'</a>'+'</h3>'+
                '<p>'+ locationAddress +'</p>'+
                '<div class="'+infoBoxRatingType+'" data-rating="'+locationRating+'"><div class="rating-counter">('+locationRatingCounter+' reviews)</div></div>'+
                '<div class="popup-box-status">'+ locationStatus +'</div>'+
                '</div>')
        }

        /*======= Start locations ======*/
        var locations = [
            [ locationData(
                'listing-details.html',
                'images/img1.jpg',
                'Cuisine of Nepal',
                '964 School Street, New York',
                '3.5',
                '12',
                'Open - until 11:59 PM'),
                40.6974034,
                -74.1197631,
                1,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img2.jpg',
                'The Spice Jar',
                'Bishop Avenue, New York',
                '5.0',
                '23',
                'Open - until 11:59 PM'),
                40.6452228,
                -74.015037,
                2,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img3.jpg',
                'Edri Construction',
                '778 Country Street, New York',
                '2.0',
                '17',
                'Open now'),
                40.6840442,
                -73.8931973,
                3,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img4.jpg',
                'Basa Seafood Express',
                '2726 Shinn Street, New York',
                '5.0',
                '31',
                'Open - until 11:59 PM'),
                40.6789413,
                -73.9209135,
                4,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img5.jpg',
                'Ultra Electric Co',
                '1512 Duncan Avenue, New York',
                '3.5',
                '46',
                'Closed - Open at 6:30 AM - PM'),
                40.6721704,
                -73.9505706,
                5,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img6.jpg',
                'Taz Auto Detailing',
                '215 Terry Lane, New York',
                '4.5',
                '15',
                'Closed - Open at 6:30 AM - PM'),
                40.7312782,
                -74.2170747,
                6,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img7.jpg',
                'The Metro Hotel',
                '2726 Shinn Street, New York',
                '5.0',
                '31',
                'Closed - Open at 6:30 AM - PM'),
                40.7484307,
                -74.1550198,
                7,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img8.jpg',
                'The Front Porch',
                '2726 Shinn Street, New York',
                '5.0',
                '31',
                'Open - until 11:59 PM'),
                40.6615277,
                -74.2129692,
                8,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img9.jpg',
                'True Laurel',
                '2726 Shinn Street, New York',
                '5.0',
                '31',
                'Open - until 11:59 PM'),
                40.6962171,
                -74.2847485,
                9,
                markerIcon
            ],
            [ locationData(
                'listing-details.html',
                'images/img10.jpg',
                'Hotel Kabuki',
                '2726 Shinn Street, New York',
                '5.0',
                '31',
                'Open - until 11:59 PM'),
                40.7919692,
                -74.2979888,
                10,
                markerIcon
            ],

        ];

        /*======= Start listing rating ======*/
        google.maps.event.addListener(ib, "domready", function () {
            if (infoBoxRatingType) {
                starRating('.infoBox .'+infoBoxRatingType+'');
            }
        });

        var myLatLng = new google.maps.LatLng(40.728157, -74.077644);

        var mapOptions = {
            zoom: 11,
            scrollwheel: false,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            fullscreenControl: true,
            streetViewControl: false,
            // Map styles
            styles: [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
        };

        /*======= Start main map ======*/
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);

        /*======= Star info box ======*/
        var boxText = document.createElement("div");
        boxText.className = "popup-box";
        var currentInfoBox;
        var boxOptions = {
            content: boxText,
            disableAutoPan: true,
            alignBottom: true,
            pixelOffset: new google.maps.Size(-146, -35),
            boxStyle: {
                width: "280px"
            },
            closeBoxMargin: "0",
            closeBoxURL: ""
        };

        var markerCluster, marker, i;
        var allMarkers = [];

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                icon: locations[i][4],
                id: i
            });
            allMarkers.push(marker);
            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    ib.setOptions(boxOptions);
                    boxText.innerHTML = locations[i][0];
                    ib.close();
                    ib.open(map, marker);
                    currentInfoBox = marker.id;
                    var latLng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    map.panTo(latLng);
                    map.panBy(0, -110);
                    google.maps.event.addListener(ib, 'domready', function () {
                        $('.close-button').on('click', function (e) {
                            e.preventDefault();
                            ib.close();
                        });
                    });
                }
            })(marker, i));
        }

        /*======= Start marker cluster ==========*/
        var clusterStyles = [{
            textSize: 14,
            textColor: 'white',
            url: '',
            height: 31,
            width: 31,
        }];
        var options = {
            imagePath: '../images/',
            styles: clusterStyles,
            minClusterSize: 2
        };
        markerCluster = new MarkerClusterer(map, allMarkers, options);
        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

        /*====== Custom zoom control =======*/
        new ZoomControl(zoomControlDiv, map);
        map.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);


    }

    // Main Map Initialize
    var mainMapInit = document.getElementById('map');
    if (typeof (mainMapInit) != 'undefined' && mainMapInit != null) {
        google.maps.event.addDomListener(window, 'load', mainMapFunc);
    }

    /*=========== End Main Map ===============*/

    /*============================================
            Start Single Map
     ===========================================*/
    function singleMapFunc() {
        var singleMapId = $( '#map-single');
        var myLatLng = new google.maps.LatLng({
            lng: singleMapId.data('longitude'),
            lat: singleMapId.data('latitude'),
        });
        var mapOptions = {
            zoom: 13,
            scrollwheel: false,
            center: myLatLng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            zoomControl: false,
            mapTypeControl: false,
            fullscreenControl: true,
            streetViewControl: false,
            // Map styles
            styles: [
                {
                    "featureType": "administrative",
                    "elementType": "labels.text",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "transit.station.rail",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        },
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "on"
                        }
                    ]
                }
            ]
        };

        var singleMap = new google.maps.Map(document.getElementById('map-single'), mapOptions);

        /*===== Marker ======*/
        new google.maps.Marker({
            position: myLatLng,
            map: singleMap,
            icon: markerIcon,
        });

        /*====== Custom zoom control init =======*/
        new ZoomControl(zoomControlDiv, singleMap);
        singleMap.controls[google.maps.ControlPosition.LEFT_TOP].push(zoomControlDiv);

    }

    // Single Map Initialize
    var singleMapInit =  document.getElementById('map-single');
    if (typeof(singleMapInit) != 'undefined' && singleMapInit != null) {
        google.maps.event.addDomListener(window, 'load',  singleMapFunc);
    }

    /*================ End Single Map ===============*/

})(this.jQuery);