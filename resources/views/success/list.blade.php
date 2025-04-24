@if ( Session::has( 'flash_message' ) )
    						
	<div class="alert alert-block alert-success fade in" style="display: block;">
		<button class="close" data-close="alert"></button>
		
			{{ Session::get( 'flash_message' ) }}
			
	</div>
	
@endif

@if ( Session::has( 'flash_message_err' ) )
    						
	<div class="alert alert-block alert-danger fade in" style="display: block;">
		<button class="close" data-close="alert"></button>
		
			{{ Session::get( 'flash_message_err' ) }}
			
	</div>
	
@endif