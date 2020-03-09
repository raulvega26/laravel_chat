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
        
        <h2 align="center">Chat</h2>
        <form>
            <table align="center" style="border:3px solid;">
                <tr style="height: 500px;">
                    <td style="width: 200px;  border:1px solid;">
                        <table style="margin:-10px;">
                            @foreach ($users as $user)
                                @if (!is_null($user))
                                    <tr><td></td><td style="border:1px solid;">{{ $user }}</td></tr>
                                @endif
                            @endforeach
                                
                        </table>
                    </td>
                    <td style="width:600px; border:1px solid;"></td>
                </tr>
                <tr style="height: 60px;"><td style="border:1px solid;"></td><td style="border:1px solid;"><textarea style="height: 60px; width:500px; margin:-10px"></textarea><input type="button" style="margin-left:40px; margin-top:20px;" value="Enviar"></td></tr>
            </table>
        </form>


    </body>
</html>