<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $imangess = Image::all();
        return view('upload', compact('imangess'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Get the uploaded file
        $image = $request->file('image');

        // Generate a unique name for the file
        $imageName = time() . '.' . $image->extension();

        // Move the uploaded file to the public/uploads directory
        $image->move(public_path('uploads'), $imageName);

        Image::create([
            'path' => 'uploads/'.$imageName
        ]);

        // Return a response with the path to the uploaded file
        // return response()->json(['path' => '/uploads/'.$imageName]);
        return redirect()->back();
    }
}
