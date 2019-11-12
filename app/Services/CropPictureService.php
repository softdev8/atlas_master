<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSocialAccount;
use Illuminate\Support\Facades\Storage;

class CropPictureService
{
    /**
     * Crop picture and save it in storage
     *
     * @param null $oldPicture
     * @param $newPicture
     * @return string
     */
    public static function cropPicture($oldPicture = null, $request)
    {
        if($oldPicture){
            Storage::disk('public')->delete($oldPicture);
        }

        if(isset($request->avatar)){
            $base64 = base64_decode(str_replace(' ', '+', str_replace($request->data_url.',', '', $request->avatar)));
            $file =  rand ( 1, 100 ) . time() . ".jpg";
        }

        if(isset($request->logo)){
            $base64 = base64_decode(str_replace(' ', '+', str_replace($request->data_url.',', '', $request->logo)));
            $file =  rand ( 1, 100 ) . time() . ".jpg";
        }

        Storage::disk('public')->put($file, $base64);
        return $file;
    }

}