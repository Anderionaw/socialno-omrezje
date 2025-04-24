@extends('layouts.main') 
@section('title', __('Sporocila'))
@section('content')

<div class="page-header">

    <div class="row align-items-end">

        <div class="col-lg-8">
        </div>

        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/') }}"><i class="ik ik-home"></i></a>
                    </li>
                </ol>
            </nav>
        </div>

    </div>

</div>


<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card chatbox-card">
            <div class="card-header">
                <a href="{{ URL('admin/users/view/' . $user->id) }}"><h3>{{$user->name}}</h3></a>
            </div>
            <div class="card-body chat-box scrollable card-300">
                <ul class="chat-list">
                    @foreach($sporocila as $key => $sporocilo)
                        @if($sporocilo->id_uporabnika1 == Auth::user()->id)
                            <li class="odd chat-item">
                                <div class="chat-content">
                                    <div class="box bg-light-inverse">{{$sporocilo->vsebina}}</div>
                                    <div class="chat-time">{{$sporocilo->created_at}}</div>
                                </div>
                            </li>
                        @else
                            <li class="chat-item">
                                <div class="chat-img"><img src="{{ URL::to( 'storage/app/public/' . $user->slika) }}" alt=""></div>
                                <div class="chat-content">
                                    <h6 class="font-medium">{{ $user->name }}</h6>
                                    <div class="box bg-light-info">{{$sporocilo->vsebina}}</div>
                                </div>
                                <div class="chat-time">{{$sporocilo->created_at}}</div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="card-footer chat-footer">
                <form class="forms-sample mct_modl_form mct-sporocila-show-form" action="{{ route('admin.sporocila.store') }}" method="POST">
                    @csrf
                    <div class="input-wrap">
                        <input type="text" hidden="true" name="id_naslovnika" value="{{$user->id}}">
                        <input type="text" name="vsebina" placeholder="Napiši sporočilo..." class="form-control">
                    </div>
                    <button type="submit" class="btn btn-icon btn-theme"><i class="fa fa-paper-plane"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

    @push('script')
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap.min.js') }}"></script>
        <script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ asset('js/widgets.js') }}"></script>
    @endpush

@endsection