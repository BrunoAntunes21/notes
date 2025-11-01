<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        //load users notes

        //show hom view;

        return view('home');
    }

    public function newNote()
    {
        echo"<h1>criando uma nova anotação</h1>";
    }
}
