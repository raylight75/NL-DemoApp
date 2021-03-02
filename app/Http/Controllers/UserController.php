<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

/**
 * UserController
 */
class UserController extends Controller
{
    /**
     * Show all users.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $users = User::all();
        return view('layouts.users', compact('users'));
    }
}