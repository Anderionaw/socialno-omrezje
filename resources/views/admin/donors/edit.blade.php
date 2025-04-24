@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-donors-edit-form" method="POST" action="{{ route('admin.donors.update', $donor->getKey()) }}" >

        <div class="card mb-1">

            <div class="card-body">

                @csrf

                <input name="_method" type="hidden" value="PATCH">

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="active"
                            @if($donor->active === 1)
                                checked
                            @endif>
                            <span class="custom-control-label">
                                {{ __('Aktiven') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="regular"
                            @if($donor->regular === 1)
                                checked
                            @endif>
                            <span class="custom-control-label">
                                {{ __('Redni donator') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="online"
                            @if($donor->online === 1)
                                checked
                            @endif>
                            <span class="custom-control-label">
                                {{ __('Online donator') }}
                            </span>
                        </label>
                        
                    </div>

                </div>

                <div class="row">

                    <div class="col-sm-12">

                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="permanent_deletion"
                            @if($donor->permanent_deletion === 1)
                                checked
                            @endif>
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
                            <input type="text" class="form-control" id="code" name="code" value="{{ $donor->code}}" />
                        </div>

                    </div>

                    <div class="col-md-6"></div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="name">{{ __('Ime') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $donor->name }}" />
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="surname">{{ __('Priimek') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="surname" name="surname" value="{{ $donor->surname }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="address">{{ __('Naslov') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ $donor->address }}" />
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>{{ __('Pošta') }}</label>
                            <select class="form-control select2" name="postmail_id">
                                <option selected="selected" value="">{{ __('Izberite možnost') }}</option>
                                @foreach ($postmails as $value)
                                    <option value="{{$value->id}}"
                                    @if($value->id == $donor->postmail_id)
                                        selected
                                    @endif>{{ $value->zip }} {{ $value->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="phone">{{ __('Telefon') }}</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ $donor->phone }}" />
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="text" class="form-control" id="email" name="email" value="{{ $donor->email }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="description">{{ __('Opombe') }}</label>
                            <textarea name="description" class="form-control" rows="5">{{ clean($donor->description, 'titles') }}</textarea>
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