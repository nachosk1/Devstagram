<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request){
        $image = $request->file('file');
        $nameImage = Str::uuid(). "." . $image->extension();   //el STR::uuid crea una id unico concatenado con el nombre
        $imageServer = Image::make($image);
        $imageServer->fit(1000, 1000);

        $imagePath = public_path('uploads') . '/' . $nameImage;
        $imageServer->save($imagePath);

        return response()->json([
            'image' => $nameImage
        ]);
    }
}
