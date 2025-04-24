@extends('layouts.main') 
@section('title', __('komentarji'))
@section('content')

    @push('head')   
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    @endpush

    <div class="container-fluid mct-komentarji-index-block">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-award bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('komentarji') }}</h5>
                            <span>{{ __('Seznam vseh komentarjev') }}</span>
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
                                {{ __('komentarji') }}
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

                    <a href="{{ URL('admin/komentarji/create') }}" class="ajax_modal btn btn-sm btn-primary" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Dodaj nov komentar') }}"><i class="ik ik-plus-square"></i> {{ __('Dodaj nov komentar') }}</a>


                    <div class="card-body">

                        @if (count($komentarji))

                            <div class="table-responsive">

                                <table class="table table-hover table-striped-2">

                                    <thead>

                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('ID_objave') }}</th>
                                            <th>{{ __('ID_uporabnika') }}</th>
                                            <th>{{ __('vsebina') }}</th>
                                            <th>{{ __('stevilo vseckov') }}</th>
                                            <th class="mct_textr">{{ __('Možnosti') }}</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach ($komentarji as $key => $value)

                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->id_objave }}</td>
                                                <td>{{ $value->id_uporabnika }}</td>
                                                <td>{{ $value->vsebina }}</td>
                                                <td>{{ $value->stevilo_vseckov }}</td>
                                                <td>
                                                    <div class="table-actions">
                                                            <a href="{{ URL('admin/komentarji/' . $value->id) }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Poglej komentar') }} {{ $value->name }} {{ $value->surname }}" title="{{ __('Poglej') }}"><i class="ik ik-eye f-16 mr-15 text-dark"></i></a>
                                                            <a href="{{ URL('admin/komentarji/' . $value->id . '/edit') }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Uredi komentar') }} {{ $value->name }} {{ $value->surname }}" title="{{ __('Uredi') }}"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                            <a href="{{ URL('admin/komentarji/delete/' . $value->id) }}" class="mct_delbtn" title="{{ __('Izbriši') }}"><i class="ik ik-trash-2 f-16 text-red"></i></a>
                                                    </div>
                                                </td>
                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

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