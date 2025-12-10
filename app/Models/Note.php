<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{   protected $fillable = ['title', 'content'];

   //use softDeletes();
   public function user(){
       return $this->belongsTo(User::class);
    //

   }
}
