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
    @include('layouts.navbar')
    <div>
        <div class="container mt-5 ">
            @if (!empty($user1))
                <div class="col-5 mx-auto bg-white">
                    <h4>管理者一覧</h4>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 20%">ユーザー名</th>
                                <th style="width: 20%">希望職種</th>
                                <th style="width: 20%">タスク一覧</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user1 as $user)
                                <tr>
                                    @if(Auth::user()->role=="1")
                                    <td style="width: 20%"><a href="{{route('admin.edit', $user)}}">{{$user->name}}</a></td>
                                    @else
                                    <td style="width: 20%">{{$user->name}}</td>
                                    @endif
                                    <td style="width: 20%">{{$user->AspiringJob}}</td>
                                    <td style="width: 20%"><a href="{{route('userlistticket',['id'=>$user->id])}}">タスク一覧</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (!empty($user2))
                <div class="col-5 mx-auto bg-white mt-5">
                    <h4>スタッフ一覧</h4>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 20%">ユーザー名</th>
                                <th style="width: 20%">希望職種</th>
                                <th style="width: 20%">タスク一覧</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user2 as $user)
                                <tr>
                                    @if(Auth::user()->role=="1")
                                    <td style="width: 20%"><a href="{{route('admin.edit', $user)}}">{{$user->name}}</a></td>
                                    @else
                                    <td style="width: 20%">{{$user->name}}</td>
                                    @endif
                                    <td style="width: 20%">{{$user->AspiringJob}}</td>
                                    <td style="width: 20%"><a href="{{route('userlistticket',['id'=>$user->id])}}">タスク一覧</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
            @if (!empty($user3))
                <div class="col-5 mx-auto bg-white mt-5">
                    <h4>ユーザー一覧</h4>
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 20%">ユーザー名</th>
                                <th style="width: 20%">希望職種</th>
                                <th style="width: 20%">タスク一覧</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user3 as $user)
                                <tr>
                                    @if(Auth::user()->role=="1")
                                    <td style="width: 20%"><a href="{{route('admin.edit', $user)}}">{{$user->name}}</a></td>
                                    @else
                                    <td style="width: 20%">{{$user->name}}</td>
                                    @endif
                                    <td style="width: 20%">{{$user->AspiringJob}}</td>
                                    <td style="width: 20%"><a href="{{route('userlistticket',['id'=>$user->id])}}">タスク一覧</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
    <div></div>
    <div></div>
</body>
