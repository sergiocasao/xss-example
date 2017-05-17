<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Status;
use App\User;
use App\Friendship;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function follow(Request $request)
    {
        $input = $request->all();

        Friendship::create([
            'user_id' => Auth::user()->id,
            'follower_id' => $input['follower'],
        ]);

        return redirect()->back();
    }

}
