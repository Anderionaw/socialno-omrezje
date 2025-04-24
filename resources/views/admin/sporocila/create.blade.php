@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-sporocila-create-form" method="POST" action="{{ route('admin.sporocila.store') }}" enctype="multipart/form-data">

        @csrf

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="active" checked>
                            <span class="custom-control-label">
                                {{ __('Aktiven') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="regular">
                            <span class="custom-control-label">
                                {{ __('Redni donator') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="online">
                            <span class="custom-control-label">
                                {{ __('Online donator') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="permanent_deletion">
                            <span class="custom-control-label">
                                {{ __('Trajno odstranjen') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="code">{{ __('Šifra') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" />
                        </div>

                    </div>

                    <div class="col-md-6"></div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="name">{{ __('Ime') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="surname">{{ __('Priimek') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{ old('surname') }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="address">{{ __('Naslov') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" />
                        </div>

                    </div>

                    <div class="col-md-6">


                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="phone">{{ __('Telefon') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" />
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        {{--
                        <div class="form-group">
                            <label for="featured_image">{{ __('Slika') }}</label>
                            <input type="file" class="form-control" id="featured_image" name="featured_image" value="{{ old('featured_image') }}" />
                        </div>
                        --}}
                        
                        <div class="form-group">

                            <label for="featured_image">{{ __('Slika donatorja') }}</label>
                            <input name="featured_image" type="file" id="featured_image" class="file-upload-default">

                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled placeholder="{{ __('Slika donatorja') }}">
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
                            <label for="description">{{ __('Opombe') }}</label>
                            <textarea name="description" class="form-control" rows="5"></textarea>
                        </div>

                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-md-12">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-rounded mct_modl_btn">{{ __('Dodaj donatorja') }}</button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

@endsection