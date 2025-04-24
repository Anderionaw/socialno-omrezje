@extends('layouts.main')
@section('content')

<?php  
        use \App\Http\Controllers\Admin\VseckiController; 
?>

    <form class="mct-objave-show-form">

        <div class="card mb-1">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-12">

                        @if($objave->vsebina)
                            
                            <div class="objava-display-holder">
                                <div class="objava-display-nav">
                                    <div class="objava-display-user"><a href="admin/users/view/{{$objave->user->id}}">{{$objave->user->name}}</a></div>
                                    <div class="objava-display-buttons float-right">
                                        <button class="objava-display-shrani-btn" data-url="{{URL('admin/shranjeneobjave/store')}}" data-id="{{$objave->id}}"><i class="ik ik-bookmark f-16 mt-20 text-dark"></i></button>
                                        @if(Auth::user()->id == $objave->user->id)
                                            <a class="objava-display-izbrisi-btn" href="{{ URL('admin/objave/delete/' . $objave->id) }}"><i class="ik ik-trash f-16 mt-20 text-dark"></i></a>
                                        @endif
                                    </div>
                                </div>

                                <div class="objava-display-vsebina">{{$objave->vsebina}}</div>
                                
                                @if($objave->slika)
                                    <div class="objava-display-img"><img class="img-fluid" src="{{ URL::to( 'storage/app/public/objave/' . $objave->slika ) }}" /></div>
                                @endif
                                
                                <div class="objava-display-vsecki"><button class="objava-display-vsecki-button btn btn-danger mb-1" data-url="{{route('admin.objave.vseckaj')}}" data-id="{{$objave->id}}"><i class="fa fa-heart"></i><span class="vsecki-value">{{VseckiController::steviloVseckov($objave->id)}}</span></button></div>
                                
                                <div class="objava-display-objava">{{$objave->created_at->format('d - M - Y')}}</div>
                            </div>


                            <div class="komentar-display-holder">
                                <div class="komentar-display-header">
                                    <p class="mt-2 mb-0 fw-700">{{ __('Komentarji') }}:</p>
                                    <a href="{{ URL('admin/komentarji/create/' . $objave->id) }}" class="ajax_modal btn btn-sm btn-primary" data-type="modal-xl" data-klasa="fade" data-heading="{{ __('Dodaj nov komentar') }}"><i class="ik ik-plus-square"></i> {{ __('Dodaj nov komentar') }}</a>
                                </div>
                        @endif

                        @if($objave->komentarji)
                        @foreach ($objave->komentarji as $key => $value)

                            <div class="row komentar-display-card mb-10 green komentar-display-card-col">
                                <div class="col-xl-11 ">
                                    <h6>{{$value->user->name}}</h6>
                                    
                                    <p>{{$value->vsebina}}</p>
                                    <h6 class="datum-komentar-display">{{$value->created_at}}</h6>
                                </div>

                                <div class="col-xl-1">
                                    @if(Auth::user()->id == $value->user->id)
                                        <div><a class="izbrisi-komentar-display" href="{{ URL('admin/komentarji/delete/' . $value->id) }}"><i class="ik ik-trash ml-20"></i></a></div>
                                    @endif

                                </div>
                            </div>

                        @endforeach
                            </div>
                        @endif

                    </div>  

                </div>

            </div>

        </div>

    </form>

@endsection