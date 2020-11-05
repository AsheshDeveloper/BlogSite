<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    ///a function inside a class is as also recognized as a method
    // CRUD operation: Create, Read, Update and Delete
    public function index()
    {
        // return 'Index'
        $title = "Welcome to Laravel Blog Integration!";
        // Two methods 1. With parameter and 2. with actual value adding on it
        // return view('pages.index', compact('title'));
        return view('pages.index')->with('title', $title);
    }
    public function about()
    {
        // return 'About'
        $title = "About Us";
        return view('pages.about')->with('title', $title);
    }
    public function services()
    {
        // return 'Services'
        $data = array(
            'title' => 'Our Services',
            'services' => ['Web Design', 'Programming']
        );
        return view('pages.services')->with($data);
    }
}
