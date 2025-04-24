@extends('layouts.main') 
@section('title', __('Počisti predpomnilnik'))
@section('content')

    <div class="container-fluid">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-battery-charging bg-green"></i>
                        <div class="d-inline">
                            <h5>{{ __('Počisti predpomnilnik') }}</h5>
                            <span>{{ __('Počisti predpomnilnik za celotno stran') }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item active">
                                {{ __('Počisti predpomnilnik') }}
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>

        </div>

        <div class="row clearfix">
   
            @includeIf('include.message')

            <div class="col-md-12">

                <div class="card">

                    <div class="card-body">

                        <div class="text-center">

                            <i class="ik ik-battery-charging text-green font-150"></i>
                            <h4 class="text-center">WOW! {{ __('Predpomnilnik je bil uspeščno počiščen!!') }}</h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
