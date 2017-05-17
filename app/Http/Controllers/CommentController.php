<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Status;

class CommentController extends Controller
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

    public function store(Request $request, Status $status)
    {
        $input = $request->all();

        $status->comments()->create([
            'comment' => $input['comment'],
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('home');
    }
}
