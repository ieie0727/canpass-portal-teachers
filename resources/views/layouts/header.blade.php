<nav class="navbar navbar-expand-lg" style="background-color: #007bff;">
  <div class="container">
    <!-- 左側：アプリのタイトル -->
    <a class="navbar-brand text-white" href="{{ url('/') }}">
      {{ config('app.name', 'Canpass Portal') }}
    </a>

    <!-- トグルボタン（レスポンシブ対応） -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- 右側：リンクとユーザー情報 -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto">
        <!-- 各リンク -->
        @can('isAdmin')
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('teachers.index') }}">講師情報</a>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('students.index') }}">生徒情報</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('sections.home') }}">テスト管理</a>
        </li>

        <!-- ユーザー情報 -->
        @auth
        @php
        $teacher = auth()->user();
        @endphp
        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ $teacher->family_name }} {{ $teacher->given_name }}さん
          </a>

          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('users.show') }}">マイプロフィール</a>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
              ログアウト
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
            </form>
          </div>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link text-white" href="{{ route('login') }}">ログイン</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>