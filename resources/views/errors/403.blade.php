<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" >

	<head>

		<title>{{ __('Ne najdem strani') }} | {{ __('app_main_title') }}</title>
		<meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow" />

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" />

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

	</head>

	<body>

        <div class="mct-404">

            <div class="not-found">

                <div class="not-found-404"></div>

                <h1>{{ __('403') }}</h1>
                <h2>{{ __('Oops! Strani ni mogoče najti') }}</h2>
                <p>{{ __('Žal stran, ki jo iščete, ne obstaja, je bila odstranjena, je spremenjena ali začasno ni na voljo') }}</p>

                <a href="{{ url('/') }}">{{ __('Nazaj na prvo stran') }}</a>

            </div>

        </div>

	</body>
	
</html>