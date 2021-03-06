<?php

namespace App\Http\Controllers;

use App\Mail\SignUp;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Services\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $category_id = $request->category_id;
        $user_id = $request->user_id;

        if($category_id){
            $articles = Article::where('category_id', $category_id)->orderByDesc('created_at')->paginate(10);
        } elseif($user_id) {
              $articles = Article::where('user_id', $user_id)->orderByDesc('created_at')->paginate(10);
        } else{
            $articles = Article::orderByDesc('created_at')->paginate(10);
        }
        $categories = Category::all();

        return view('main', ['articles' => $articles, 'categories' => $categories]);
    }


    public function foo()
    {
        $articles = Article::all()
            ->map(function($item){
                return [
                    'title' => $item->title,
                    'content' => $item->content,
                    'author' => $item->user['name'],
                ];
            })->toArray();

        dump($articles);
    }


    private function __articleImageDestroy($request)
    {
        $user = User::find($request->user);
        if (isset($user->image)){
            if(Storage::disk('public')->exists($user->image)){
                Storage::delete($user->image);
            }
        }
    }

}
