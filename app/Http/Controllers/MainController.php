<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Services\Operations;


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
        // Show new note View
        return view('new_note');
    }
    public function newNoteSubmit(Request $request){
        //validade  request
         $request->validate(//rules
            [
            'text_title' => 'required|min:3|max:200',
            'text_note' => 'required|min:3|max:3000',
            //error menssages,
        
            'text_title.required'=>'Tiltle is required',
            'text_title.min'=>'Note must be at least :min characters',
            'text_title.max'=>'Note must not exceed :max characters',
            'text_note.required'=>'Note is required',
            'text_note.min'=>'Note must be at least :min characters',
            'text_note.max'=>'Note must not exceed :max characters'
        ]);
        //get user id
        //create new note
        //redirect to home
    }

    public function editNote($id)
    {   //decrypt id e tratamento de erro
       // $id = $this->decryptId($id);
       $id=Operations::decryptId($id);
        echo "Editando anotação de id: $id";


    }

       public function deleteNote($id)
    {   //delete note id e tratamento de erro
       // $id=$this->decryptId($id);
       $id=Operations::decryptId($id);
        echo "<h1>Deletando anotação de id= :$id<h1>";


    }



}
