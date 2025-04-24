@extends('layouts.main') 
@section('title', __('Uporabniki'))
@section('content')

    @push('head')   
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    @endpush

    <div class="container-fluid mct-donors-index-block">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Uporabniki') }}</h5>
                            <span>{{ __('Išči uporabnika') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>

        </div>

        <div class="row clearfix">

            @includeIf('include.message')

            <div class="col-md-12">

                <div class="card table-card">

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

                                            <form class="forms-sample" method="GET" action="{{ route('admin.users.isciuporabnike') }}">

                                                <input type="text" class="form-control" name="search" placeholder="{{ __('Iskanje') }}..." @if(request()->get('search')) value="{{ request()->get('search') }}" @endif/>
                                                <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>

                                            </form>

                                        </div>

                                    </div>
                        
                                    <div class="float-md-right mt-10">

                                        <a href="{{ URL('admin/users/search') }}" class="btn btn-outline-secondary ml-1">{{ __('Počisti iskalnik') }}</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">
                        @if (isset($users))
                            
                        @if($users->isEmpty())
                            <div class="font-medium mct-no-data">{{ __('Uporabnik ne obstaja') }}</div>
                        @else
                            <div class="table-responsive">

                                <table class="table table-hover table-striped-2">

                                    <thead>

                                        <tr>
                                            <th>{{ __('Uporabniško ime') }}</th>
                                            <th>{{ __('E-mail') }}</th>
                                            <th class="mct_textr">{{ __('Profil') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($users as $key => $value)
                                            <tr>
                                                <td><a href="{{ URL('admin/users/view/' . $value->id) }}">{{ $value->name }}</a></td>
                                                <td>{{ $value->email }}</td>
                                                <td>
                                                    <div class="table-actions">
                                                            <a href="{{ URL('admin/users/view/' . $value->id) }}" title="{{ __('Poglej') }}"><i class="ik ik-eye f-16 mr-15 text-dark"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                            @endif
                        @endif
                    
                    </div>

                </div>

            </div>

        </div>

    </div>

    @push('script')      
        <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    @endpush

@endsection