@extends('layouts.main') 
@section('title', __('Dnevnik dogajanja'))
@section('content')

    <div class="container-fluid">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-clock bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Dnevnik dogajanja') }}</h5>
                            <span>{{ __('Seznam vseh aktivnosti na strani') }}</span>
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
                                <a href="#">{{ __('Dnevnik dogajanja') }}</a>
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

                        <div class="col-md-12">

                            <div class="mb-2 clearfix">

                                <a class="btn pt-0 pl-0 d-md-none d-lg-none" data-toggle="collapse" href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">
                                    {{ __('Prikaži opcije') }}
                                    <i class="ik ik-chevron-down align-middle"></i>
                                </a>

                                <div class="collapse d-md-block display-options" id="displayOptions">

                                    <div class="d-block d-md-inline-block mt-10">

                                        <div class="search-sm mct_search d-inline-block float-md-left mr-1 mb-1 align-top">

                                            <form class="forms-sample" method="GET" action="{{ route('admin.activities.index') }}">

                                                <input type="text" class="form-control" name="search" placeholder="{{ __('Iskanje') }}..." />
                                                <button type="submit" class="btn btn-icon"><i class="ik ik-search"></i></button>
                                                
                                            </form>

                                        </div>

                                    </div>

                                    <div class="float-md-right mt-10">

                                        <span class="text-muted text-small mr-2">
                                            {{ __('Prikazujem') }} {{ $activities->firstItem() }} do {{ $activities->lastItem() }} od {{ $activities->total() }} {{ __('zadetkov') }}
                                        </span>

                                        <a href="{{ URL('admin/activities') }}" class="btn btn-outline-secondary">{{ __('Počisti iskalnik') }}</a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="card-body">

                        @if (count($activities))

                            <div class="table-responsive">

                                <table class="table table-hover table-striped">

                                    <thead>

                                        <tr>
                                            <th>{{ __('Naziv') }}</th>
                                            <th>{{ __('Opis') }}</th>
                                            <th>{{ __('Modul') }}</th>
                                            <th>{{ __('ID modula') }}</th>
                                            <th>{{ __('Akcija') }}</th>
                                            <th>{{ __('Uporabnik') }}</th>
                                            <th>{{ __('Datum') }}</th>
                                            <th class="mct_textr">{{ __('Možnosti') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($activities as $key => $value)

                                            <tr>
                                                <td>{{ $value->log_name }}</td>
                                                <td>{{ $value->description }}</td>
                                                <td>{{ $value->subject_type }}</td>
                                                <td>{{ $value->subject_id }}</td>
                                                <td>{{ $value->event }}</td>
                                                <td>{{ ($value->causer->name) ?? '' }}</td>
                                                <td>{{ getFormatedDate($value->created_at, true) }}</td>
                                                <td>
                                                    <div class="table-actions">
                                                        <a href="{{ URL('admin/activities/' . $value->id) }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Pogled dnevnika dogajanja') }}" title="{{ __('Poglej') }}"><i class="ik ik-eye f-16 mr-15 text-dark"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                            <div class="col-md-12 mct_pagination mct_top">{{ $activities->onEachSide(1)->render() }}</div>

                        @else

                            <div class="font-medium mct-no-data">{{ __('Trenutno še ni podatkov v bazi!') }}</div>

                        @endif
                    
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
