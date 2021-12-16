@extends('layouts.layout')
@section('content')
@for ($i=0; $i<$comments->count();$i++)
    <div>
        <p>{{$articles[$i]->name}}</p>
        <p>{{$comments[$i]->title}}</p>
        <p>{{$comments[$i]->comment}}</p>
        @if ($comments[$i]->accept == false)
        <a href="/comments/{{$comments[$i]->id}}/accept">Принять</a>
        <a href="/comments/{{$comments[$i]->id}}/delete">Отклонить</a>
        @else
        <p>Активен</p>
        <a href="/comments/{{$comments[$i]->id}}/delete">Удалить</a>
        @endif
    </div>
    @endfor
    @endsection