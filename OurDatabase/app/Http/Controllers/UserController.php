<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        //get all users

        $users = User::all();

        //blade view with users passed into it

        return view('users.index', compact('users'));
    }
}
