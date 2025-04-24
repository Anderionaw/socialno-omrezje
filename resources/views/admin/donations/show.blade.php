@extends('layouts.main')
@section('content')

    <form class="mct-donations-show-form">

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <h6 class="mb-3"><span class="fw-700">{{ __('Naziv akcije') }}:</span> {{ $donation->title }}</h6>

                        <p class="mb-2"><span class="fw-700">{{ __('Šifra') }}:</span> {{ $donation->code }}</p>
                        <p class="mb-2"><span class="fw-700">{{ __('Datum') }}:</span> {{ getFormatedDate($donation->date) }}</p>
                        <p class="mb-2"><span class="fw-700">{{ __('Sklic') }}:</span> {{ $donation->reference }}</p>

                        @if($donation->description)

                            <hr />

                            <p class="mt-2 mb-0 fw-700">{{ __('Opombe') }}:</p>
                            <p class="mb-1">{{ $donation->description }}</p>

                        @endif

                    </div>

                </div>

                {{--
                <div class="row">

                    <div class="col-md-12">

                        @if($donation->donation_donations)

                            @foreach ($donation->donation_donations as $key => $value)



                            @endforeach

                        @endif

                    </div>

                </div>
                --}}

            </div>

        </div>

    </form>

@endsection