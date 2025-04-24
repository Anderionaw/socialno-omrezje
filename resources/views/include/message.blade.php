<div class="col-md-12 mct_messages">

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mct_success" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
            </button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mct_error" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
            </button>

        </div>
    @endif

    @if ( $errors->any() )			
        <div class="alert alert-danger alert-dismissible fade show mct_errors" role="alert">
            <ul style="padding:0 0 0 18px;margin:0;">
                @foreach ( $errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="ik ik-x"></i>
            </button>
        </div>
    @endif

</div>