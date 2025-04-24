@extends('layouts.main')
@section('content')

    <form class="mct-donors-show-form">

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        <h6 class="mb-3"><span class="fw-700">{{ __('Donator') }}:</span> {{ $donor->name }} {{ $donor->surname }}</h6>

                        <p class="mb-2"><span class="fw-700">{{ __('Šifra') }}:</span> {{ $donor->code }}</p>

                        @if($donor->description)

                            <hr />

                            <p class="mt-2 mb-0 fw-700">{{ __('Opombe') }}:</p>
                            <p class="mb-1">{{ $donor->description }}</p>

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