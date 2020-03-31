<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Serializer;

class ChatController extends Controller
{

    public function checkExistUser(Request $request) {

    	/* Picture */

    	if (isset(request()->photo)) {
    		$request->validate(['photo' => 'required|file|max:1024']);

	    	$imagename = request()->photo->getClientOriginalName();

	    	$request->photo->storeAs('public/logos', $imagename);

    	} else {
    		$imagename = "default.png";
    	}

    	
    	/* End Picture */

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
	    		if ($value[0] == $email) {
	    			$user_exist = true;
	    		}
	    		$last_iter = $key;
	    		$new_array[$key] = $value;
	    	}
    	}

    	if (!$user_exist && empty($array_decoded)) {
    		Serializer::save(json_encode(array(1 => [$email, $imagename, time()])), $filename);
    		session(['email' => $email]);
    		$new_array[$last_iter] = [$email, $imagename, time()];
    	} else if (!$user_exist) {
    		$new_array[($last_iter+1)] = [$email, $imagename, time()];
    		Serializer::save(json_encode($new_array), $filename);
    		session(['email' => $email]);
    	} 

    	if ($user_exist && is_null(session('email'))) {
    		return view('/welcome',['data'=>'el usuario que intenta acceder ya esta logeado,<br> estas intentando acceder a una zona restringida!']);
    	} else if(!$user_exist && is_null(session('email'))) {
    		return view('/welcome',['data'=>'estas intentando acceer a una zona restringida sin iniciar sesión!']);
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

    		if ($value[0] != $email) {
    			$new_array[$key] = $value;
    		} else {
    			$request->session()->forget('email');
    		}
    	}

    	Serializer::save(json_encode($new_array), $filename);

    	return view('/welcome');
    }

    public function sendMessage(Request $request) {

    	$filename = "chat.txt";

    	/* chat */

    	$new_array = [];

    	array_push($new_array, [session('email'), date(time()), $request->text]);
    	Serializer::save(json_encode($new_array), $filename);

    	$array_unserializer = Serializer::restore($filename);
    	$array_decoded_chat = json_decode($array_unserializer);

    	/* end chat */

    	$filename = "file.txt";

    	/* users */

    	$array_unserializer = Serializer::restore($filename);
    	$array_decoded_users = json_decode($array_unserializer);

    	/* end users */

    	return view('chat', ['array_text' => $array_decoded_chat], ['users' => $array_decoded_users]);

    }
    
}

