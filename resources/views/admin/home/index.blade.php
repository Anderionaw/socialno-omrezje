@extends('layouts.main') 
@section('title', __('Nadzorna plošča'))
@section('content')

<?php   
        use \App\Http\Controllers\Admin\VseckiController; 
?>

    @push('head')   
        <link rel="stylesheet" href="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.css') }}">
    @endpush

    <div class="container-fluid">

        {{ $home_text }}<br>

        @foreach ($objave as $key => $objava)
            <div class="objava-display-holder-card">
                <div class="objava-display-nav">
                    <div class="objava-display-user"><a href="admin/users/view/{{$objava->user->id}}">{{$objava->user->name}}</a></div>
                    <div class="objava-display-povecava"><a href="{{ URL('admin/objave/' . $objava->id) }}" class="ajax_modal" data-type="modal-xl" data-klasa="fade" data-heading="" title="{{ __('Poglej') }}"><i class="ik ik-eye mt-20 f-16 mr-15 text-dark"></i></a></div>
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

    @push('script')         
        <script src="{{ asset('plugins/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>
    @endpush

@endsection