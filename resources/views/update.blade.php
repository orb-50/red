<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form name="" action="{{url('/ticketUpdate')}}" method="post" id="">
    {{ csrf_field() }}
    <dl><input type="hidden" name="id" size="30" value="{{$ticket['id']}}">
        <dt>タイトル：</dt>
        <dd><input type="text" name="title" size="30" value="{{$ticket['title']}}" >
        </dd>
        <dt>開始予定日：</dt>
        <dd><input type="date" name="sStartAt" value="{{$ticket->sStartAt}}" required></dd>
        <dt>終了予定日：</dt>
        <dd><input type="date" name="sFinishAt" value="{{$ticket->sFinishAt}}" required></dd>
        <dt>開始日：</dt>
        <dd><input type="date" name="startAt" value="{{$ticket->startAt}}" required></dd>
        <dt>終了日：</dt>
        <dd><input type="date" name="finishAt" value="{{$ticket->finishAt}}" required></dd>
        <dt>カテゴリー</dt>
        <dd><select name="category" id="" ">
            <option value="1" selected>Aカテゴリー</option>
            <option value="2">Bカテゴリー</option>
            <option value="3">cカテゴリー</option>
        </select></dd>
        <dt>公開</dt>
        <dd><select name="open" id="" ">
            <option value="3">公開</option>
            <option value="2">スタッフにのみ公開</option>
            <option value="1"  selected>非公開</option>
        </select></dd>
        <dt>進捗率</dt>
        <dd><select name="progress" id="" ">
            @for($i=1;$i<=100;$i++)
            <option value="{{$i}}">{{$i}}％</option>
            @endfor
        </select></dd>
        <dt>状態</dt>
        <dd><select name="status" id="" ">
            <option value="2">完成</option>
            <option value="1" selected>着手中</option>
            <option value="0">未着手</option>
        </select></dd>
        <dt>優先度</dt>
        <dd><select name="priority" id="" ">
            <option value="3">高</option>
            <option value="2" selected>中</option>
            <option value="1">低</option>
        </select></dd>
    </dl>
    <button type='submit' name='action' value='send'>送信</button>
</form>
</body>
</html>