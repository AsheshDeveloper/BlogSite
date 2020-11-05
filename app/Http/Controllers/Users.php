<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// call user model to get user datas
use App\User;

class Users extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function list()
    {
        // return all users data from the model
        return User::all();
    }
}
