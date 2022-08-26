<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css?1') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>

<body>

    @include('layouts.navbar')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title m-b-0">タスク一覧</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light small">
                                <tr>
                                    <th style="width: 4%">番号</th>
                                    <th style="width: 8%">タイトル</th>
                                    <th style="width: 9%">開始予定日</th>
                                    <th style="width: 9%">終了予定日</th>
                                    <th style="width: 9%">開始日</th>
                                    <th style="width: 9%">終了日</th>
                                    <th style="width: 6%">名前</th>
                                    <th style="width: 6%">カテゴリー</th>
                                    <th style="width: 9%">公開・非公開</th>
                                    <th style="width: 6%">進捗率</th>
                                    <th style="width: 6%">状態</th>
                                    <th style="width: 6%">優先度</th>
                                    <th style="width: 6%">作業時間</th>
                                </tr>
                            </thead>
                            <tbody class="customtable">
                                @foreach($tickets as $ticket)
                                <tr>
                                    <td>{{$ticket->id}}</td>
                                    <td><a href="{{route('detail', ['id' => $ticket->id])}}">{{$ticket["title"]}}</a></td>
                                    <td>{{$ticket["sStartAt"]}}</td>
                                    <td>{{$ticket["sFinishAt"]}}</td>
                                    <td>{{$ticket["startAt"]}}</td>
                                    <td>{{$ticket["finishAt"]}}</td>
                                    <td>{{$ticket->user->name}}</td>
                                    <td>{{$ticket->category->category}}</td>
                                    <td>{{config("const.open.$ticket->open")}}</td>
                                    <td>{{$ticket["progress"]}}</td>
                                    <td>{{config("const.status.$ticket->status")}}</td>
                                    <td>{{config("const.priority.$ticket->priority")}}</td>
                                    <td>{{$ticket["work_hours"]}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$tickets->links('vendor.pagination.aaa')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="my-3 pt-3 text-muted text-center text-small">

    </footer>
</body>