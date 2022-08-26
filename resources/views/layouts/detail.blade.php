<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/comment.css') }}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <title>Document</title>
</head>

<body>

    @include('layouts.navbar')

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
        <div class="jumbotron col-md-8 mx-auto pb-4">
            <div class="col-md-10 order-md-1 mx-auto">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">タスクID&nbsp;:&nbsp;</label>
                        {{$ticket["id"]}}
                    </div>
                    @if($ticket->user_id==auth()->id()||Auth::user()->role==1)
                    <div class="col-md-6 mb-3">
                        <a href="{{route('ticketUpdate',['id' => $ticket->id])}}" class="btn btn-primary" tabindex="-1" role="button" aria-disabled="true">編集</a>
                        <a href="{{route('ticketdelete',['id' => $ticket->id])}}" class="btn btn-secondary" role="button" aria-pressed="true">削除</a>
                    </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">タイトル&nbsp;:&nbsp;</label>
                        {{$ticket["title"]}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">カテゴリ&nbsp;:&nbsp;</label>
                        {{$ticket->category->category}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">開始予定日&nbsp;:&nbsp;</label>
                        {{$ticket["sStartAt"]}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">終了予定日&nbsp;:&nbsp;</label>
                        {{$ticket["sFinishAt"]}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">開始日&nbsp;:&nbsp;</label>
                        {{$ticket["startAt"]}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">終了日&nbsp;:&nbsp;</label>
                        {{$ticket["finishAt"]}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">状態&nbsp;:&nbsp;</label>
                        {{config("const.status.$ticket->status")}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">公開・非公開&nbsp;:&nbsp;</label>
                        {{config("const.open.$ticket->open")}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">優先度&nbsp;:&nbsp;</label>
                        {{config("const.priority.$ticket->priority")}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">進捗率&nbsp;:&nbsp;</label>
                        {{$ticket["progress"]}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">名前&nbsp;:&nbsp;</label>
                        {{$ticket->user->name}}
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">作業時間&nbsp;:&nbsp;</label>
                        {{$ticket["work_hours"]}}
                    </div>
                </div>
            </div>
            <hr class="my-1">
            タスク概要</br>
            {{-- 改行のためこの形で表記 --}}
            {!! nl2br(htmlspecialchars($ticket["ticket_contents"])) !!}
        </div>
        <footer class="my-1 pt-1 text-muted text-center text-small">

        </footer>
    </div>
    <div class="container mt-5 mb-5">

        <div class="d-flex justify-content-center row">
            <div class="d-flex flex-column col-md-8">

                <div class="coment-bottom bg-white p-2 px-4">
                    <form class="d-flex flex-row add-comment-section mt-4 mb-4" action="{{route('comment',['id' => $ticket->id])}}" method="post">
                        @csrf
                        <div class="w-100 input-group">
                            <input type="hidden" class="form-control mr-3" placeholder="Add comment" name="pararent_id" value="">
                            <input type="text" class="form-control mr-3" placeholder="" name="comment">
                            <button class="btn btn-primary " type="submit">投稿</button>
                        </div>
                    </form>

                    <div class="commented-section mt-2">

                    </div>
                    @foreach($comments as $comment)
                    @if(!isset($comment["pararent_id"]))
                    <div class="commented-section mt-2">
                        <div class="d-flex flex-row align-items-center commented-user">
                            @if ($comment->user->image=="user_default.jpg")
                            <img class="img-fluid img-parent" src="{{asset('images/user_default.jpg')}}">
                            @else
                            <img class="img-fluid img-parent" src="{{asset('storage/images/'.($comment->user->image))}}">
                            @endif
                            <h5 class="mr-2">{{$comment->user->name}}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{$comment["updated_at"]->diffForHumans()}}</span>
                        </div>
                        <div class="comment-text-sm">
                            {{$comment["comment"]}}
                        </div>
                        <div class="reply-section">
                            <div  class="d-flex">
                            @if (!$comment->child->isEmpty())
                            <a data-toggle="collapse" href="#collapseExample{{$comment['id']}}" aria-expanded="false" aria-controls="collapseExample">
                                返信を表示
                            </a> 
                            @else
                            <span class="invisible" data-toggle="collapse"  aria-expanded="false" aria-controls="collapseExample">
                                返信を表示
                            </span>  
                            @endif
                            <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseForm{{$comment['id']}}" aria-expanded="false" aria-controls="collapseForm">
                                返信する
                            </button>
                            @if(Auth::user()->id==$comment["user_id"]||Auth::user()->role==1)
                            <form action="{{route('comment.delete',$comment)}}" class="" method="POST">
                                @csrf
                                <input type="hidden" name="ticket_id" value="{{$ticket['id']}}">
                                <button type="submit" class="btn btn-danger form-inline" >
                                    削除する
                                </button>
                            </form>
                            @endif
                            </div>
                            <div class="collapse" id="collapseForm{{$comment['id']}}">
                                <form class="d-flex flex-row add-comment-section mt-4 mb-4" action="{{route('comment',['id' => $ticket->id])}}" method="post">
                                    @csrf
                                    <div class="w-100 input-group">
                                        <input type="hidden" class="form-control mr-3" placeholder="Add comment" name="pararent_id" value="{{$comment['id']}}">
                                        <input type="text" class="form-control mr-3" placeholder="Add comment" name="comment">
                                        <button class="btn btn-primary " type="submit">投稿</button>
                                    </div>
                                </form>
                            </div>
                            <div class="collapse" id="collapseExample{{$comment['id']}}">
                                <div class="border p-3">
                                    @foreach($comments as $incomment)
                                    @if($incomment["pararent_id"]==$comment["id"])
                                        <div class="d-flex flex-row align-items-center commented-user">
                                            @if ($incomment->user->image=="user_default.jpg")
                                            <img class="img-fluid img-parent" src="{{asset('images/user_default.jpg')}}">
                                            @else
                                            <img class="img-fluid img-parent" src="{{asset('storage/images/'.($incomment->user->image))}}">
                                            @endif
                                            <h5 class="mr-2">{{$incomment->user->name}}</h5><span class="dot mb-1"></span><span class="mb-1 ml-2">{{$incomment["updated_at"]->diffForHumans()}}</span>
                                        </div>
                                        <div class="comment-text-sm">
                                            {{$incomment["comment"]}}
                                        </div>
                                        @if(Auth::user()->id==$incomment["user_id"]||Auth::user()->role==1)
                                        <form action="{{route('comment.delete',['id'=>$incomment->id])}}" class="" method="POST">
                                            @csrf
                                            {{-- 同じチケットのページに戻るために必要 --}}
                                            <input type="hidden" name="ticket_id" value="{{$ticket['id']}}">
                                            <button type="submit" class="btn btn-danger form-inline"  >
                                                削除する
                                            </button>
                                        </form>
                                        @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>