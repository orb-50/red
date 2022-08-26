@extends('layouts.layout')
@section('content')
@if(isset($message))
<div class="alert alert-success">{{$message}}</div>
@endif
    <p>こんにちは！
@if (Auth::check())
    {{ \Auth::user()->name }}さん</p>
    <p><a href="{{url('/ticket')}}">タスク入力</a></p>
    <p><a href="{{url('/ticketList')}}">タスク一覧</a></p>
    <p><a href="{{route('useredit', ['id' => Auth::user()->id])}}">プロフィール編集</a></p>
    <p><a href="{{url('/logout')}}">ログアウト</a></p>
@else
    ゲストさん</p>
    <p>これはポートフォリオです重要な情報は入力しないでください。</p>
    <p><a href="{{url('/login')}}">ログイン</a><br><a href="{{url('/register')}}">会員登録</a></p>
    
@endif
@endsection
