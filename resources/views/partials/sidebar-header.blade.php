    <div class="pull-left image">
        <img src="/admin_Lte/image/profil_image/{{Auth::user()->avatar}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
        <p>{{Auth::user()->name.' '.Auth::user()->surname }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>

