<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Administrator extends Controller
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
     * Show the list user
     *
     */
    public function listUser()
    {
        return view('administrator.user_list', [
            'users' => User::get()
        ]);
    }
}
