@extends('layouts.main') 
@section('title', __('Pravice'))
@section('content')
    
    <div class="container-fluid">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-unlock bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Pravice') }}</h5>
                            <span>{{ __('Določi pravice za uporabnika') }}</span>
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
                                {{ __('Pravice') }}
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>

        </div>

        <div class="row clearfix">
   
            @includeIf('include.message')
           
            @can('manage_permissions')

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header"><h3>{{ __('Dodaj pravico') }}</h3></div>

                        <div class="card-body">

                            <form class="forms-sample" method="POST" action="{{ route('admin.permissions.store') }}">

                                @csrf

                                <div class="row">

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="permission">{{ __('Pravica') }} <span class="text-red">*</span></label>
                                            <input type="text" class="form-control" id="permission" name="permission" value="{{ old('permission') }}" />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="roles">{{ __('Dodeli uporabniškim nivojem') }}</label>
                                            <select class="form-control select2" id="roles" name="roles[]" multiple>
                                                @foreach($roles as $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach 
                                            </select>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-4">
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
                                    {{ __('Prikaži opcije')}}
                                    <i class="ik ik-chevron-down align-middle"></i>
                                </a>

                                <div class="collapse d-md-block display-options" id="displayOptions">

                                    <div class="d-block d-md-inline-block mt-10">

                                        <div class="search-sm mct_search d-inline-block float-md-left mr-1 mb-1 align-top">

                                            <form class="forms-sample" method="GET" action="{{ route('admin.permissions.index') }}">

                                                <input type="text" class="form-control" name="search" placeholder="{{ __('Iskanje') }}..." />
                                                <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                                
                                            </form>

                                        </div>

                                    </div>

                                    <div class="float-md-right mt-10">

                                        <span class="text-muted text-small mr-2">
                                            {{ __('Prikazujem') }} {{ $permissions->firstItem() }} do {{ $permissions->lastItem() }} od {{ $permissions->total() }} {{ __('zadetkov') }}
                                        </span>

                                        <a href="{{ URL('admin/permissions') }}" class="btn btn-outline-secondary">{{ __('Počisti iskalnik') }}</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        @if (count($permissions))

                            <div class="table-responsive">

                                <table class="table table-hover table-striped">

                                    <thead>

                                        <tr>
                                            <th>{{ __('Pravica') }}</th>
                                            <th>{{ __('Uporabniški nivo') }}</th>
                                            <th class="mct_textr">{{ __('Možnosti') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($permissions as $key => $value)

                                            <tr>
                                                <td>{{ $value->name }}</td>
                                                <td>{!! formatRolesWithBadge($value->roles()->get()) !!}</td>
                                                <td>
                                                    @can('manage_permissions')
                                                        <div class="table-actions">
                                                            <a href="{{ URL('admin/permissions/' . $value->id . '/edit') }}" title="{{ __('Uredi') }}"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                            <a href="{{ URL('admin/permissions/delete/' . $value->id) }}" class="mct_delbtn" title="{{ __('Izbriši') }}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                                        </div>
                                                    @endcan
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-12 mct_pagination mct_top">{{ $permissions->onEachSide(1)->render() }}</div>

                        @else

                            <div class="font-medium mct-no-data">{{ __('Trenutno še ni podatkov v bazi!') }}</div>

                        @endif
                    
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection