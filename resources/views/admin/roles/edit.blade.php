@extends('layouts.main')
@section('title', __('Uredi uporabniški nivo'))
@section('content')

<div class="container-fluid">

    <div class="page-header">

        <div class="row align-items-end">

            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-award bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Uporabniški nivoji') }}</h5>
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
                            <a href="{{url('admin/roles') }}">{{ __('Uporabniški nivoji') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ clean($role->name, 'titles') }}
                        </li>

                    </ol>
                </nav>
            </div>

        </div>

    </div>

	<div class="row clearfix">
        
        @includeIf('include.message')

		<div class="col-md-12">

            <div class="card">

                <div class="card-header row">

                    <div class="col col-sm-12">
                        <h3>{{ __('Uredi uporabniški nivo') }}: {{ clean($role->name, 'titles') }}</h3>
                    </div>

                </div>

                <div class="card-body">

                    <form class="forms-sample" method="POST" action="{{ route('admin.roles.update', $role->getKey()) }}">

                    	@csrf

                        <input name="_method" type="hidden" value="PATCH">

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="role_edit">{{ __('Uporabniški nivo') }} <span class="text-red">*</span></label>
                                    <input type="text" class="form-control is-valid" id="role_edit" name="role" value="{{ clean($role->name, 'titles') }}">
                                </div>
                            </div>

                            <div class="col-sm-7">

                                <label>{{ __('Dodeli pravice') }}</label>
                                <div class="row">
                                	@foreach($permissions as $key => $value)
                                	<div class="col-sm-4">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="permissions[]" value="{{ $key }}" 
                                            @if(in_array($key, $role_permission))
                                                checked
                                            @endif>
                                            <span class="custom-control-label">
                                                {{ clean($value, 'titles') }}
                                            </span>
                                        </label>
                                	</div>
                                	@endforeach 
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-sm-12">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-rounded">{{ __('Shrani spremembe') }}</button>
                                    <a href="{{ URL('admin/roles') }}" class="btn btn-outline-secondary btn-rounded ml-1">{{ __('Nazaj') }}</a>
                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

	</div>

</div>

@endsection