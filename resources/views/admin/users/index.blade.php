@extends('layouts.main') 
@section('title', __('Uporabniki'))
@section('content')
    
    <div class="container-fluid">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-users bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Uporabniki') }}</h5>
                            <span>{{ __('Seznam vseh uporabnikov') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Uporabniki') }}
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>

        </div>

        <div class="row clearfix">
	        
            @includeIf('include.message')
            
            @can('manage_users')

				<div class="col-md-12">

					<div class="card">

						<div class="card-header"><h3>{{ __('Dodaj uporabnika') }}</h3></div>

						<div class="card-body">

							<form class="forms-sample" method="POST" action="{{ route('admin.users.store') }}">

								@csrf

								<div class="row">

                                    <div class="col-sm-6">

                                        <div class="form-group">
                                            <label for="name_create">{{ __('Ime') }} <span class="text-red">*</span></label>
                                            <input type="text" name="name" id="name_create" class="form-control" value="{{ old('name') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="email">{{ __('Email') }} <span class="text-red">*</span></label>
                                            <input type="text" name="email" id="email_create" class="form-control" value="{{ old('email') }}" />
                                        </div>

                                        <div class="form-group">
                                            <label for="password">{{ __('Geslo') }} <span class="text-red">*</span></label>
                                            <input type="password" name="password" id="password_create" class="form-control" />
                                        </div>

                                        <div class="form-group">
                                            <label for="password_confirmation">{{ __('Potrdi geslo') }} <span class="text-red">*</span></label>
                                            <input type="password" name="password_confirmation" id="password_confirmation_create" class="form-control" />
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="role_create">{{ __('Uporabniški nivo') }} <span class="text-red">*</span></label>
                                            <select class="form-control select2" id="role_create" name="role">
                                                <option selected="selected" value="">{{ __('Izberite nivo') }}</option>
                                                @foreach ( $roles as $key => $value )
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group" >
                                            <label for="permission_create">{{ __('Pravice') }}</label>
                                            <div id="permission_create" class="form-group">
                                                <span class="text-red">{{ __('Najprej izberite uporabniški nivo!') }}</span>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-rounded">{{ __('Dodaj') }}</button>
                                        </div>

                                    </div>

                                </div>

							</form>

						</div>

					</div>

				</div>

            @endcan

		</div>

        <div class="row clearfix">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header row">

                        <div class="col-md-12">

                            <div class="mb-2 clearfix">

                                <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                                    {{ __('Prikaži opcije') }}
                                    <i class="ik ik-chevron-down align-middle"></i>
                                </a>

                                <div class="collapse d-md-block display-options" id="displayOptions">

                                    <div class="d-block d-md-inline-block mt-10">

                                        <div class="search-sm mct_search d-inline-block float-md-left mr-1 mb-1 align-top">

                                            <form class="forms-sample" method="GET" action="{{ route('admin.users.index') }}">

                                                <input type="text" class="form-control" name="search" placeholder="{{ __('Iskanje') }}..." />
                                                <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                                
                                            </form>

                                        </div>

                                    </div>

                                    <div class="float-md-right mt-10">

                                        <span class="text-muted text-small mr-2">
                                            {{ __('Prikazujem') }} {{ $users->firstItem() }} do {{ $users->lastItem() }} od {{ $users->total() }} {{ __('zadetkov') }}
                                        </span>

                                        <a href="{{ URL('admin/users') }}" class="btn btn-outline-secondary ml-1">{{ __('Počisti iskalnik') }}</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        @if (count($users))

                            <div class="table-responsive">

                                <table class="table table-hover table-striped">

                                    <thead>

                                        <tr>
                                            <th>{{ __('Ime') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Uporabniški nivo') }}</th>
                                            <th class="mct_textr">{{ __('Možnosti') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($users as $key => $value)

                                            <tr>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ $value->get_pretty_roles() }}</td>
                                                <td>
                                                    @can('manage_users')
                                                        <div class="table-actions">
                                                            <a href="{{ URL('admin/users/' . $value->id . '/edit') }}" title="{{ __('Uredi') }}"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                            <a href="{{ URL('admin/users/delete/' . $value->id) }}" class="mct_delbtn" title="{{ __('Izbriši') }}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-12 mct_pagination mct_top">{{ $users->onEachSide(1)->render() }}</div>

                        @else

                            <div class="font-medium mct-no-data">{{ __('Trenutno še ni podatkov v bazi!') }}</div>

                        @endif
                    
                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('script') 
        <script src="{{ asset('js/get-role.js') }}"></script>
    @endpush

@endsection