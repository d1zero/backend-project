<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Articles;
use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Support\Facades\Notification;
use App\Events\NewArticleEvent;
use Illuminate\Support\Facades\Gate;
use App\Models\ArticleComment;



class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = request()->get('page', 1);
        $articles = Cache::remember('articles:' . $currentPage, 2000, function () {
            return Articles::paginate(7);
        });
        return response()->json([
            $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response($this->authorize('create', [self::class]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id = null)
    {
        Gate::authorize('create-article');
        $newArticle = new Articles();
        $newArticle->name = request('name');
        $newArticle->short_desc = request('description');
        $newArticle->dateTest = request('date');
        $newArticle->save();
        Cache::forget('articles:all');
        $user = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($user, new NewArticleNotification($newArticle));
        event(new NewArticleEvent('asdasdas'));

        return response()->json([
            'article' => $newArticle
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Cache::rememberForever('article:' . $id, function () use ($id) {
            return Articles::findOrFail($id);
        });
        $comments = Cache::rememberForever('article:comments:' . $id . '', function () use ($id) {
            return ArticleComment::where('article_id', $id)->where('accept', true)->paginate(3);
        });
        return response()->json([
            'article' => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('update-article');
        $article = Articles::findOrFail($id);
        Cache::forget('articles:all');
        Cache::forget('articles:' . $id);
        return response([
            'article' => $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('update-article');
        $article = Articles::findOrFail($id);
        Cache::forget('articles:all');
        Cache::forget('articles:' . $id);
        return response([
            'article' => $article
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('delete-article');
        Cache::forget('articles:all');
        Cache::forget('articles:' . $id);
        Cache::forget('article:comments:' . $id);
        return response(Articles::findOrFail($id)->delete());
    }
}
