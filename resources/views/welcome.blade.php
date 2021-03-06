<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>init session</title>
		<style>
			
		</style>
        <!-- Fonts -->
        <!--<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet"> -->
		
        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" /> 
    </head>
    <body>
		
        

        {{session('email')}}
        <div class="content">
            <div class="prueba">
               <form method="post" action="{{ route('chat')}}" enctype="multipart/form-data">
                	{{ csrf_field() }}
                	<table id="table_form">
						<tr><td class="nombre_etiqueta"><label for="exampleInputEmail1">Nombre de usuario</label></td>
						<td><input type="email" required class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Escribe tu nombre usuario"></td></tr>
						
						<tr><td class="nombre_etiqueta"><label for="exampleInputPassword1">Foto</label></td>
						<td><input type="file" class="form-control" id="photo" name="photo"></tr>
                        <tr><td></td><td><small id="fileHelp">El tamaño del fichero no debe ser superior a 2 MB.</small></td></tr>
						<tr><td></td><td><button type="submit" class="btn btn-primary">Iniciar sesión</button></td></tr>
						<tr><td></td><td>
						@php 
							if(isset($data)) {
								echo $data; 
							}
						@endphp
						</td></tr>
					</table>
				</form>
            </div>
        </div>
    </body>
</html>
