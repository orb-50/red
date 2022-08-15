<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css?20190101') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css?') }}<?php echo date('YmdHis'); ?>" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>

<body>
    <div>
        @include('layouts.navbar')
    </div>

    <div class="signin">

        <form class="form-signin" method="POST" action="{{route('Postlogin')}}">
            @csrf
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h1 class="h3 mb-3 font-weight-normal">ログインしてください</h1>
            <label for="inputEmail" class="sr-only">メールアドレス</label>
            <input type="email" name="email" id="inputEmail" class="form-control" placeholder="メールアドレス" required autofocus>
            <label for="inputPassword" class="sr-only">パスワード</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="パスワード" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
        </form>
        
    </div>
    <div class="container text-center">
        <a href="{{route('register')}}">登録はこちら</a>
    </div>
</body>