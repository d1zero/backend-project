@extends('layouts.layout')
@section('content')
<div class="row">
    <h3>Статьи</h3>
    <div class="col-md-4 col-sm-12" style='margin-bottom: 10px;'>
        <div class="list-group">
            @foreach($articles as $article)
                <a href="/articles/{{$article->id}}" class="list-group-item list-group-item-acrtion">{{$article->name}}</a>
            @endforeach
            <a href="/articles/create" class="btn btn-primary" style='margin-top: 10px;'>Добавить статью</a>
        </div>
    </div>
    <br>
    {{$articles->links()}}
</div>
@endsection