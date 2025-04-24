@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-donations-edit-form" method="POST" action="{{ route('admin.donations.update', $donation->getKey()) }}" >

        <div class="card mb-1">

            <div class="card-body">

                @csrf

                <input name="_method" type="hidden" value="PATCH">

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="code">{{ __('Šifra') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="code" name="code" value="{{ $donation->code }}" />
                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="form-group">
                            <label for="title">{{ __('Naziv') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $donation->title }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="form-group">
                            <label for="date">{{ __('Datum akcije') }} <span class="text-red">*</span></label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d', strtotime($donation->date)) }}" />
                        </div>

                    </div>

                    <div class="col-md-8">

                        <div class="form-group">
                            <label for="reference">{{ __('Sklic') }} <span class="text-red">*</span></label>
                            <input type="text" class="form-control" id="reference" name="reference" value="{{ $donation->reference }}" />
                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="description">{{ __('Opombe') }}</label>
                            <textarea name="description" class="form-control" rows="5">{{ clean($donation->description, 'titles') }}</textarea>
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