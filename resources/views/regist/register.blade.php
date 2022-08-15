<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset='utf-8'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>ユーザー登録フォーム</title>
</head>

<body>
    @include('layouts.navbar')
    <div class="container mt-3">

        <div class="row">

            <div class="col-md-4 order-md-1 mx-auto">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <h4 class="mb-3">ユーザー登録</h4>
                <form class="" action="{{route('Postregister')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class=" mb-3">
                            <label for="name">ユーザー名</label>
                            <input type="text" class="form-control" id="name" placeholder="" value="" name="name" required>
                        </div>
                    </div>

                    <div class="">
                        <div class=" mb-3">
                            <label for="name">メールアドレス</label>
                            <input type="text" class="form-control" id="name" placeholder="" value="" name="email" required>
                        </div>
                    </div>

                    <div class="">
                        <div class=" mb-3">
                            <label for="AspiringJob">希望職種</label>
                            <input type="text" class="form-control" id="AspiringJob" placeholder="" value="" name="AspiringJob">
                        </div>
                    </div>

                    
                        <div class=" mb-3">
                            <label for="image">画像</label>
                            <input type="file" class="" id="image" placeholder="" value="" name="image">
                        </div>
                    

                    <div class="">
                        <div class=" mb-3">
                            <label for="password">パスワード</label>
                            <input type="password" class="form-control" id="password" placeholder="" value="" name="password" required>
                        </div>
                    </div>

                    <div class="">
                        <div class=" mb-3">
                            <label for="password_confirmation">パスワード（確認）</label>
                            <input type="password" class="form-control" id="password_confirmation" placeholder="" value="" name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="row no-gutters">
                        <a href="{{route('home')}}" class="btn btn-primary btn-lg active col-md-4" role="button" aria-pressed="true">キャンセル</a>
                        <button class="btn btn-primary btn-lg btn-block col-md-4 offset-md-4" type="submit">ユーザー登録</button>
                    </div>
                </form>
                <div class="mt-3"><a href="{{route('login')}}">ログインはこちら</a></div>
            </div>
            
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">


        </footer>
    </div>
</body>

</html>