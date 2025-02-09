<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\ArticleLike;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Pagecontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
    }
    public function index(Request $request)
    {
        if (isset($request->search)){
            $search = $request->search;
            $articles = Article::withCount('like','comment')
            ->where('title','like',"%{$search}%")
            ->latest()->paginate(6);
            $articles->appends($request->all());
        }else{
            $articles = Article::withCount('like','comment')->latest()->paginate(6);
        }
        
        return view('index',compact('articles'));
    }

    public function createArticle()
    {
        $cat = Category::all();
        $lang = Language::all();
        return view('create',compact('cat', 'lang'));
    }

    public function postArticle(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('showlogin')->with('danger', 'You must be logged in to create an article.');
        }
        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'article' => 'required',
            'image' => 'required',
        ]);
        $file = $request->file('image');
        $file_name = uniqid() . '_' . $file->getClientOriginalName();
        $file_path = $file->storeAs('image', $file_name);

        $a=Article::create([
            'user_id' => Auth::user()->id,
            'category_id' => $request->category_id,
            'title' => $request->title,
            'slug' => uniqid(time()).Str::slug($request->title),
            'image' => $file_path,
            'description' => $request->article
        ]);
        Article::find($a->id)->language()->sync($request->language);
        return redirect()->back()->with('success','Article created successfully');
    }

    public function articleByCategory(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();

        if (!$category) {
            return redirect()->back()->with('error', 'Invalid category!');
        }

        $articles = Article::withCount('like', 'comment')->where('category_id', $category->id)->paginate(6);

        if ($articles->isEmpty()) {
            $error_message = 'No articles found for this category!';
            return view('index', compact('articles', 'error_message'));
        }

        return view('index', compact('articles'));
    }

    public function articleBylanguage(Request $request, $slug)
    {
        $language = Language::where('slug', $slug)->first();

        if (!$language) {
            return redirect()->back()->with('error', 'Invalid Language!');
        }

        $articles = Article::withCount('like', 'comment')
            ->whereHas('language', function($q) use ($language) {
                $q->where('language_id', $language->id);
            })->paginate(6);

        if ($articles->isEmpty()) {
            $error_message = 'No articles found for this language!';
            return view('index', compact('articles', 'error_message'));
        }

        return view('index', compact('articles'));
    }

    public function articledetail($slug)
    {
        $article = Article::where('slug',$slug)->withCount('like', 'comment')->with('category','language','comment')->first();
        return view('detail', compact('article'));
    }

    public function createLike($id)
    {
        $user_id = Auth::user()->id;
        $existing_like = ArticleLike::where('user_id', $user_id)
                                    ->where('article_id', $id)
                                    ->first();

        if ($existing_like) {
            return response()->json(['error' => 'You have already liked this article!'], 400);
        }

        ArticleLike::create([
            'user_id' => $user_id,
            'article_id' => $id,
        ]);

        $like_count = ArticleLike::where('article_id', $id)->count();
        return response()->json(['data' => $like_count]);
    }

    public function createComment(Request $request)
    {
        $request->validate([
            'comment' => 'required|string',
            'article_id' => 'required|integer|exists:articles,id',
        ]);

        $comment = $request->comment;
        $article_id = $request->article_id;

        ArticleComment::create([
            'user_id' => Auth::user()->id,
            'article_id' => $article_id,
            'comment' => $comment,
        ]);

        $comments = ArticleComment::where('article_id', $article_id)->with('user')->latest()->get();
        $data = "";

        foreach ($comments as $c) {
            $asset = asset($c->user->image);
            $data .= "
                <div class='card card-dark mt-1'>
                    <div class='card-body'>
                        <div class='row'>
                            <div class='col-md-1'>
                                <img src='{$asset}' style='width: 30px; height: 30px; border-radius: 50%;' alt='' />
                            </div>
                            <div class='col-md-4 d-flex align-items-center'>
                                {$c->user->name}
                            </div>
                        </div>
                        <hr />
                        <p>
                            {$c->comment}
                        </p>
                    </div>
                </div>
            ";
        }
        return response()->json(['data' => $data]);
    }


}