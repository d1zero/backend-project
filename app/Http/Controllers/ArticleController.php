<?php

namespace App\Http\Controllers;

use App\Events\NewArticleEvent;
use App\Models\ArticleComment;
use App\Models\Articles;
use App\Models\User;
use App\Notifications\NewArticleNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentPage = request()->get('page',1);
        $articles = Cache::rememberForever('articles:' . $currentPage, function() {
            return Articles::paginate(7);
        });
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', [self::class]);
        return view('articles.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id = null)
    {
        if ($id == null) $newArticle = new Articles();
        else $newArticle = Articles::findOrFail($id);
        $newArticle->name = request('name');
        $newArticle->short_desc = request('description');
        $newArticle->dateTest = request('date');
        $newArticle->save();
        Cache::forget('articles:all');
        $user = User::where('id', '!=', auth()->user()->id)->get();
        Notification::send($user, new NewArticleNotification($newArticle));
        event(new NewArticleEvent('asdasdas'));

        if ($id == null) return redirect('/articles');
        else return redirect('/articles/' . $id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Cache::rememberForever('article:'.$id, function()use($id) {
            return Articles::findOrFail($id);
        });
        $comments = Cache::rememberForever('article:comments:'.$id.'', function()use($id) {
            return ArticleComment::where('article_id', $id)->where('accept', true)->paginate(3);
        });
        return view('articles.view', ['article' => $article, 'comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $article = Articles::findOrFail($id);
        Cache::forget('articles:all');
        Cache::forget('articles:'.$id);
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Articles::findOrFail($id)->delete();
        Cache::forget('articles:all');
        Cache::forget('articles:'.$id);
        return redirect('/articles');
    }
}
