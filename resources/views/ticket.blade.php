<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    aaaaaaaaaaaaaa
    <form name="registform" action="{{url('/ticket')}}" method="post" id="">
        {{ csrf_field() }}
        <dt>タイトル：</dt>
        <dd><input type="text" name="title" size="30" required>
        </dd>
        <dt>開始予定日：</dt>
        <dd><input type="date" name="sStartAt" required></dd>
        <dt>終了予定日：</dt>
        <dd><input type="date" name="sFinishAt" required></dd>
        <dt>開始日：</dt>
        <dd><input type="date" name="startAt"></dd>
        <dt>終了予定日：</dt>
        <dd><input type="date" name="finishAt"></dd>
        <dt>カテゴリー</dt>
        <dd><select name="category_id" id="" ">
                <option value=" 1" selected>Aカテゴリー</option>
                <option value="2">Bカテゴリー</option>
                <option value="3">cカテゴリー</option>
            </select></dd>
        <dt>公開</dt>
        <dd><select name="open" id="" ">
                <option value=" 3">公開</option>
                <option value="2">スタッフにのみ公開</option>
                <option value="1" selected>非公開</option>
            </select></dd>
        <dt>優先度</dt>
        <dd><select name="priority" id="" ">
                <option value=" 3">高</option>
                <option value="2" selected>中</option>
                <option value="1">低</option>
            </select></dd>
        <dt>状態</dt>
        <dd><select name="status" id="" ">
                <option value=" 3">完了</option>
                <option value="2">着手中</option>
                <option value="1" selected>未着手</option>
            </select></dd>
        </dl>
        <button type='submit' name='action' value='send'>送信</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form name="registform" action="{{url('/ticket')}}" method="post" id="">
        {{ csrf_field() }}
        <div class="form-group row col-8 mx-auto">
            <div class="col-sm-6">
                <label>タイトル</label>
                <input name="title" class="" value="{{ old('title') }}" required type="text">
            </div>
            <div class="col-sm-6">
                <label>カテゴリー</label>
                <select name="category_id" 　class="" id="" ">
                    <option value=" 1" selected >Aカテゴリー</option>
                    <option value="2">Bカテゴリー</option>
                    <option value="3">cカテゴリー</option>
                </select>
            </div>
        </div>
        <div class="form-group row col-8 mx-auto mt-3">
            <div class="col-sm-6">
                <label>状態</label>
                <select name="status" 　class="" id="" ">
                    <option value=" 1" selected>未着手</option>
                    <option value="2">着手中</option>
                    <option value="3">完了</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label>優先度</label>
                <select name="priority" 　class="" id="" ">
                    <option value=" 4" selected>低</option>
                    <option value="5">中</option>
                    <option value="6">高</option>
                </select>
            </div>
        </div>
        <div class="form-group row col-8 mx-auto mt-3">
            <div class="col-sm-6">
                <label>公開・非公開</label>
                <select name="open" 　class="" id="" ">
                    <option value=" 7" selected>非公開</option>
                    <option value="8">スタッフにのみ公開</option>
                    <option value="9">公開</option>
                </select>
            </div>
            <div class="col-sm-6">
                <label>進捗率</label>
                <select name="progress" id="" ">
                @for($i=0;$i<=100;$i++)
                <option value=" {{$i}}">{{$i}}％</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="form-group row col-8 mx-auto mt-3">
            <div class="col-sm-6">
                <label>開始予定日</label>
                <input type="date" name="sStartAt" required>
            </div>
            <div class="col-sm-6">
                <label>終了予定日</label>
                <input type="date" name="sFinishAt" required>
            </div>
        </div>
        <div class="form-group row col-8 mx-auto mt-3">
            <div class="col-sm-6">
                <label>開始日</label>
                <input type="date" name="startAt">
            </div>
            <div class="col-sm-6">
                <label>終了日</label>
                <input type="date" name="finishAt">
            </div>
        </div>
        <div class="form-group  col-8 mx-auto mt-3">
            <textarea name="ticket_contents" id="" cols="30" rows="10" class="w-100"></textarea>
            <div class="col-sm-6">
                <label>作業時間</label>
                <input type="text" name="work_hours" value="0.0" class="col-2">
            </div>
            <button type='submit' name='action' value='send'>送信</button>
        </div>


    </form>
</body>

</html>