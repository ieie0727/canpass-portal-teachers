<!-- resources/views/auth/register.blade.php -->
@extends('layouts.auth')

@section('content')
<div class="col-md-6 col-lg-4 mx-auto my-5">
    <div class="card shadow-sm">
        <div class="card-header text-center">
            <h3>{{ __('新規登録') }}</h3>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Family Name -->
                <div class="form-group mb-3">
                    <label for="family_name" class="form-label">{{ __('名字') }}</label>
                    <input type="text" id="family_name" class="form-control @error('family_name') is-invalid @enderror"
                        name="family_name" value="{{ old('family_name') }}" required autofocus>
                    @error('family_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Given Name -->
                <div class="form-group mb-3">
                    <label for="given_name" class="form-label">{{ __('名前') }}</label>
                    <input type="text" id="given_name" class="form-control @error('given_name') is-invalid @enderror"
                        name="given_name" value="{{ old('given_name') }}" required>
                    @error('given_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email_company" class="form-label">{{ __('メールアドレス（会社用）') }}</label>
                    <input type="email" id="email_company"
                        class="form-control @error('email_company') is-invalid @enderror" name="email_company"
                        value="{{ old('email_company') }}" required>
                    @error('email_company')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Birth Date -->
                <div class="form-group mb-3">
                    <label for="birth_date" class="form-label">{{ __('生年月日') }}</label>
                    <input type="date" id="birth_date" class="form-control @error('birth_date') is-invalid @enderror"
                        name="birth_date" value="{{ old('birth_date') }}" required>
                    @error('birth_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Hire Date -->
                <div class="form-group mb-3">
                    <label for="hire_date" class="form-label">{{ __('勤務開始日') }}</label>
                    <input type="date" id="hire_date" class="form-control @error('hire_date') is-invalid @enderror"
                        name="hire_date" value="{{ old('hire_date', now()->format('Y-m-d')) }}" required>
                    @error('hire_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group mb-3">
                    <label for="password" class="form-label">{{ __('パスワード') }}</label>
                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group mb-4">
                    <label for="password-confirm" class="form-label">{{ __('パスワード（確認用）') }}</label>
                    <input type="password" id="password-confirm" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>

                <!-- Register Button -->
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        {{ __('登録') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection