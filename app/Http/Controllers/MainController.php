<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

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
        echo "<h1>criando uma nova anotação</h1>";
    }

    public function editNote($id)
    {   //decrypt id e tratamento de erro
        $id = $this->decryptId($id);
        echo "Editando anotação de id: $id";


    }

       public function deleteNote($id)
    {   //delete note id e tratamento de erro
        $id=$this->decryptId($id);
        echo "<h1>Deletando anotação de id= :$id<h1>";


    }

    private function decryptId($id)
    {   //check if $id is encrypted or not
          try {
            $decrypted_id = Crypt::decrypt($id);

        } catch (DecryptException $e) {
            // Decryption failed — handle appropriately (e.g., show 404 or error message)
            return redirect()->route('home');
        }
    }

}
