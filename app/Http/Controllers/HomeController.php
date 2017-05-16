<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Status;
use App\User;

class HomeController extends Controller
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
    public function index()
    {
        // $status = Status::find(50);
        // $user = User::find(24);
        //
        // dd($status->isLikedBy($user));

        $data = [
            'user' => Auth::user(),
            'statuses' => Status::orderBy('created_at', 'DESC')->get(),
        ];

        return view('home', $data);
    }
}
