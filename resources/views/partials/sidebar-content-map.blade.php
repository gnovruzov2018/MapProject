<div hidden>
    {{$cities = App\City::all(),
    $categories = App\Category::all()}}
</div>
<li class="header">Cities</li>
<li>
    <a href="#" onclick="getCurrentPosition('')">
        <i class="fa fa-map-marker"></i> <span>My Location</span>
    </a>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-map-marker"></i> <span>Cities</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>

    <ul class="treeview-menu">
        @foreach($cities as $city)
            <li><a href="#" onclick="findPlace('{{$city->name}}')"><i class="fa fa-circle-o"></i> {{$city->display_name}}</a></li>
        @endforeach
    </ul>
</li>
<li class="treeview">
    <a href="#">
        <i class="fa fa-tags"></i> <span>Categories</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
    </a>
    <ul class="treeview-menu">
        @foreach($categories as $category)
            <li><a href="#" onclick="findNearyByPlacesByCategory('{{$category->name}}','{{$category->display_name}}')"><i class="fa fa-circle-o"></i> {{$category->display_name}}</a></li>
        @endforeach
    </ul>
</li>
@if(Auth::user()->isAdmin())
<li class="treeview">
    <a href="#">
        <i class="fa fa-bars"></i> <span>Places</span>
        <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
            <li><a href="#" ><i class="fa fa-plus"></i>Add Place</a></li>
            <li><a href="/admin/places/index" ><i class="fa fa-eye"></i>See Places</a></li>
    </ul>
</li>
@endif