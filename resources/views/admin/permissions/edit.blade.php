@extends('layouts.main')
@section('title', __('Uredi pravico'))
@section('content')

<div class="container-fluid">

    <div class="page-header">

        <div class="row align-items-end">

            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-award bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Pravice') }}</h5>
                        <span>{{ __('Uredi pravico in ji določi uporabniški nivo') }}</span>
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
                            <a href="{{url('admin/permissions') }}">{{ __('Pravice') }}</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ clean($permission->name, 'titles') }}
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
                        <h3>{{ __('Uredi pravico') }}: {{ clean($permission->name, 'titles') }}</h3>
                    </div>

                </div>

                <div class="card-body">

                    <form class="forms-sample" method="POST" action="{{ route('admin.permissions.update', $permission->getKey()) }}">

                    	@csrf

                        <input name="_method" type="hidden" value="PATCH">

                        <div class="row">

                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label for="permission_edit">{{ __('Pravica') }} <span class="text-red">*</span></label>
                                    <input type="text" class="form-control is-valid" id="permission_edit" name="permission" value="{{ clean($permission->name, 'titles') }}">
                                </div>
                            </div>

                            <div class="col-sm-7">

                                <label>{{ __('Dodeli uporabniškim nivojem') }}</label>
                                <div class="row">
                                	@foreach($roles as $key => $value)
                                	<div class="col-sm-4">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="roles[]" value="{{ $key }}" 
                                            @if(in_array($key, $permission_role))
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
                                    <a href="{{ URL('admin/permissions') }}" class="btn btn-outline-secondary btn-rounded ml-1">{{ __('Nazaj') }}</a>
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