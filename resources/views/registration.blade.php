@extends('layouts.layout')
@section('title', 'Register')
@section('content')
<h3>Регистрация</h3>
<form action="/register" method="post">
    @csrf
    <label for="name">Введите имя</label><br>
    <input type="text" name="name" id="name"><br>
    <label for="email">Введите email</label><br>
    <input type="email" name="email" placeholder="email@example.com"><br>
    <label for="password">Придумайте пароль</label><br>
    <input type="password" name="password" id="password"><br>
    <button type="submit">Зарегистрироваться</button>
</form>
@endsection