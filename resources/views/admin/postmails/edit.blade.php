@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form" method="POST" action="{{ route('admin.postmails.update', $postmail->getKey()) }}">

        @csrf

        <input name="_method" type="hidden" value="PATCH">

        <div class="row">

            <div class="col-sm-12">

                <label class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" name="active"
                    @if($postmail->active === 1)
                        checked
                    @endif>
                    <span class="custom-control-label">
                        {{ __('Aktivno') }}
                    </span>
                </label>
                    
            </div>

        </div>

        <div class="row">

            <div class="col-sm-12">

                <div class="form-group">
                    <label for="zip_edit">{{ __('Poštna številka') }} <span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="zip_edit" name="zip" value="{{ clean($postmail->zip, 'titles') }}">
                </div>

            </div>
        
        </div>

        <div class="row">

            <div class="col-sm-12">

                <div class="form-group">
                    <label for="title_edit">{{ __('Naziv') }} <span class="text-red">*</span></label>
                    <input type="text" class="form-control" id="title_edit" name="title" value="{{ clean($postmail->name, 'titles') }}">
                </div>

            </div>

            <div class="col-sm-12">

                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-rounded mct_modl_btn">{{ __('Shrani spremembe') }}</button>
                </div>

            </div>

        </div>

    </form>

@endsection