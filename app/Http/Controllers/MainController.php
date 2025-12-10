<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Note;
use App\Services\Operations;


class MainController extends Controller
{
    public function index()
    {
        //load users  notes
           // Verifica se o usuário está logado
    $id = session('user.id');

    if (is_null($id)) {
        return redirect()->route('login'); // Redirecione para a página de login, se necessário
    }

    // Carrega as notas do usuário
    $notes = User::find($id)->notes()->whereNull('deleted_at')->get()->toArray();

    // Retorna a view com as notas
    return view('home', ['notes' => $notes]);
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
        ]); echo "ok";
        //get user id
        $id=session('user.id');

        //create new note
        $notes=new Note();
        $notes->user_id=$id;
        $notes->title=$request->text_title;
        $notes->text=$request->text_note;
        $notes->save();
        //redirect to home
        return redirect()->route('home');

    }

   public function editNote($id)
{
    $id = Operations::decryptId($id);

    // Verifica se o ID é nulo após desencriptação
    if (is_null($id)) {
        return redirect()->route('home'); // Redireciona se o ID não for válido
    }

    // Carrega a nota correspondente ao ID
    $note = Note::find($id);

    // Verifica se a nota existe
    if (is_null($note)) {
        return redirect()->route('home'); // Redireciona se a nota não for encontrada
    }

    // Retorna a view se a nota existir
    return view('edit_note', ['note' => $note]);
}
    public function editNoteSubmit(Request $request){
       // Validação do request
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
         //check if note_id exists
         if($request->note_id==null){
            return redirect()->route('home');
         }
            //decrypt note id
            $id=Operations::decryptId($request->note_id);
            //find note by id
            $note=Note::find($id);
            //update note
            $note->title=$request->text_title;
            $note->text=$request->text_note;
            $note->save();
            //redirect to home
             return redirect()->route('home');
         //

        }



    public function deleteNote($id){
        $id=Operations::decryptId($id);
        //load note by id
        $note=Note::find($id);
        //show delete confirmation view
        return view('delete_note',['note'=>$note]);
        //return view
        


    }

    public function deleteNoteConfirm($id){
        $id=Operations::decryptId($id);
        //load note by id
        $note=Note::find($id);
    

        //HARD delete
        //$note->delete();

        //soft delete

        //$note->deleted_at=date('Y:m:d H:i:s');
        //$note->save();

        /*soft delete (propety in model)
        $note->softDelete();
        
        ignora esse metodo está depreciado*/

        $note->forcedelete();


        //redirect

        return redirect()->route('home');

    }



}
