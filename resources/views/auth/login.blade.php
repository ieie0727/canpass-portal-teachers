<!-- resources/views/auth/login.blade.php -->
@extends('layouts.auth')

@section('content')
<div class="col-md-6 col-lg-4">
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h3>{{ __('ログイン') }}</h3>
        </div>
        <div class="card-body">
            <!-- LaravelのログインルートにPOSTメソッドで送信 -->
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- CSRFトークンの追加 -->

                <!-- メールアドレスフィールド -->
                <div class="form-group mb-3">
                    <label for="email_company" class="form-label">{{ __('メールアドレス（会社用）') }}</label>
                    <input type="email" id="email_company"
                        class="form-control @error('email_company') is-invalid @enderror" name="email_company"
                        value="{{ old('email_company') }}" required autocomplete="email_company" autofocus>
                    @error('email_company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- パスワードフィールド -->
                <div class="form-group mb-3">
                    <label for="password" class="form-label">{{ __('パスワード') }}</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- ログイン状態を維持するチェックボックス -->
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')
                        ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('ログインしたままにする') }}
                    </label>
                </div>

                <!-- ログインボタンとリンク -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('ログイン') }}
                    </button>
                    @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('パスワードをお忘れですか？') }}
                    </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection