@if ( $errors->any() )
    						
	<div class="alert alert-danger display-hide fade in" style="display: block;">
		<button class="close" data-close="alert"></button>
			<ul>
    		
    		@foreach ( $errors->all() as $error )
    		
    			<li>{{ $error }}</li>
    			
    		@endforeach
    		
    		</ul>
	</div>
	
@endif