<?php   use \App\Http\Controllers\Admin\PrijateljstvoController; 
?>

<div class="app-sidebar colored">
    
    <div class="sidebar-header">

        <a class="header-brand" href="{{route('admin.dashboard')}}">

            {{-- <div class="logo-img">
               <img height="40" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="{{ __('app_main_title') }}"> 
            </div> --}}
            
        </a>

        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>

        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>

    </div>

    @php
        $segment0= request()->segment(1);    
        $segment1 = request()->segment(2);
        $segment2 = request()->segment(3);
    @endphp
    
    <div class="sidebar-content">

        <div class="nav-container">

            <nav id="main-menu-navigation" class="navigation-main">

                @can('view_dashboard')

                    <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }}">
                        <a href="{{ url('/') }}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Nadzorna plošča') }}</span></a>
                    </div>

                @endcan

                <?php $prosnje = PrijateljstvoController::izpisiProsnje(Auth::user()->id); ?>
                @if(count($prosnje) > 0)
                    <div class="nav-lavel">{{ __('PROŠNJE')}} </div>

                    @foreach($prosnje as $key=>$prosnja)
                    <div class="nav-item prosnja-display">
                        <a href="{{ URL('admin/users/view/' . $prosnja->user2->id) }}"><i class="ik ik-user"></i>{{$prosnja->user2->name}}</a>
                        <button data-url="{{route('admin.users.sprejmiprijatelja')}}" data-id1="{{Auth::user()->id}}" data-id2="{{$prosnja->user2->id}}" class="dodaj-uporabnika-button btn btn-success mr-1 ml-20">Sprejmi</button>
                        <button data-url="{{route('admin.users.zavrniprijatelja')}}" data-id1="{{Auth::user()->id}}" data-id2="{{$prosnja->user2->id}}" class="zavrni-uporabnika-button btn btn-danger">Zavrni</button>
                    </div>
                    @endforeach
                @endif


                <div class="nav-lavel">{{ __('SPOROČILA')}} </div>
                <?php  $prijatelji = PrijateljstvoController::izpisiPrijatelje(Auth::user()->id)?>

                @foreach($prijatelji as $key=>$prijatelj)
                    <div class="nav-item prijatelj-display">
                        <a href="{{URL('admin/sporocila/show/' . $prijatelj->id)}}">{{$prijatelj->name}}</a>
                    </div>
                @endforeach


        <!------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------->

                @if(request()->demo)
  
                    
                        <div class="nav-lavel">{{ __('Documentation')}} </div>
                        <div class="nav-item {{ ($segment1 == 'rest-api') ? 'active' : '' }}">
                            <a href="{{url('rest-api')}}"><i class="ik ik-cloud"></i><span>{{ __('REST API')}}</span> </a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'permission-example') ? 'active' : '' }}">
                            <a href="{{url('permission-example')}}"><i class="ik ik-unlock"></i><span>{{ __('Laravel Permission')}}</span> </a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'table-datatable-edit') ? 'active' : '' }}">
                            <a href="{{url('table-datatable-edit')}}"><i class="ik ik-layout"></i><span>{{ __('Editable Datatable')}}</span>  </a>

                        </div>

                        <!-- start inventory pages -->
                        <div class="nav-lavel">{{ __('Inventory')}} </div>
                        <div class="nav-item {{ ($segment1 == 'donors') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Osebe')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('donors/create')}}" class="menu-item {{ ($segment1 == 'donors' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Dodaj Osebo')}}</a>
                                <a href="{{url('donors')}}" class="menu-item {{ ($segment1 == 'donors' && $segment2 == '') ? 'active' : '' }}">{{ __('Lista Oseb')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'pos') ? 'active' : '' }}">
                            <a href="{{url('pos')}}"><i class="ik ik-printer"></i><span>{{ __('POS')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'products') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-headphones"></i><span>{{ __('Products')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('products/create')}}" class="menu-item {{ ($segment1 == 'products' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Product')}}</a>
                                <a href="{{url('products')}}" class="menu-item {{ ($segment1 == 'products' && $segment2 == '') ? 'active' : '' }}">{{ __('List Producs')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'categories') ? 'active' : '' }}">
                            <a href="{{url('categories')}}"><i class="ik ik-list"></i><span>{{ __('Categories')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'sales') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-shopping-cart"></i><span>{{ __('Sales')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('sales/create')}}" class="menu-item {{ ($segment1 == 'sales' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Sale')}}</a>
                                <a href="{{url('sales')}}" class="menu-item {{ ($segment1 == 'sales' && $segment2 == '') ? 'active' : '' }}">{{ __('List Sales')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'purchases') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-truck"></i><span>{{ __('Purchases')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('purchases/create')}}" class="menu-item {{ ($segment1 == 'purchases' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Purchase')}}</a>
                                <a href="{{url('purchases')}}" class="menu-item {{ ($segment1 == 'purchases' && $segment2 == '') ? 'active' : '' }}">{{ __('List Purchases')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'suppliers' || $segment1 == 'customers') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-users"></i><span>{{ __('People')}}</span> <span class=" badge badge-success badge-right">{{ __('New')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('suppliers')}}" class="menu-item {{ ($segment1 == 'suppliers') ? 'active' : '' }}">{{ __('Suppliers')}}</a>
                                <a href="{{url('customers')}}" class="menu-item {{ ($segment1 == 'customers') ? 'active' : '' }}">{{ __('Customers')}}</a>
                            </div>
                        </div>

                        <!-- end inventory pages -->
                        <div class="nav-lavel">{{ __('Themekit Pages')}} </div>
                        <div class="nav-item {{ ($segment1 == 'form-components' || $segment1 == 'form-advance'||$segment1 == 'form-addon') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-edit"></i><span>{{ __('Forms')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('form-components')}}" class="menu-item {{ ($segment1 == 'form-components') ? 'active' : '' }}">{{ __('Components')}}</a>
                                <a href="{{url('form-addon')}}" class="menu-item {{ ($segment1 == 'form-addon') ? 'active' : '' }}">{{ __('Add-On')}}</a>
                                <a href="{{url('form-advance')}}" class="menu-item {{ ($segment1 == 'form-advance') ? 'active' : '' }}">{{ __('Advance')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'form-picker') ? 'active' : '' }}">
                            <a href="{{url('form-picker')}}"><i class="ik ik-terminal"></i><span>{{ __('Form Picker')}}</span> </a>
                        </div>

                        <div class="nav-item {{ ($segment1 == 'table-bootstrap') ? 'active' : '' }}">
                            <a href="{{url('table-bootstrap')}}"><i class="ik ik-credit-card"></i><span>{{ __('Bootstrap Table')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'table-datatable') ? 'active' : '' }}">
                            <a href="{{url('table-datatable')}}"><i class="ik ik-inbox"></i><span>{{ __('Data Table')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'navbar') ? 'active' : '' }}">
                            <a href="{{url('navbar')}}"><i class="ik ik-menu"></i><span>{{ __('Navigation')}}</span> </a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'widgets' || $segment1 == 'widget-statistic'||$segment1 == 'widget-data'||$segment1 == 'widget-chart') ? 'active open' : '' }} has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-layers"></i><span>{{ __('Widgets')}}</span> <span class="badge badge-danger">{{ __('150+')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('widgets')}}" class="menu-item {{ ($segment1 == 'widgets') ? 'active' : '' }}">{{ __('Basic')}}</a>
                                <a href="{{url('widget-statistic')}}" class="menu-item {{ ($segment1 == 'widget-statistic') ? 'active' : '' }}">{{ __('Statistic')}}</a>
                                <a href="{{url('widget-data')}}" class="menu-item {{ ($segment1 == 'widget-data') ? 'active' : '' }}">{{ __('Data')}}</a>
                                <a href="{{url('widget-chart')}}" class="menu-item {{ ($segment1 == 'widget-chart') ? 'active' : '' }}">{{ __('Chart Widget')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'alerts' || $segment1 == 'buttons'||$segment1 == 'badges'||$segment1 == 'navigation') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-box"></i><span>{{ __('Basic')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('alerts')}}" class="menu-item {{ ($segment1 == 'alerts') ? 'active' : '' }}">{{ __('Alerts')}}</a>
                                <a href="{{url('badges')}}" class="menu-item {{ ($segment1 == 'badges') ? 'active' : '' }}">{{ __('Badges')}}</a>
                                <a href="{{url('buttons')}}" class="menu-item {{ ($segment1 == 'buttons') ? 'active' : '' }}">{{ __('Buttons')}}</a>
                                <a href="{{url('navigation')}}" class="menu-item {{ ($segment1 == 'navigation') ? 'active' : '' }}">{{ __('Navigation')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'modals' || $segment1 == 'notifications'||$segment1 == 'carousel'||$segment1 == 'range-slider' ||$segment1 == 'rating') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-gitlab"></i><span>{{ __('Advance')}}</span> </a>
                            <div class="submenu-content">
                                <a href="{{url('modals')}}" class="menu-item {{ ($segment1 == 'modals') ? 'active' : '' }}">{{ __('Modals')}}</a>
                                <a href="{{url('notifications')}}" class="menu-item {{ ($segment1 == 'notifications') ? 'active' : '' }}" >{{ __('Notifications')}}</a>
                                <a href="{{url('carousel')}}" class="menu-item {{ ($segment1 == 'carousel') ? 'active' : '' }}">{{ __('Slider')}}</a>
                                <a href="{{url('range-slider')}}" class="menu-item {{ ($segment1 == 'range-slider') ? 'active' : '' }}">{{ __('Range Slider')}}</a>
                                <a href="{{url('rating')}}" class="menu-item {{ ($segment1 == 'rating') ? 'active' : '' }}">{{ __('Rating')}}</a>
                            </div>
                        </div>
                        
                        
                        <div class="nav-item {{ ($segment1 == 'charts-chartist' || $segment1 == 'charts-flot'||$segment1 == 'charts-knob'||$segment1 == 'charts-amcharts') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-pie-chart"></i><span>{{ __('Charts')}}</span> </a>
                            <div class="submenu-content">
                                <a href="{{url('charts-chartist')}}" class="menu-item {{ ($segment1 == 'charts-chartist') ? 'active' : '' }}">{{ __('Chartist')}}</a>
                                <a href="{{url('charts-flot')}}" class="menu-item {{ ($segment1 == 'charts-flot') ? 'active' : '' }}">{{ __('Flot')}}</a>
                                <a href="{{url('charts-knob')}}" class="menu-item {{ ($segment1 == 'charts-knob') ? 'active' : '' }}">{{ __('Knob')}}</a>
                                <a href="{{url('charts-amcharts')}}" class="menu-item {{ ($segment1 == 'charts-amcharts') ? 'active' : '' }}">{{ __('Amcharts')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'calendar') ? 'active' : '' }}">
                            <a href="{{url('calendar')}}"><i class="ik ik-calendar"></i><span>{{ __('Calendar')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'taskboard') ? 'active' : '' }}">
                            <a href="{{url('taskboard')}}"><i class="ik ik-server"></i><span>{{ __('Taskboard')}}</span></a>
                        </div>

                        <div class="nav-item {{ ($segment1 == 'login-1' || $segment1 == 'register'||$segment1 == 'forgot-password') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-lock"></i><span>{{ __('Authentication')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('login-1')}}" class="menu-item {{ ($segment1 == 'login-1') ? 'active' : '' }}">{{ __('Login')}}</a>
                                <a href="{{url('register')}}" class="menu-item {{ ($segment1 == 'register-1') ? 'active' : '' }}">{{ __('Register')}}</a>
                                <a href="{{url('forgot-password')}}" class="menu-item {{ ($segment1 == 'forgot-password') ? 'active' : '' }}">{{ __('Forgot Password')}}</a>
                            </div>
                        </div>
                        
                        <div class="nav-item {{ ($segment1 == 'profile' || $segment1 == 'invoice'||$segment1 == 'session-timeout') ? 'active open' : '' }} has-sub">
                            <a href="#"><i class="ik ik-file-text"></i><span>{{ __('Pages')}}</span></a>
                            <div class="submenu-content">
                                <a href="{{url('profile')}}" class="menu-item {{ ($segment1 == 'profile') ? 'active' : '' }}">{{ __('Profile')}}</a>
                                <a href="{{url('invoice')}}" class="menu-item {{ ($segment1 == 'invoice') ? 'active' : '' }}">{{ __('Invoice')}}</a>
                                <a href="{{url('project')}}" class="menu-item {{ ($segment1 == 'project') ? 'active' : '' }}">{{ __('Project')}}</a>
                                <a href="{{url('view')}}" class="menu-item {{ ($segment1 == 'view') ? 'active' : '' }}">{{ __('View')}}</a>
                                <a href="{{url('session-timeout')}}" class="menu-item {{ ($segment1 == 'session-timeout') ? 'active' : '' }}">{{ __('Session Timeout')}}</a>
                            </div>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'layouts') ? 'active' : '' }}">
                            <a href="{{url('layouts')}}"><i class="ik ik-layout"></i><span>{{ __('Layouts')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'icons') ? 'active' : '' }}">
                            <a href="{{url('icons')}}"><i class="ik ik-command"></i><span>{{ __('Icons')}}</span></a>
                        </div>
                        <div class="nav-item {{ ($segment1 == 'pricing') ? 'active' : '' }}">
                            <a href="{{url('pricing')}}"><i class="ik ik-dollar-sign"></i><span>{{ __('Pricing')}}</span></a>
                        </div>
                        <div class="nav-item has-sub">
                            <a href="javascript:void(0)"><i class="ik ik-list"></i><span>{{ __('Menu Levels')}}</span></a>
                            <div class="submenu-content">
                                <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 2.1')}}</a>
                                <div class="nav-item {{ ($segment1 == '') ? 'active' : '' }} has-sub">
                                    <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 2.2')}}</a>
                                    <div class="submenu-content">
                                        <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 3.1')}}</a>
                                    </div>
                                </div>
                                <a href="javascript:void(0)" class="menu-item">{{ __('Menu Level 2.3')}}</a>
                            </div>
                        </div>
                        <div class="nav-item">
                            <a href="javascript:void(0)" class="disabled"><i class="ik ik-slash"></i><span>{{ __('Disabled Menu')}}</span></a>
                        </div>
                    

                @endif

            </nav>
                
        </div>

    </div>

</div>