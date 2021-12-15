@extends('layouts.layout')
@section('content')
<h3>Добавить статью</h3>
<form method="post" action="/articles/{{$article->id}}/edit">
    @csrf
    <div>
        <input type="text" name="name" id="name" value="{{$article->name}}">
        <label for="date">Дата создания</label>
        <input type="date" name="date" id="date" value="{{$article->dateTest}}">
    </div>
    <div>
        <textarea value="{{$article->short_desc}}" name="description" id="description" cols="30" rows="10" placeholder="Описание новости"></textarea>
    </div>

    <button type="submit">Сохранить</button>
</form>
@endsection