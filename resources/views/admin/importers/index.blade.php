@extends('layouts.main') 
@section('title', __('Uvoz excel datotek'))
@section('content')

    <div class="container-fluid">

        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-upload bg-blue"></i>
                        <div class="d-inline">
                            <h5>{{ __('Uvoz excel datotek') }}</h5>
                            <span>{{ __('pripnite excelovo datoteko za vsako od možnosti uvoza!') }}</span>
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
                                {{ __('Uvoz excel datotek') }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">

            @includeIf('include.message')

            <div class="col-md-6">

                <div class="card">

                    <div class="card-header"><h3>{{ __('Uvoz pošt Slovenije') }}</h3></div>

                    <div class="card-body">

                        <h4 class="sub-title">{{ __('Primer Excel datoteke') }}: <a href="{{ URL::asset('/samples/postmails-sample.xlsx') }}" target="_blank"><i class="ik ik-download"></i></a></h4>

                        <form class="forms-sample" method="POST" action="{{ route('admin.importers.import_postmails') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            
                            @csrf

                            <div class="form-group">

                                <label for="att_postmailfile">{{ __('Nalaganje datoteke') }}</label>
                                <input name="att_postmailfile" type="file" id="att_postmailfile" class="file-upload-default">

                                <div class="input-group col-xs-12">
                                    <input type="text" class="form-control file-upload-info" disabled placeholder="{{ __('Nalaganje datoteke') }}">
                                    <span class="input-group-append">
                                        <button class="file-upload-browse btn btn-primary" type="button">{{ __('Naloži') }}</button>
                                    </span>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-primary mr-2">{{ __('Pošlji') }}</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    
    @push('script')
        <script src="{{ asset('js/form-components.js') }}"></script>
    @endpush

@endsection