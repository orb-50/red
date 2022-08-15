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
    
    <div class="signin flex-column">
        <form class="form-signin" action="{{route('category.store')}}" method="POST">
            @csrf
            <button onclick="location.href="
            class="btn btn-lg btn-primary btn-block" type="submit">カテゴリーを追加する</button>
        </form>
        <form class="form-signin" method="POST" action="{{route('category.update')}}">
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
            @foreach ($categories as $category )
            <div class="form-inline">
                <input type="text" name="category[{{$category->id}}]" id="" class="form-control" value="{{$category->category}}" >
                <button type="button" id="deletebtn" class="btn-primary" data-id="{{$category->id}}" 
                    data-action="{{route('category.delete',['category'=>$category->id])}}">
                    削除
                </button>
            </div>
            @endforeach
            <button class="btn btn-lg btn-primary btn-block" type="submit">編集</button>
        </form>
    </div>
    <form id="delete"  method="post">
        @csrf
    </form>
    <script language="JavaScript" type="text/javascript">
        const Delete = document.querySelectorAll('#deletebtn');
        Delete.forEach( primary =>  {
          primary.addEventListener('click', function(e){
            if(window.confirm("削除しますか")){
                const action=e.target.dataset.action;
                let primary_delete=document.getElementById('delete');
                primary_delete.action=action;
                primary_delete.submit();
                console.log(primary_delete.action);
                }
            }, )
        })
    </script>
</body>