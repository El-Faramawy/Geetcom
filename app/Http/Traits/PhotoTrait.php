<?php

namespace App\Http\Traits;

Trait  PhotoTrait
{
    function saveImage($photo,$folder,$old_image=null){
        //save photo in folder
        if (file_exists($old_image))
            unlink($old_image);
        return $folder.'/'.$this->saveImage2($photo,$folder);
    }

    function saveImage2($photo,$folder){
        //save photo in folder

        $file_extension = $photo -> getClientOriginalExtension();
        $file_name = rand('1','9999').time().'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);
        return $file_name;
    }
}
