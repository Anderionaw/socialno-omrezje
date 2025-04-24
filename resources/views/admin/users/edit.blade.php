@extends('layouts.main') 
@section('title',  __('Uredi Uporabnika'))
@section('content')

    <div class="container-fluid">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-user-plus bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Uporabniki') }}</h5>
                            <span>{{ __('Uredi uporabnika in mu določi pravice in dovoljenja') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ url('admin/users') }}">{{ __('Uporabniki') }}</a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ clean($user->name, 'titles') }}
                            </li>
                        </ol>
                    </nav>
                </div>
                
            </div>

        </div>

        <div class="row">
            
            @includeIf('include.message')
           
            <div class="col-md-12">

                <div class="card">

                    <div class="card-header row">

                        <div class="col col-sm-12">
                            <h3>{{ __('Uredi uporabnika') }}: {{ clean($user->name, 'titles') }}</h3>
                        </div>

                    </div>

                    <div class="card-body">

                        <form class="forms-sample" method="POST" action="{{ route('admin.users.update', $user->getKey()) }}">
                            
                            @csrf

                            <input name="_method" type="hidden" value="PATCH">

                            <div class="row">

                                <div class="col-sm-6">

                                    
                                    <div class="form-group">
                                        <label for="name_edit">{{ __('Ime') }} <span class="text-red">*</span></label>
                                        <input type="text" name="name" id="name_edit" class="form-control" value="{{ clean($user->name, 'titles') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="email_edit">{{ __('Email') }} <span class="text-red">*</span></label>
                                        <input type="text" name="email" id="email_edit" class="form-control" value="{{ clean($user->email, 'titles') }}" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password_edit">{{ __('Geslo') }} <span class="text-red">*</span></label>
                                        <input type="password" name="password" id="password_edit" class="form-control" />
                                    </div>

                                    <div class="form-group">
                                        <label for="password_confirmation_edit">{{ __('Potrdi geslo') }} <span class="text-red">*</span></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation_edit" class="form-control" />
                                    </div>
                                
                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="role_edit">{{ __('Uporabniški nivo') }} <span class="text-red">*</span></label>
                                       <select class="form-control select2" id="role_edit" name="role">
                                            <option value="">{{ __('Izberite nivo') }}</option>
                                            @foreach ( $roles as $key => $value )
                                                <option value="{{ $key }}" {{($key == $user_role->id) ? 'selected': ''}}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="permission_edit">{{ __('Pravice') }}</label>
                                        <div id="permission_edit" class="form-group">
                                            @foreach($user->getAllPermissions() as $key => $permission) 
                                                <span class="badge badge-dark m-1">
                                                    {{ clean($permission->name, 'titles') }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-12">

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-rounded">{{ __('Shrani spremembe') }}</button>
                                        <a href="{{ URL('admin/users') }}" class="btn btn-outline-secondary btn-rounded ml-1">{{ __('Nazaj') }}</a>
                                    </div>

                                </div>

                            </div>
                        
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('script') 
        <script src="{{ asset('js/get-role.js') }}"></script>
    @endpush

@endsection