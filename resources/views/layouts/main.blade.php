<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

	<head>

		<title>@yield('title','') | {{ __('app_main_title') }}</title>
		
		@include('include.head')

	</head>

	<body id="app">

		<section id="mct-main-loading">
            <div id="mct-main-loading-content"></div>
        </section>

		<div class="wrapper">
			
			@include('include.header')

			<div class="page-wrap">
				
				@include('include.sidebar')

				<div class="main-content">
					@yield('content')
				</div>

				@include('include.chat')

				@include('include.footer')

			</div>

		</div>

		@include('include.script')

	</body>
	
</html>