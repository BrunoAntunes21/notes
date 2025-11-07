<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MainController extends Controller
{
    public function index()
    {
        //load users  notes
        $id=session('user.id');
        $notes=User::find($id)->notes()->get()->toArray();



        //show home view;

        return view('home', [
            'notes' => $notes
        ]);
    }

    public function newNote()
    {
        echo"<h1>criando uma nova anotação</h1>";
    }

    public function editNote($id)
    {
        $decryptedId = decrypt($id);
        echo"<h1>Editando a anotação de ID: ".$decryptedId."</h1>";
    }
}
