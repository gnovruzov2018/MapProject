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
            <span id="tags" style="margin-top: -25px">
                <p><b>Tags: Şəhər </b><span id="city"><i>[yoxdur]</i></span> <b>Kateqoriya</b> <span id="category"><i>[yoxdur]</i></span> </p>
            </span>
            <div id="map"></div>
            <script>
                var map;
                var infowindow;
                var geocoder;
                var clickedPlace = '';
                var clickedCategory = '';
                function initMap() {
                    map = new google.maps.Map(document.getElementById('map'), {
                        center:{lat: -33.867, lng: 151.195},
                        zoom: 13
                    });
                    infowindow = new google.maps.InfoWindow;
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                             var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            var request = {
                                location: pos,
                                radius: '500',
                                type: ['restaurant']
                            };
                            map.setCenter(pos);
                            var marker = new google.maps.Marker({
                                map: map,
                                position: pos
                            });

                        }, function() {
                            handleLocationError(true, infoWindow, map.getCenter());
                        });
                    } else {
                        // Browser doesn't support Geolocation
                        handleLocationError(false, infoWindow, map.getCenter());
                    }

                }

                function findNearyByPlacesByCategory(placeCategory,displayname) {
                    clickedCategory = placeCategory;
                    document.getElementById('category').innerHTML = '[' + displayname + ']';
                    if (clickedPlace != '') {
//php
                        geocodeAddress(map, clickedPlace, clickedCategory);
                    }else {
                        alert('Zəhmət olmasa '+displayname+' axtarmaq istədiyiniz şəhəri seçin.')
                    }
                }

                function findNearByPlaces(request) {
                    var service = new google.maps.places.PlacesService(map);
                    service.nearbySearch(request, callback);
                }

                function callback(results, status) {
                    if (status === google.maps.places.PlacesServiceStatus.OK) {
                        for (var i = 0; i < results.length; i++) {
                            createMarker(results[i]);
                        }
                    }
                }

                function createMarker(place) {
                    var placeLoc = place.geometry.location;
                    var marker = new google.maps.Marker({
                        map: map,
                        position: placeLoc
                    });
                    google.maps.event.addListener(marker, 'click', function() {
                        infowindow.setContent(place.name);
                        infowindow.open(map, this);
                    });
                }
                function findPlace(place) {
                    clickedPlace = place;
                    clickedCategory = '';
                    document.getElementById('category').innerHTML = '<i>[yoxdur]</i>';
                    document.getElementById('city').innerHTML = '['+clickedPlace+']';
                    geocodeAddress(map, clickedPlace,clickedCategory);
                }
                function geocodeAddress(resultsMap, address, category) {
                    geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'address': address}, function(results, status) {
                        if (status === 'OK') {
                            resultsMap.setCenter(results[0].geometry.location);
                            createMarker(results[0]);
                            var request = {
                                location: results[0].geometry.location,
                                radius: '1000',
                                type: [category]
                            };
                            if (category!='' ) {
                                findNearByPlaces(request);
                            }
//                            else {
//                                alert('dyc');
//                            }
                            clickedCategory = '';
                        } else {
                            alert('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }
            </script>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


