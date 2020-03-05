<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>init session</title>
		<style>
			header {
                text-align:right;
            }

            header label {
                font-weight:bold;
            }
		</style>
        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->
		
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" /> 
    </head>
    <body>
        <header>
            <label>User: </label> {{session('email')}}
            <a href="{{route('logout')}}">Log out</a>
        </header>
        
        Página principal del chat
    </body>
</html>