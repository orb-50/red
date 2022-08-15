<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css?1') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        .form-control::placeholder {
            color: #dcdcdc;
        }
    </style>
    <title>Document</title>
</head>

<body>

    @include('layouts.navbar')
    <div class="container mt-1">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title m-b-0">チケット一覧</h5>
                    </div>
                    
                    <div class="container" th:fragment="search">
                        <form action="{{route('search')}}" method="get">
                            @csrf
                            <div class="form-group form-inline input-group-sm">
                                <label for="name" class="col-md-1">タイトル</label>
                                <input type="text" class="form-control col-md-1" id="title" value="{{request()->title}}" name="title" placeholder="タイトル">
                                <label for="" class="col-md-1 control-label">名前</label>
                                <input type="text" class="form-control col-md-1" id="isbn" value="{{request()->name}}" name="name" placeholder="名前">
                                <label for="" class="col-md-1 control-label" name="category">カテゴリー</label>
                                <select name="category" id="" class="form-control col-md-1">
                                    <option value="0">全て</option> 
                                    @foreach ($categories as $category )
                                    {{request()->category}}
                                    <option value="{{$category->id}}" @if(request()->category==$category->id) selected @endif>{{$category->category}}</option>    
                                    @endforeach
                                </select>
                                <label for="name" class="col-md-1">公開・　非公開</label>
                                <select name="open" id="" class="form-control col-md-1">
                                    <option value="0" selected>全て</option>
                                    <option value="1" @if(request()->open=="1") selected @endif>公開</option>
                                    <option value="2" @if(request()->open=="2") selected @endif>スタッフにのみ公開</option>
                                    <option value="3" @if(request()->open=="3") selected @endif>非公開</option>
                                </select>
                                <label for="name" class="col-md-1">状態</label>
                                <select name="status" id="" class="form-control col-md-1">
                                    <option value="0">全て</option>
                                    <option value="4" @if(request()->status=="4") selected @endif>未着手</option>
                                    <option value="5" @if(request()->status=="5") selected @endif>着手中</option>
                                    <option value="6" @if(request()->status=="6") selected @endif>完了</option>
                                </select>
                                <label for="name" class="col-md-1">優先度</label>
                                <select name="priority" id="" class="form-control col-md-1">
                                    <option value="0">全て</option>
                                    <option value="7" @if(request()->priority=="7") selected @endif>低</option>
                                    <option value="8" @if(request()->priority=="8") selected @endif>中</option>
                                    <option value="9" @if(request()->priority=="9") selected @endif>高</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-sm btn-outline-secondary" type="submit">検索</button>
                                <a class="btn btn-sm btn-outline-secondary" href="{{route('ticketList')}}">検索条件クリア</a>
                            </div>
                            
                        </form>
                        <hr>
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
                                    <td>
                                        @if($ticket->category->category)
                                        {{$ticket->category->category}}
                                        @else
                                        なし
                                        @endif
                                    </td>
                                    <td>{{config("const.open.$ticket->open")}}</td>
                                    <td>{{$ticket["progress"]}}</td>
                                    <td>{{config("const.status.$ticket->status")}}</td>
                                    <td>{{config("const.priority.$ticket->priority")}}</td>
                                    <td>{{$ticket["work_hours"]}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- {{$tickets->links('vendor.pagination.aaa')}} --}}
                        {{$tickets->appends(request()->query())->links('vendor.pagination.aaa')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="my-3 pt-3 text-muted text-center text-small">

    </footer>
</body>