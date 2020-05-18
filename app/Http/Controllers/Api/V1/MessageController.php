<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageEvent;

class MessageController extends Controller
{
    public function send(Request $request)
    {
    	$user = $request->user()->name;
    	event(new MessageEvent($user, $request->message));
    	return $user;
    }
}
