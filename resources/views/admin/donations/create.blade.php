@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-donations-create-form" method="POST" action="{{ route('admin.donations.store') }}" >

        @csrf

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="code">{{ __('Šifra') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ old('code') }}" />
                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="form-group">
                            <label for="title">{{ __('Naziv') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="date">{{ __('Datum akcije') }} <span class="text-red">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ getCurrentDate() }}" />
                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="form-group">
                            <label for="reference">{{ __('Sklic') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="reference" name="reference" value="{{ old('reference') }}" />
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
                            <button type="submit" class="btn btn-success btn-rounded mct_modl_btn">{{ __('Dodaj akcijo') }}</button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

@endsection