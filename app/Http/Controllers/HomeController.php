<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Status;
use App\User;
use App\Friendship;

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
        $data = [
            'statuses' => Status::whereHas('user', function($query){
                return $query->whereHas('followers', function($q){
                    return $q->where('user_id', Auth::user()->id);
                });
            })->orWhereHas('user', function($query){
                return $query->where('user_id', Auth::user()->id);
            })->orderBy('created_at', 'DESC')->get(),
        ];

        return view('home', $data);
    }

    public function search(Request $request)
    {
        $input = $request->all();

        $query = isset($input['q']) ? $input['q'] : '';

        $search = User::where([
            ['name', 'like', '%'.$query.'%'],
            ['id', '<>', Auth::user()->id ],
        ])->get();

        $data = [
            'results' => $search,
            'query' => $query,
        ];

        return view('search', $data);
    }

    public function cuidado()
    {
        return view('warning');
    }
}
