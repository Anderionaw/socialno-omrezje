@extends('layouts.main')
@section('content')

    <form>

        <div class="row">

            <div class="col-sm-12">

                <p class="mb-2">{{ __('Uporabnik') }}: <span class="fw-700">{{ ($activity->causer->name) ?? '' }}</span></p>
                <p class="mb-2">{{ __('Datum nastanka') }}: <span class="fw-700">{{ getFormatedDate($activity->created_at, true) }}</span></p>
                <p class="">{{ __('Datum spremembe') }}: <span class="fw-700">{{ getFormatedDate($activity->created_at, true) }}</span></p>

                <hr />

                <p class="mb-2">{{ __('Opis') }}: <span class="fw-700">{{ $activity->description }}</span></p>

                <p class="mb-2">{{ __('Modul') }}: <span class="fw-700">{{ $activity->subject_type }}</span></p>

                <p class="mb-2">{{ __('ID modula') }}: <span class="fw-700">{{ $activity->subject_id }}</span></p>

                <p class="mb-2">{{ __('Akcija') }}: <span class="fw-700">{{ $activity->event }}</span></p>

                <p class="mb-2" style="word-break: break-all;">{{ __('Lastnosti') }}: <span class="fw-700">{{ $activity->properties }}</span></p>
                    
            </div>

        </div>

    </form>

@endsection
