@extends('layouts.main')
@section('content')

    <form class="mct-komentarji-show-form">

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        @if($komentarji->vsebina)


                            <p class="mt-2 mb-0 fw-700">{{ __('Komentar') }}:</p>
                            <p class="mb-1">{{ $komentarji->vsebina }}</p>

                        @endif

                    </div>

                </div>

                {{--
                <div class="row">

                    <div class="col-md-12">

                        @if($donor->donor_donations)

                            @foreach ($donor->donor_donations as $key => $value)


                            @endforeach

                        @endif

                    </div>

                </div>
                --}}

            </div>

        </div>

    </form>

@endsection