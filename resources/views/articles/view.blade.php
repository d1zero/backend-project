@extends('layouts.layout')
@section('content')
<h1>{{$article->name}}</h1>
<p>{{$article->short_desc}}</p>
<p>{{$article->dateTest}}</p>
<br>
<form action="/articles/{{$article->id}}/add_comment" method="post">
    @csrf
    <h3>Оставить комментарий</h3>
    <label for="title">Заголовок комментария</label><br>
    <input type="text" name="title" id="title" placeholder="Введите заголовок"><br>
    <textarea name="comment" id="" cols="30" rows="10" placeholder="Введите текст комментария"></textarea><br>
    <button type="submit">Отправить</button>
</form>
<br>
<h3>Комментарии</h3>
<div>
    @foreach($comments as $comment)
    <strong>{{$comment->title}}</strong>
    <p>{{$comment->comment}}</p>
    @endforeach
    {{$comments->links()}}
</div>

@endsection('content')