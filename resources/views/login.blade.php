@extends('layouts.layout')
@section('title', 'Login')
@section('content')
<h3>Войти</h3>
<form action="/login" method="post">
    @csrf
    <div>
        <input type="email" name="email" placeholder="Введите email"><br>
        <input type="password" name="password" id="password"><br>
    </div>
    <div>
        <label>
            <input type="checkbox" name="remember" id="">Запомнить меня
        </label><br>
        <button type="submit">Войти</button>
    </div>
</form>
@endsection