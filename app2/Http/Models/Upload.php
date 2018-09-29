<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model {

    public function uploadFile($file, $folder) {
        $destinationPath = public_path() . '/images/' . $folder;
        $fileName = str_replace(' ', '_', str_random(15) . '.' . $file->getClientOriginalExtension());
        $file->move($destinationPath, $fileName);
        return '/images/' . $folder . '/' . $fileName;
    }

}
