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
    <div class="row">

        <div class="col-md-10 order-md-1 mx-auto">
            <h4 class="mb-3">タスク登録</h4>
            <form class="" action="{{route('Postticket')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="firstName">タイトル(必須)</label>
                        <input type="text" class="form-control" id="firstName" placeholder="" value="{{ old('title') }}" name="title" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lastName">カテゴリ</label>
                        <select class="custom-select d-block w-100" id="category_id" name="category_id" required>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}" @if(old('category_id')==$category->id) selected  @endif>{{$category->category}}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>状態</label>
                        <select class="custom-select d-block w-100" id="status" name="status" required>
                            <option value="4" selected @if(old('status')=="4") selected  @endif>未着手</option>
                            <option value="5" @if(old('status')=="5") selected  @endif>着手中</option>
                            <option value="6" @if(old('status')=="6") selected  @endif>完了</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>優先度</label>
                        <select class="custom-select d-block w-100" id="status" name="priority" required>
                            <option value="7" selected @if(old('priority')=="7") selected  @endif>低</option>
                            <option value="8" @if(old('priority')=="8") selected  @endif>中</option>
                            <option value="9" @if(old('priority')=="9") selected  @endif>高</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>公開・非公開</label>
                        <select class="custom-select d-block w-100" id="status" name="open" required>
                            <option value="1" selected @if(old('open')=="1") selected  @endif>公開</option>
                            <option value="2" @if(old('open')=="2") selected  @endif>スタッフにのみ公開</option>
                            <option value="3" @if(old('open')=="3") selected  @endif>非公開</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>進捗率</label>
                        <select id="" class="custom-select d-block w-100" name="progress">
                            @for($i=0;$i<=100;$i++) 
                            <option value="{{$i}}" @if(old('progress')==$i) selected  @endif>
                                {{$i}}％
                            </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sStartAt">開始予定日(必須)</label>
                        <input type="date" class="form-control" id="sStartAt" value="{{ old('sStartAt') }}" name="sStartAt" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="startAt">開始日</label>
                        <input type="date" class="form-control" id="startAt" value="{{ old('startAt') }}" name="startAt">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sFtartAt">終了予定日(必須)</label>
                        <input type="date" class="form-control" id="sFinishAt" value="{{ old('sFinishAt') }}" name="sFinishAt" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="startAt">終了日</label>
                        <input type="date" class="form-control" id="finishAt" value="{{ old('finishAt') }}" name="finishAt">
                    </div>
                </div>
                <div class="mb-3">
                    <label>タスク説明</label>
                    <textarea name="ticket_contents" id="" cols="30" rows="10" class="w-100">{{ old('ticket_contents') }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="work_hours">作業時間</label>
                    <div class="row">
                        <input type="text" class="form-control w-25" id="work_hours" value="{{  old("work_hours") != "" ? old("work_hours") : "0" }}" name="work_hours" required>
                        <span class="mt-2">時間</span>
                    </div>
                </div>

                <button class="btn btn-primary btn-lg btn-block" type="submit">タスク登録</button>
            </form>
        </div>
    </div>

    <footer class="my-5 pt-5 text-muted text-center text-small">


    </footer>
</div>
</body>