@auth
<nav class="navbar navbar-expand-md navbar-dark  bg-dark">
  <span class="navbar-brand">タスク管理</span>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarCollapse">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">ホーム</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          タスク関連
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('ticket')}}">タスク登録</a>
          <a class="dropdown-item" href="{{route('ticketList')}}">タスク一覧</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          ユーザー関連
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('userlist')}}">ユーザー一覧</a>
          @if(auth()->user())
          <a class="dropdown-item" href="{{route('useredit', ['id' => Auth::user()->id])}}">プロフィール編集</a>
          @endif
          @can('administrator')
          <a class="dropdown-item" href="{{route('usermanagement')}}">管理者用ユーザー管理</a>  
          @endcan
          @can('administrator')
          <a class="dropdown-item" href="{{route('category.index')}}">カテゴリー管理</a>  
          @endcan
        </div>
      </li>
      @if (Auth::check()) 
      <li class="nav-item">
        <a class="nav-link" href="{{url('/logout')}}">ログアウト</a>
      </li>
      
      @else
      <li class="nav-item">
        <a class="nav-link" href="{{route('login')}}">ログイン</a>
      </li>
      
      @endif
      @auth
      <li class="nav-item ">
        <span class="nav-link text-light " >
          {{Auth::user()->name}}
          @if(Auth::user()->role=="1")
          （管理者）
          @elseif (Auth::user()->role=="2")
          （スタッフ）
          @elseif (Auth::user()->role=="3")
          （一般ユーザー）
          @endif
        </span>
      </li> 
      @endauth
      
    </ul>
  </div>
</nav>
@endauth

