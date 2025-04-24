@extends('layouts.main') 
@section('title', __('Uporabniki'))
@section('content')

<?php   use \App\Http\Controllers\Admin\PrijateljstvoController; 
        use \App\Http\Controllers\Admin\VseckiController;
        use \App\Http\Controllers\Admin\UserController;
?>
    
    <div class="container-fluid">

    	<div class="page-header">

            <div class="row align-items-end">

                <div class="col-lg-3 mb-2">
                    <div class="page-header-title">
                        @if($user->slika)
                            <img class="profile-image img-fluid" src="{{ URL::to( 'storage/app/public/' . $user->slika) }}" />
                        @else
                            <i class="ik ik-users bg-blue"></i>
                        @endif
                            <h5 style="display:inline-block; margin-left:10px">{{ $user->name }}</h5>
                    </div>
                </div>
                
                <div class="col-lg-2">
                    <h4>Prijatelji: {{count(PrijateljstvoController::izpisiPrijatelje($user->id));}}</h4>
                </div>

                <div class="col-lg-2">
                    <h4>Objave: {{count($user->objave)}}</h4>
                </div>

                <div class="col-lg-2">
                    <h4>Všečki: {{UserController::prestejVsecke($user->id)}}</h4>
                </div>

                <div class="col-lg-3">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item profile-view-domov">
                                <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                            </li>
                        </ol>
                    </nav>
                </div>


                {{-- Ce ta user ni trenutni uporabnik     in     te dva uporabnika se nista prijatelja     in    prosnja za prijateljstvo se ni bila poslana  --}}
                @if($user->id != Auth::user()->id && !PrijateljstvoController::zePrijatelja($user->id, Auth::user()->id) && !PrijateljstvoController::jeProsnja( Auth::user()->id, $user->id) && !PrijateljstvoController::jeProsnja($user->id, Auth::user()->id))
                    <button class="dodaj-prijatelja btn btn-outline-success ml-2" data-id1="{{$user->id}}" data-id2="{{Auth::user()->id}}" data-url="{{route('admin.users.dodajprijatelja')}}">Dodaj prijatelja</button>
                @endif
                
                
                @if(PrijateljstvoController::jeProsnja(Auth::user()->id, $user->id))
                    <button data-url="{{route('admin.users.sprejmiprijatelja')}}" data-id1="{{Auth::user()->id}}" data-id2="{{$user->id}}" class="dodaj-uporabnika-button btn btn-success ml-2 mr-1">Sprejmi</button>
                    <button data-url="{{route('admin.users.zavrniprijatelja')}}" data-id1="{{Auth::user()->id}}" data-id2="{{$user->id}}" class="zavrni-uporabnika-button btn btn-danger">Zavrni</button>
                @endif

                @if(PrijateljstvoController::jeProsnja($user->id, Auth::user()->id))
                    <h6 class=" badge badge-pill badge-success ml-2 ml-20">Prošnja poslana</h6>
                @endif

                @if(PrijateljstvoController::zePrijatelja($user->id, Auth::user()->id))
                    <button data-url="{{route('admin.users.odstraniprijatelja')}}" data-id1="{{Auth::user()->id}}" data-id2="{{$user->id}}" class="odstrani-prijatelja-button ml-2 btn btn-outline-danger">Odstrani prijatelja</button>
                @endif

            </div>

        </div>


        <div class="row clearfix mt-50">

            <div class="col-md-12">

                 @foreach ($user->objave as $key => $objava)

                    <div class="objava-display-holder-card">
                        <div class="objava-display-nav">
                            <div class="objava-display-user">{{$objava->user->name}}</div>
                            <div class="objava-display-povecava"><a href="{{ URL('admin/objave/' . $objava->id) }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="" title="{{ __('Poglej') }}"><i class="ik ik-eye f-16 mt-20 mr-15 text-dark"></i></a></div>
                            <div class="objava-display-shrani"><button class="objava-display-shrani-btn" data-url="{{URL('admin/shranjeneobjave/store')}}" data-id="{{$objava->id}}"><i class="ik ik-bookmark f-16 mt-20 mr-15 text-dark"></i></button></div>
                            @if(Auth::user()->id == $objava->user->id)
                                <div class="objava-display-izbrisi"><a href="{{ URL('admin/objave/delete/' . $objava->id) }}"><i class="ik ik-trash f-16 mt-20 text-dark"></i></a></div>
                            @endif
                        </div>

                        <div class="objava-display-vsebina">{{$objava->vsebina}}</div>
                        
                        
                        @if($objava->slika)
                            <div class="objava-display-img"><img class="img-fluid" src="{{ URL::to( 'storage/app/public/objave/' . $objava->slika ) }}" /></div>
                        @endif

                        <div class="objava-display-vsecki"><button class="objava-display-vsecki-button btn btn-danger" data-url="{{route('admin.objave.vseckaj')}}" data-id="{{$objava->id}}"><i class="fa fa-heart"></i><span class="vsecki-value">{{VseckiController::steviloVseckov($objava->id)}}</span></button></div>
                        <div class="objava-display-objava">{{$objava->created_at->format('d - M - Y')}}</div>
                    </div>


                @endforeach


            </div>

        </div>

    </div>

    @push('script') 
        <script src="{{ asset('js/get-role.js') }}"></script>
    @endpush

@endsection