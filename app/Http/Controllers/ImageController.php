<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function addImage(Request $request)
    {
        $request->validate([
            'label' => 'required',
            'image_url' => 'required'
        ]);

        $uploader = new Image;
        $uploader->image_url = $request->image_url;
        $uploader->label = $request->label;
        $uploader->save();

        return response(201)->json("Image saved successfuly");

    }

    public function getImages()
    {
        return Image::pluck('image_url', 'label')->orderBy('desc');
    }

    public function searchByLabel(string $label)
    {
        $result = Image::where('label', $label);
        return $result;
    }

    public function deleteImage($id)
    {
        Image::where('id', $id)->first()->delete();
        
        return response(200)->json("Image deleted successfully!!");
    }
}
