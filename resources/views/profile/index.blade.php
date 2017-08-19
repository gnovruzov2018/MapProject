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
                @include('partials.sidebar-content-profile')
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Şəxsi Kabinet
            </h1>

        </section>
        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle"
                                 src="admin_Lte/image/profil_image/{{Auth::user()->avatar}}" alt="User profile picture">


                            <h3 class="profile-username text-center">{{Auth::user()->name.' '.Auth::user()->surname }}</h3>

                            <p class="text-muted text-center">{{Auth::user()->email }}</p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Followers</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Following</b> <a class="pull-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Friends</b> <a class="pull-right">13,287</a>
                                </li>
                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#activity" data-toggle="tab">Profil Şəkli</a></li>
                            <li><a href="#settings" data-toggle="tab">Hesabı Yenilə</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <form enctype="multipart/form-data" class="form-horizontal"
                                      action="{{url('/profileImage')}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="avatar" class="col-sm-2 control-label">Şəkil</label>
                                        <div class="col-sm-10">
                                            <div class="input-group image-preview">
                                                <input type="text" class="form-control image-preview-filename"
                                                       disabled="disabled">
                                                <!-- don't give a name === doesn't send on POST/GET -->
                                                <span class="input-group-btn">
                                            <!-- image-preview-clear button -->
                                                     <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                                                <span class="glyphicon glyphicon-remove"></span> Sil
                                                    </button>
                                                    <!-- image-preview-input -->
                                                    <div class="btn btn-default image-preview-input">
                                                        <span class="glyphicon glyphicon-folder-open"></span>
                                                        <span class="image-preview-input-title">Şəkil Seçin</span>
                                                        <input type="file" accept="image/png, image/jpeg, image/gif" name="avatar"/>
                                                        <!-- rename it -->
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- COMPONENT END -->

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <input type="submit" class="btn btn-success" value="Yenilə">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Ad</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="newName"
                                                   placeholder="Ad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Soyad</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputEmail" name="newSurname"
                                                   placeholder="Soyad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Ata Adı</label>

                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName" name="newFatherName"
                                                   placeholder="Ata Adı">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputName" name="newEmail"
                                                   placeholder="Email">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Yenilə</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection