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
        <form method="post" action="{{ route('message')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table align="center" style="border:3px solid;">
                <tr style="height: 500px;">
                    <td style="width: 200px; border:1px solid;">
                        <table style="margin-left:-10px !important; margin:-5px; margin-top:-240px !important; ">
                            @foreach ($users as $user)
                                @if (!is_null($user))
                                    <tr><td><img style="height:35px !important; width: 30px !important; margin-top:-10px !important; margin-bottom:-10px !important;" src="{{ url('storage/logos/'.$user[1]) }}"></td><td style="border:1px solid;">{{ $user[0] }}</td></tr>
                                @endif
                            @endforeach
                                
                        </table>
                    </td>
                    <td style="width:600px; border:1px solid;">
                        <table style="margin-top: -255px !important; ">
                            @if (isset($array_text))
                                @foreach ($array_text as $user_info)
                                    <tr style="font-size:12px;"><td>{{ $user_info[0] }}</td><td style="padding-left:500px;">{{ $user_info[1]}}</td></tr>
                                    <tr style="padding-top:-5px !important;"><td>{{ $user_info[2] }}</td></tr>
                                @endforeach
                            @endif
                        </table>

                    </td>
                </tr>
                <tr style="height: 60px;"><td style="border:1px solid;"></td><td style="border:1px solid;">
                    <textarea name="text" id="text" style="height: 60px; width:500px; margin:-10px"></textarea>
                    <input type="submit" style="margin-left:40px; margin-top:20px;" value="Enviar"></td>
                </tr>
            </table>
        </form>


    </body>
</html>