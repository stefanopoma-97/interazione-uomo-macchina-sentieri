<?php
use Illuminate\Support\Facades\Storage;
function getFotoProfilo($user_id){

    $exists = Storage::has("public/fotoprofilo/profilo".$user_id);
    if($exists)
        $url = asset(Storage::url("public/fotoprofilo/profilo".$user_id));
    else
        $url=asset(Storage::url("public/fotoprofilo/default"));
    
    return $url;
}
?>
