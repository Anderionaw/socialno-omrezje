@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-objave-edit-form" method="POST" action="{{ route('admin.objave.update', $objava->getKey()) }}" enctype="multipart/form-data">
        <div class="card mb-1">

            <div class="card-body">

                @csrf

                <input name="_method" type="hidden" value="PATCH">

                @if ( $objava->slika != null && $objava->slika != '' )
			
                    <div class="row mt-3 mb-3">

                        <div class="col-md-2">

                            <img class="img-fluid" src="{{ URL::to( 'storage/objave/' . $objava->slika ) }}" />

                            <label class="custom-control custom-checkbox mt-1">
                                <input type="checkbox" class="custom-control-input" name="remove_featured_image">
                                <span class="custom-control-label">
                                    {{ __('Odstrani sliko') }}
                                </span>
                            </label>

                        </div>

                    </div>

		        @endif

                <div class="row">

                    <div class="col-md-12">
                        
                        <div class="form-group">

                            <label for="featured_image">{{ __('Slika') }}</label>
                            <input name="featured_image" type="file" id="featured_image" class="file-upload-default">

                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="{{ __('Slika') }}">
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
                            <textarea name="vsebina" class="form-control" rows="5">{{ clean($objava->vsebina, 'titles') }}</textarea>
                        </div>

                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-md-12">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-rounded mct_modl_btn">{{ __('Shrani spremembe') }}</button>
                        </div>

                    </div>

                </div>

            </div>
            
        </div>

    </form>

@endsection