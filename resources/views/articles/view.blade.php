@extends('layouts.layout')
@section('content')
<h1>{{$article->name}}</h1>
<p>{{$article->short_desc}}</p>
<p>{{$article->dateTest}}</p>
@endsection('content')