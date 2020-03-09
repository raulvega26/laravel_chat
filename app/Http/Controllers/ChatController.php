<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Serializer;

class ChatController extends Controller
{
    
    public function checkExistUser(Request $request) {

    	$filename = "file.txt";
    	$user_exist = false;

    	$array_unserializer = Serializer::restore($filename);
    	$array_decoded = json_decode($array_unserializer);
    	$last_iter = 0;
    	$new_array = [];
    	$email = $request->email;

    	if (empty($email) || is_null($email)) {
    		$email = session('email');
    	}

    	if (!empty($array_decoded)) {
    	
	    	foreach($array_decoded as $key => $value) {
	    		if ($value == $email) {
	    			$user_exist = true;
	    		}
	    		$last_iter = $key;
	    		$new_array[$key] = $value;
	    	}
    	}

    	if (!$user_exist && empty($array_decoded)) {
    		Serializer::save(json_encode(array(1 => $email)), $filename);
    		session(['email' => $email]);
    	} else if (!$user_exist){
    		$new_array[($last_iter+1)] = $email;
    		Serializer::save(json_encode($new_array), $filename);
    		session(['email' => $email]);
    	} 

    	
    	if ($user_exist && is_null(session('email'))) {
    		return view('/welcome',['data'=>'el usuario que intenta acceder ya esta logeado,<br> estas intentando acceder a una zona restringida!']);
    	}
   		
    	// devolvemos usuarios logeads, según el txt
    	
    	return view('chat',['users'=> $new_array]);
    }

    public function logoutUser(Request $request) {
    	$filename = "file.txt";

    	$email = session('email');

    	$array_unserializer = Serializer::restore($filename);
    	$array_decoded = json_decode($array_unserializer);
    	$new_array = [];

    	foreach($array_decoded as $key => $value) {

    		if ($value != $email) {
    			$new_array[$key] = $value;
    		} else {
    			$request->session()->forget('email');
    		}
    	}

    	Serializer::save(json_encode($new_array), $filename);

    	return view('/welcome');
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