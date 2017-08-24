@extends('layouts.main')
@section('title',' Profile')

@section('content')

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

            <div class="row">
                <div class="col-xs-12">

                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Place ID</th>
                                    <th>Name</th>
                                    <th>Discount (%)</th>
                                    <th>Location</th>
                                    <th>Category</th>
                                    <th>Create Date</th>
                                    <th>Expire Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($places as $place)
                                    <tr>
                                        <td>{{$place->place_id}}</td>
                                        <td>{{$place->name}}</td>
                                        <td>{{$place->discount}}</td>
                                        <td>{{$place->city->name}}</td>
                                        <td>{{$place->category->name}}</td>
                                        <td>{{$place->created_at}}</td>
                                        <td>{{$place->updated_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Place ID</th>
                                    <th>Name</th>
                                    <th>Discount (%)</th>
                                    <th>Location</th>
                                    <th>Category</th>
                                    <th>Create Date</th>
                                    <th>Expire Date</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection