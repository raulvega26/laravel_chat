<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function checkExistUser(Request $request) {

    	echo $request->email;
    	return view('chat');
    }
    
}
