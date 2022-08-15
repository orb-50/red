<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset='utf-8'>
    <title>トップ画面</title>
</head>
<body>　　　ユーザーid:{{$user->id}} 名前:{{$user->name}}
    <table>
        <tr>
            <th>チケットid</th>
            <th>タイトル</th>
            <th>開始予定日</th>
            <th>終了予定日</th>
            <th>開始日</th>
            <th>終了日</th>
            <th>ユーザーid</th>
            <th>カテゴリ</th>
            <th>公開・非公開</th>
            <th>進捗率</th>
            <th>状態</th>
            <th>優先度</th>
            <th>作業時間</th>
    　　</tr>
        @foreach($tickets as $ticket)
        <tr>
            <td>{{$ticket->id}}</td>
            <td>{{$ticket["title"]}}</td>
            <td>{{$ticket["sStartAt"]}}</td>
            <td>{{$ticket["sFinishAt"]}}</td>
            <td>{{$ticket["startAt"]}}</td>
            <td>{{$ticket["finishAt"]}}</td>
            <td>{{$ticket["user_id"]}}</td>
            <td>{{$ticket['category_id']}}</td>
            <td>{{$ticket['open']}}</td> 
            <td>{{$ticket["progress"]}}</td>
            <td>{{$ticket['status']}}</td>
            <td>{{$ticket['priority']}}</td>
            <td>{{$ticket["work_hours"]}}</td>
            @if($user->id==$ticket["user_id"])
            <td><a href="{{url('/ticketUpdate')}}/?id={{$ticket['id']}}">編集</a></td>
            @endif
        </tr>
        @endforeach
        
    </table>
    <br>
    <a href="{{url('/home')}}" class="bbox">ホーム</a>
</body>
</html