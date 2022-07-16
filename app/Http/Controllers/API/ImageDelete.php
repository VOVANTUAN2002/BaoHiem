<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageDelete extends Controller
{
    public function insurance_images_delete($id)
    {
        echo __METHOD__;
        $insuranceImage = Image::find($id);
        dd($insuranceImage);
        $fullImgPath = storage_path($insuranceImage->photo_CMND_photo_contract);
        dd($insuranceImage);
        $insuranceImage->delete();
        return response()->json([
            'error' => false,
            'insuranceImage'  => $insuranceImage,
        ], 200);
        $insuranceImage->save();
    }
}
