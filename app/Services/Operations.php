<?php
namespace App\Services;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Operations{
    public static function decryptId($id){
         //check if $id is encrypted or not
          try {
            $decrypted_id = Crypt::decrypt($id);

        } catch (DecryptException $e) {
            // Decryption failed — handle appropriately (e.g., show 404 or error message)
            return null;
        }
        return $decrypted_id;
    }
}
