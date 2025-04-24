@extends('layouts.main') 
@section('title', __('Donatorji'))
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
                            <h5>{{ __('Donatorji') }}</h5>
                            <span>{{ __('Seznam vseh donatorjev') }}</span>
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
                                {{ __('Donatorji') }}
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

                                            <form class="forms-sample" method="GET" action="{{ route('admin.donors.index') }}">

                                                <input type="text" class="form-control" name="search" placeholder="{{ __('Iskanje') }}..." @if(request()->get('search')) value="{{ request()->get('search') }}" @endif/>
                                                <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>

                                                <div class="mt-3">
                                                        
                                                    <div class="row">

                                                        <div class="col-md-6">

                                                            <div class="form-group">
                                                                <select class="form-control select2" name="donor_status">
                                                                    <option selected="selected" value="">{{ __('Izberite status') }}</option>
                                                                    @foreach ($donor_statuses as $key => $value)
                                                                        <option value="{{ $key }}"
                                                                        @if($key == request()->get('donor_status'))
                                                                            selected
                                                                        @endif>{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="row mt-2">

                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-success mct-btn-md btn-rounded"><i class="ik ik-check-circle"></i>{{ __('Filtriraj') }}</button>
                                                        </div>

                                                    </div>

                                                </div>
                                                
                                            </form>

                                        </div>

                                    </div>
                        
                                    <div class="float-md-right mt-10">

                                        <span class="text-muted text-small mr-2">
                                            {{ __('Prikazujem') }} {{ $donors->firstItem() }} do {{ $donors->lastItem() }} od {{ $donors->total() }} {{ __('zadetkov') }}
                                        </span>

                                        @can('manage_donors')
                                            <a href="{{ URL('admin/donors/create') }}" class="ajax_modal btn btn-sm btn-primary" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Dodaj novega donatorja') }}"><i class="ik ik-plus-square"></i> {{ __('Dodaj novega') }}</a>  
                                        @endcan

                                        <a href="{{ URL('admin/donors') }}" class="btn btn-outline-secondary ml-1">{{ __('Počisti iskalnik') }}</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        @if (count($donors))

                            <div class="table-responsive">

                                <table class="table table-hover table-striped-2">

                                    <thead>

                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Šifra') }}</th>
                                            <th>{{ __('Ime') }}</th>
                                            <th>{{ __('Priimek') }}</th>
                                            <th>{{ __('Naslov') }}</th>
                                            <th>{{ __('Pošta') }}</th>
                                            <th class="mct_textr">{{ __('Možnosti') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($donors as $key => $value)

                                            <tr class="{{ $value->getIndexRowClass() }}">
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->code }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->surname }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>
                                                    @if ($value->postmail)
                                                        {{ $value->postmail->zip }} {{ $value->postmail->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="table-actions">
                                                        @can('view_donors')
                                                            <a href="{{ URL('admin/donors/' . $value->id) }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Poglej donatorja') }} {{ $value->name }} {{ $value->surname }}" title="{{ __('Poglej') }}"><i class="ik ik-eye f-16 mr-15 text-dark"></i></a>
                                                        @endcan
                                                        @can('manage_donors')
                                                            <a href="{{ URL('admin/donors/' . $value->id . '/edit') }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Uredi donatorja') }} {{ $value->name }} {{ $value->surname }}" title="{{ __('Uredi') }}"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                            <a href="{{ URL('admin/donors/delete/' . $value->id) }}" class="mct_delbtn" title="{{ __('Izbriši') }}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                                        @endcan
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-12 mct_pagination mct_top">{{ $donors->onEachSide(1)->render() }}</div>

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