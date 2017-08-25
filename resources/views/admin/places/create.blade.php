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
            <input id="searchTextField" type="text" placeholder="Search..." size="20">
            <div id="map"></div>
            <script>
                var map;
                var infowindow;
                var geocoder;
                var data = {};
                var markers = [];
                var places;
                var pos = {};
                var detailsOfPlace = {};
                

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

                    initAutocomplete();
                }

                function initAutocomplete(){
                    var options = {
                      componentRestrictions: {country: "AZ"}
                    };
                    var searchInput = document.getElementById('searchTextField');
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
                        var inputBox = '<br><input id="discountInput" type="text" placeholder="Endirim..."></input><button onclick="addPlace()">Əlavə et</button>'
                        infowindow.setContent(place.name+'<br>'+place.place_id + inputBox);
                        infowindow.open(map, this);
                    });
                    markers.push(marker);
                }

                function addPlace(){
                   detailsOfPlace.discount = parseInt(discountInput.value);
                   console.log(detailsOfPlace);
                   $.ajax({                    
                      url: '/admin_places_add',     
                      type: 'post', // performing a POST request
                      data : {
                        "_token": "{{ csrf_token() }}",
                        detailsOfPlace
                      },
                      dataType: 'json',                   
                      success: function(data)         
                      {

                      } 
                    });
                }

                function getCurrentPosition(category){
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function(position) {
                            var pos = {
                                lat: position.coords.latitude,
                                lng: position.coords.longitude
                            };
                            geocoder = new google.maps.Geocoder();
                            geocoder.geocode( { 'location': pos}, function(results, status) {
                                if (status == 'OK') {
                                    map.setCenter(pos);
                                    clearMarkers();
                                    createMarker(results[0]);
                                } else {
                                    alert('Geocode was not successful for the following reason: ' + status);
                                }
                            });
                        });
                    } else {
                            // Browser doesn't support Geolocation
                            handleLocationError(false, infoWindow, map.getCenter());
                      }
                    }

               

            </script>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection


