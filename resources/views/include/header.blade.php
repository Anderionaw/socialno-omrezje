<header class="header-top" header-theme="light">
    
    <div class="container-fluid">

        <div class="d-flex justify-content-between">

            <div class="top-menu d-flex align-items-center">

                <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>

            </div>

            <a href="{{ URL('admin/users/search') }}" class="btn btn-sm btn-primary"><i class="ik ik-search"></i> {{ __('Išči uporabnike') }}</a>

            <a href="{{ URL('admin/objave/create') }}" class="ajax_modal btn btn-sm btn-primary" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Nova objava') }}"><i class="ik ik-plus-square"></i> {{ __('Objavi') }}</a>


            <div class="top-menu d-flex align-items-center">

                    <button class="nav-link mr-2" title="{{ __('Domov') }}">
                        <a  href="{{ URL('/') }}">
                        <i class="ik ik-home"></i> 
                    </a>
                    </button>


                <button type="button" id="navbar-fullscreen" class="nav-link" title="{{ __('Celozaslonski način') }}"><i class="ik ik-maximize"></i></button>

                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="avatar" src="{{ asset('img/user.jpg')}}" alt=""></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ url('admin/users/view/' . Auth::user()->id) }}"><i class="ik ik-user dropdown-icon"></i> {{ __('Moj profil') }}</a>
                        <a class="dropdown-item" href="{{ url('admin/users/profile/' . Auth::user()->id) }}"><i class="ik ik-settings dropdown-icon"></i> {{ __('Uredi profil') }}</a>
                        <a class="dropdown-item" href="{{ url('admin/shranjeneobjave/shranjene') }}"><i class="ik ik-bookmark dropdown-icon"></i> {{ __('Shranjene objave') }}</a>
                        <a class="dropdown-item" href="{{ url('logout') }}">
                            <i class="ik ik-power dropdown-icon"></i> 
                            {{ __('Odjava') }}
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</header>