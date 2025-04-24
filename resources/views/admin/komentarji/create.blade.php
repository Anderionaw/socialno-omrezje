@extends('layouts.main')
@section('content')

    <form class="forms-sample mct_modl_form mct-komentarji-create-form" method="POST" action="{{ route('admin.komentarji.store') }}">

        @csrf
        
        <input type="hidden" value="{{$komentarji["id"]}}" name="id_objave">

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <div class="form-group">
                            <label for="vsebina">{{ __('Komentar') }}</label>
                            <textarea name="vsebina" class="form-control" rows="5"></textarea>
                        </div>
                        
                    </div>

                </div>

                <div class="row mt-2">

                    <div class="col-md-12">

                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-rounded mct_modl_btn">{{ __('Dodaj komentar') }}</button>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

@endsection