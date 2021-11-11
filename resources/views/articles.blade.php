@extends('layouts.layout')
@section('title', 'Articles')
@section('content')
<form action="" method="POST">
    @csrf
    <button type="submit">Submit</button>
</form>
@endsection