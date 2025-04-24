@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-objave-create-form" method="POST" action="{{ route('admin.objave.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">
                        
                        <div class="form-group">

                            <label for="featured_image">{{ __('Slika objave') }}</label>
                            <input name="featured_image" type="file" id="featured_image" class="file-upload-default">

                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="{{ __('Slika objave') }}">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">{{ __('Naloži') }}</button>
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="vsebina">{{ __('Vsebina') }}</label>
                            <textarea name="vsebina" class="form-control" rows="5"></textarea>
                        </div>

                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-md-12">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-rounded mct_modl_btn">{{ __('Objavi') }}</button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

@endsection