<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Intervention\Image\Facades\Image;

class addPostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        return view('auth.addPost');
    }
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'body' => 'required',
            'image' => 'required|image'
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit();
        $image->save();

        $request->user()->posts()->create([
            'body' => $data['body'],
            'image' => $imagePath
        ]);

        return back();
    }
}
