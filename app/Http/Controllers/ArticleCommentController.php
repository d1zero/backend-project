<?php

namespace App\Http\Controllers;

use App\Models\ArticleComment;
use App\Models\Articles;
use Illuminate\Http\Request;

class ArticleCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $article = Articles::findOrFail($id);
        if ($article){
            $comment_title = request('title');
            $comment_text = request('comment');
            if ($comment_title && $comment_text) {
                $new_comment = new ArticleComment();
                $new_comment->title = $comment_title;
                $new_comment->comment = $comment_text;
                $new_comment->article()->associate($article);
                $new_comment->save();
                return redirect('/articles/'.$id);
            }
        }
    }
}
