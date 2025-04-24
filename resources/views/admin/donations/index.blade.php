@extends('layouts.main') 
@section('title', __('Akcije'))
@section('content')

    @push('head')   
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    @endpush

    <div class="container-fluid mct-donations-index-block">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-tag bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Akcije') }}</h5>
                            <span>{{ __('Seznam vseh akcij') }}</span>
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
                                {{ __('Akcije') }}
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

                                            <form class="forms-sample" method="GET" action="{{ route('admin.donations.index') }}">

                                                <input type="text" class="form-control" name="search" placeholder="{{ __('Iskanje') }}..." />
                                                <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                                
                                            </form>

                                        </div>

                                    </div>
                        
                                    <div class="float-md-right mt-10">

                                        <span class="text-muted text-small mr-2">
                                            {{ __('Prikazujem') }} {{ $donations->firstItem() }} do {{ $donations->lastItem() }} od {{ $donations->total() }} {{ __('zadetkov') }}
                                        </span>

                                        @can('manage_donations')
                                            <a href="{{ URL('admin/donations/create') }}" class="ajax_modal btn btn-sm btn-primary" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Dodaj novo akcijo') }}"><i class="ik ik-plus-square"></i> {{ __('Dodaj novo') }}</a>  
                                        @endcan

                                        <a href="{{ URL('admin/donations') }}" class="btn btn-outline-secondary ml-1">{{ __('Počisti iskalnik') }}</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        @if (count($donations))

                            <div class="table-responsive">

                                <table class="table table-hover table-striped-2">

                                    <thead>

                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Šifra') }}</th>
                                            <th>{{ __('Naziv') }}</th>
                                            <th>{{ __('Datum') }}</th>
                                            <th>{{ __('Sklic') }}</th>
                                            <th class="mct_textr">{{ __('Možnosti') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($donations as $key => $value)

                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->code }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ getFormatedDate($value->date) }}</td>
                                                <td>{{ $value->reference }}</td>
                                                <td>
                                                    <div class="table-actions">
                                                        @can('view_donations')
                                                            <a href="{{ URL('admin/donations/' . $value->id) }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Poglej akcijo') }} {{ $value->title }}" title="{{ __('Poglej') }}"><i class="ik ik-eye f-16 mr-15 text-dark"></i></a>
                                                        @endcan
                                                        @can('manage_donations')
                                                            <a href="{{ URL('admin/donations/' . $value->id . '/edit') }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Uredi akcijo') }} {{ $value->title }}" title="{{ __('Uredi') }}"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                            <a href="{{ URL('admin/donations/delete/' . $value->id) }}" class="mct_delbtn" title="{{ __('Izbriši') }}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-12 mct_pagination mct_top">{{ $donations->onEachSide(1)->render() }}</div>

                        @else

                            <div class="font-medium mct-no-data">{{ __('Trenutno še ni podatkov v bazi!') }}</div>

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