<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Status;

class StatusController extends Controller
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

    public function store(Request $request)
    {
        $input = $request->all();

        Status::create([
            'user_id' => Auth::user()->id,
            'description' => $input['status'],
            'status_id' => isset($input['status_id']) ? $input['status_id'] : null,
        ]);

        return redirect()->route('home');
    }
}
