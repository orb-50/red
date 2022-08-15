<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>
<body>
    <p>こんにちは！ゲストさん</p>
    <div>会員登録をしたくない場合は下記のユーザーでログインください</div>
    <div class="p-2 mb-1 bg-light text-dark">
        <div>一般ユーザー</div>
        <span>メールアドレス:user@gmail.com パスワード:password</span>
    </div>
    <div class="p-2 mb-1 bg-light text-dark">
        <div>スタッフ</div>
        <span>メールアドレス:stuff@gmail.com パスワード:password</span>
    </div>
    <div class="p-2 mb-1 bg-light text-dark">
        <div>管理者</div>
        <span>メールアドレス:admin@gmail.com パスワード:password</span>
    </div>
    <p>これはポートフォリオです重要な情報は入力しないでください。</p>
    <p><a href="{{url('/login')}}">ログイン</a><br><a href="{{url('/register')}}">会員登録</a></p>
</body>