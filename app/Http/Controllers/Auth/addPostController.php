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
        //dd(request()->all());
        $data = $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image'
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(3600, 7000);
        $image->save();

        $request->user()->posts()->create([
            'title' => $data['title'],
            'body' => $data['body'],
            'image' => $imagePath
        ]);



        return redirect()->route('dashboard');
    }
}
