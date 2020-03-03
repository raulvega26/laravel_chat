<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Serializer;

class ChatController extends Controller
{
    
    public function checkExistUser(Request $request) {

    	$request->session()->put(['email'=>$request->email]);

    	$filename = "file.txt";
    	$user_exist = false;

    	$array_unserializer = Serializer::restore($filename);
    	$array_decoded = json_decode($array_unserializer);
    	$last_iter = 0;
    	$new_array = [];

    	if (!empty($array_decoded)) {
    	
	    	foreach($array_decoded as $key => $value) {
	    		if ($value == $request->email) {
	    			$user_exist = true;
	    		}
	    		$last_iter = $key;
	    		$new_array[$key] = $value;
	    	}
    	}

    	if (!$user_exist && empty($array_decoded)) {
    		Serializer::save(json_encode(array(1 => $request->email)), $filename);
    	} else if (!$user_exist){
    		$new_array[($last_iter+1)] = $request->email;
    		Serializer::save(json_encode($new_array), $filename);
    	} 
   		
    	// devolver a la vista el usuario actual "email" para mantener la sesión?
    	return view('chat');
    }
    
}



/*

Comprueba que existe un usuario (email) en el fichero que uso como base de datos, sino existe lo guarda

    	if (!file_exists($filename)) {
    		$file = fopen($filename, "w");
			fwrite( $file, $request->email."\n" );
    	} else {

    		$file = fopen($filename, "a+");
    		$user_exist = false;
    		do {
    			$line = trim(fgets($file));

    			if (strcmp($line, $request->email) == 0) {
    				// se revisa y se mete en un flag que el usuario existe. Sino se tendra que guardar en el archivo
    				$user_exist = true;
    			}

    		}while (!feof($file));

    		if (!$user_exist) {
    			// se ha de guardar el nuevo usuario en el fichero en la última posicion del fichero
    			$file = fopen($filename, "a+");
    			fwrite($file, $request->email."\n");
    		} 
    	}
    	
    	fclose( $file );

    	*/