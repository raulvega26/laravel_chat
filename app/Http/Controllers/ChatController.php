<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function checkExistUser(Request $request) {

    	$filename = "file.txt";

    	if (!file_exists($filename)) {
    		$file = fopen($filename, "w");
			fwrite( $file, $request->email."\n" );
    	} else {

			echo "El fichero no esta vacio <br>";
    		$file = fopen($filename, "r", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    		$user_exist = false;
    		do {
    			$line = trim(fgets($file));

    			if (strcmp($line, $request->email) == 0) {
    				// se revisa y se mete en un flag que el usuario existe. Sino se tendra que guardar en el archivo
    				$user_exist = true;
    			}

    		}while (!feof($file));

    		$fclose($file);

    		if (!$user_exist) {
    			// se ha de guardar el nuevo usuario en el fichero en la última posicion del fichero


    		} 
    	}
    	
    	fclose( $file );
   		
    	// devolver a la vista el usuario actual "email" para mantener la sesión?
    	return view('chat');
    }
    
}
