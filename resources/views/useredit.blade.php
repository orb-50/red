<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>

<body>
    @include('layouts.navbar')

</html>

<div class="container mt-5">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('usereditupdate',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="col-md-7 order-md-1 mx-auto">
            <h4 class="mb-3">ユーザー編集</h4>
            <div class="col-md-6 mb-3 mx-auto">
                <label for="firstName">ユーザー名</label>
                <input type="text" class="form-control" id="firstName" placeholder="" value="{{$user->name}}" name="name" required>
            </div>

            <div class="col-md-6 mb-3 mx-auto">
                <label>希望職種</label>
                <input type="text" class="form-control" name="AspiringJob" value="{{$user->AspiringJob}}">
            </div>

            <div class="col-md-6 mb-3 mx-auto">
                <label>メールアドレス</label>
                <input type="email" class="form-control" name="email" value="{{$user->email}}">
            </div>

            <div class="col-md-6 mb-3 mx-auto">
                <label for="image">画像</label>
                <input type="file" class="" id="image" placeholder="" value="" name="image">
            </div>
            <div class="col-md-6 mb-3 mx-auto">
                {{-- アバター表示 --}}
                @if ($user->image=="user_default.jpg")
                <img class="img-fluid" src="{{asset('images/user_default.jpg')}}">
                @else
                <img class="img-fluid" src="{{asset('storage/images/'.($user->image))}}">
                @endif
            </div>
            <div class="col-md-6 mb-3 mx-auto">
                <label>パスワード</label>
                <input type="password" class="form-control" name="password">
            </div>


            <div class="col-md-6 mb-3 mx-auto">
                <label>パスワードの確認</label>
                <input type="password" class="form-control" name="password_confirmation">
            </div>

            <div class="col-md-6 mb-3 mx-auto clearfix">
                <div class="float-right test-box mr-3">
                    <button type="submit">変更</button>
                </div>
            </div>
        </div>
    </form>
    <footer class="my-5 pt-5 text-muted text-center text-small">

    </footer>
</div>
</body>
