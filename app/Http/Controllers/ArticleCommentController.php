<?php

namespace App\Http\Controllers;

use App\Jobs\VeryLongJob;
use App\Models\ArticleComment;
use App\Models\Articles;
use Illuminate\Http\Request;


class ArticleCommentController extends Controller
{
    public function index()
    {
        $comments = ArticleComment::orderBy('accept', 'asc')->get();
        foreach ($comments as $comment) {
            $articles[] = Articles::findOrFail($comment->article_id);
        }
        return view('comments.index', ['comments' => $comments, 'articles' => $articles]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $article = Articles::findOrFail($id);
        if ($article) {
            $comment_title = request('title');
            $comment_text = request('comment');
            if ($comment_title && $comment_text) {
                $new_comment = new ArticleComment();
                $new_comment->title = $comment_title;
                $new_comment->comment = $comment_text;
                $new_comment->article()->associate($article);
                $result = $new_comment->save();
                if ($result){
                    VeryLongJob::dispatch($article);
                }
                return redirect()->route('show', ['id' => $id, 'result' => $result]);
            }
        }
    }

    public function accept($id)
    {
        $comment = ArticleComment::findOrFail($id);
        $comment->accept = true;
        $comment->save();
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        ArticleComment::findOrFail($id)->delete();
        return redirect()->route('index');
    }
}
