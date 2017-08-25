@extends('layouts.main')
@section('title',' Home')


@section('content')
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                @include('partials.sidebar-header')
            </div>
            <!-- search form -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" style="margin-right: 34px"  id="searchTextForUser"  class="form-control" placeholder="Search...">
                </div>
            </form>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                @include('partials.sidebar-content-map')
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>

        <!-- Main content -->
        <section class="content">
            <div id="map"></div>
            <script>
            
                var map;
                var infowindow;
                var geocoder;
                var clickedPlace = '';
                var clickedCategory = '';
                var markers = [];
                var places;
                var pos = {};

                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center:{lat: -33.867, lng: 151.195},
                        zoom: 15
                    });
                    infowindow = new google.maps.InfoWindow;
                    getCurrentPosition('');
                    places = [
                        @foreach ($places as $place)
                        [ "{{ $place->id }}", "{{ $place->place_id }}", "{{ $place->name }}", "{{ $place->discount }}", "{{ $place->city->name }}", "{{ $place->category->name }}" ],
                        @endforeach
                    ];

                    google.maps.event.addListener(map, 'click', function(event) {
                        placeMarker(event.latLng);
                    });
                    initAutocomplete();
                }
                function initAutocomplete(){
                    var options = {
                        componentRestrictions: {country: "AZ"}
                    };
                    var searchInput = document.getElementById('searchTextForUser');
                    var autocomplete = new google.maps.places.Autocomplete(searchInput, options);

                    autocomplete.addListener('place_changed', function() {
                        var request = {
                            query: searchInput.value
                        }
                        service = new google.maps.places.PlacesService(map);
                        service.textSearch(request, function(results, status){
                            if (status === google.maps.places.PlacesServiceStatus.OK) {
                                clearMarkers();
                                createMarker(results[0]);
                                map.setCenter(results[0].geometry.location);
                                detailsOfPlace.id = results[0].id;
                                detailsOfPlace.name = results[0].name;
                            }
                        });
                    });
                }
                function clearMarkers() {
                  for (var i = 0; i < markers.length; i++) {
                  markers[i].setMap(null);
                  }
                  markers = [];
                }

                function placeMarker(location) {
                    icon = {
                        url: 'marker-icons/default.svg', // url
                        scaledSize: new google.maps.Size(35, 43), // scaled size
                        origin: new google.maps.Point(0,0), // origin
                        anchor: new google.maps.Point(12, 45) // anchor
                    };
                    var marker = new google.maps.Marker({
                        position: location, 
                        icon: icon,
                        map: map
                    });

                    clickedPlace = '';
                    var lat = location.lat();
                    var lng = location.lng();
                    pos = new google.maps.LatLng(lat, lng);

                    clearMarkers();
                    markers.push(marker);
                }

                function findNearyByPlacesByCategory(placeCategory,displayname) {
                    clickedCategory = placeCategory;
                    geocodePlace(pos, clickedPlace, clickedCategory);
                }

                function findNearByPlaces(request) {
                    var service = new google.maps.places.PlacesService(map);
                    service.nearbySearch(request, callback);
                }

                function callback(results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        for (var i = 0; i < results.length; i++) {
                            for (var j = 0; j<places.length;j++){
                                if (places[j][1]==results[i].place_id){
                                    createMarker(results[i]);
                                }
                            }
                        }
                    }
                }

                function createMarker(place) {
                    var placeLoc = place.geometry.location;
                    var icon = '';
                    if(place.types.indexOf('hospital')>-1){
                         icon = {
                            url: 'marker-icons/hospital.png', // url
                            scaledSize: new google.maps.Size(25, 50), // scaled size
                            origin: new google.maps.Point(0,0), // origin
                            anchor: new google.maps.Point(0, 0) // anchor
                        };
                    }else if(place.types.indexOf('school')>-1){
                        icon = {
                            url: 'marker-icons/school.png', // url
                            scaledSize: new google.maps.Size(30, 45), // scaled size
                            origin: new google.maps.Point(0,0), // origin
                            anchor: new google.maps.Point(0, 0) // anchor
                        };
                    }else if(place.types.indexOf('restaurant')>-1){
                        icon = {
                            url: 'marker-icons/restaurant.png', // url
                            scaledSize: new google.maps.Size(35, 47), // scaled size
                            origin: new google.maps.Point(0,0), // origin
                            anchor: new google.maps.Point(19, 45) // anchor
                        };
                    }else if(place.types.indexOf('university')>-1){
                        icon = {
                            url: 'marker-icons/university.png', // url
                            scaledSize: new google.maps.Size(30, 50), // scaled size
                            origin: new google.maps.Point(0,0), // origin
                            anchor: new google.maps.Point(0, 0) // anchor
                        };
                    }else{
                         icon = {
                            url: 'marker-icons/default.svg', // url
                            scaledSize: new google.maps.Size(35, 43), // scaled size
                            origin: new google.maps.Point(0,0), // origin
                            anchor: new google.maps.Point(12, 45) // anchor
                        };
                    }

                    var marker = new google.maps.Marker({
                        map: map,
                        animation: google.maps.Animation.DROP,
                        icon: icon,
                        position: placeLoc
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(place.name+'<br>'+place.place_id);
                        infowindow.open(map, this);
                    });
                    markers.push(marker);
                }

                function findPlace(place) {
                    clickedPlace = place;
                    clickedCategory = '';
                    pos = null;
                    geocodePlace(pos, clickedPlace, clickedCategory);
                }

                function getCurrentPosition(category){
                    clickedPlace='';
                    pos = null;
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            geocodePlace(pos, '', category);
                        });
                    } else {
                            // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                      }
                    }

                function geocodePlace(location, address, category){
                    clearMarkers();
                    geocoder = new google.maps.Geocoder();
                    if(location==null && address==''){
                        getCurrentPosition(category);
                    } else {
                        geocoder.geocode({location: location, address: address}, function(results, status) {
                        if (status === 'OK') {
                            var pos = results[0].geometry.location;
                            map.setCenter(pos);
                            createMarker(results[0]);
                            if (category!='' ) {
                                var request = {
                                    location: pos,
                                    radius: '1000',
                                    type: [category]
                                };
                                findNearByPlaces(request);
                                map.setZoom(15);
                            }
                            clickedCategory = '';
                        } else {
                             alert('Geocode was not successful for the following reason: ' + status);
                          }
                        });
                    }
                }


            </script>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


