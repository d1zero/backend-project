@extends('layouts.layout')
@section('content')
<h1>{{$article->name}}</h1>
<p>{{$article->short_desc}}</p>
<p>{{$article->dateTest}}</p>
<br>

{{ $comments->links()}}
<br>
@isset($_GET['result'])
@if ($_GET['result']==true)
Комментарий отправлен на модерацию
@endif
@endisset
<br>
@canany('update-article', 'delete-article')
<a href="/articles/{{$article->id}}/edit" class='btn'>Редактировать</a>
<a href="/articles/{{$article->id}}/delete" class='btn'>Удалить</a>
@endcan()
<br>


<form action="/comments/{{$article->id}}/add_comment" method="post">
    @csrf
    <label for="title">Заголовок комментария</label><br>
    <input type="text" name="title" id="title" placeholder="Введите заголовок"><br>
    <textarea name="comment" id="" cols="30" rows="10" placeholder="Введите текст комментария"></textarea><br>
    <button type="submit">Отправить</button>
</form>

<h3>Комментарии</h3>
<div>
    @foreach($comments as $comment)
    <strong>{{$comment->title}}</strong>
    <p>{{$comment->comment}}</p>
    @endforeach
    {{$comments->links()}}
</div>

@endsection('content')