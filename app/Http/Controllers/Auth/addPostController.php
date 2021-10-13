<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Notifications\UserPost;
use Illuminate\Support\Facades\Notification;
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
    public function store(Request $request, Post $post)
    {
        //dd(request()->all());
        $data = $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'image' => 'required|image',
            'type' => 'required|in:Public,Private'
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(3600, 7000);
        $image->save();

        $postData = $request->user()->posts()->create([
            'title' => $data['title'],
            'body' => $data['body'],
            'type' => $data['type'],
            'image' => $imagePath,

        ]);

        $postData->save();
        $users = User::all();

        if ($postData->type == "Public") {
            foreach ($users as $user) {
                Notification::route('mail', $user->email) //Sending mail to user
                    ->notify(new UserPost($post)); //With new post
            }
        };
        return redirect()->route('dashboard');
    }
}
