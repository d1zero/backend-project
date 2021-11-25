@extends('layouts.layout')
@section('content')
<div>
    <p>Главная</p>
</div>
<a href="/register">Регистрация</a>
<a href="/login">Войти</a>
<form action="/logout" method="post">
    <button type="submit">Выйти</button>
</form>
@endsection