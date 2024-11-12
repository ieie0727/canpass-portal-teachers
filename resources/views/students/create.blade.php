@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">新規生徒の登録</h3>

  <form action="{{ route('students.store') }}" method="POST">
    @csrf

    {{-- 名前 --}}
    <div class="form-group mb-3">
      <label for="family_name">姓</label>
      <input type="text" name="family_name" id="family_name"
        class="form-control @error('family_name') is-invalid @enderror" value="{{ old('family_name') }}" required>
      @error('family_name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="given_name">名</label>
      <input type="text" name="given_name" id="given_name"
        class="form-control @error('given_name') is-invalid @enderror" value="{{ old('given_name') }}" required>
      @error('given_name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- メールアドレス --}}
    <div class="form-group mb-3">
      <label for="email">メールアドレス</label>
      <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email') }}" required>
      @error('email')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 生年月日 --}}
    <div class="form-group mb-3">
      <label for="birth_date">生年月日</label>
      <input type="date" name="birth_date" id="birth_date"
        class="form-control @error('birth_date') is-invalid @enderror" value="{{ old('birth_date') }}" required>
      @error('birth_date')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 入塾日 --}}
    <div class="form-group mb-3">
      <label for="admission_date">入塾日</label>
      <input type="date" name="admission_date" id="admission_date"
        class="form-control @error('admission_date') is-invalid @enderror" value="{{ old('admission_date') }}" required>
      @error('admission_date')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- ステータス --}}
    <div class="form-group mb-3">
      <label for="status">ステータス</label>
      <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
        <option value="在籍" {{ old('status')=='在籍' ? 'selected' : '' }}>在籍</option>
        <option value="休塾" {{ old('status')=='休塾' ? 'selected' : '' }}>休塾</option>
        <option value="退塾" {{ old('status')=='退塾' ? 'selected' : '' }}>退塾</option>
      </select>
      @error('status')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- パスワード --}}
    <div class="form-group mb-3">
      <label for="password">パスワード</label>
      <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"
        required>
      @error('password')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group mb-3">
      <label for="password_confirmation">パスワード（確認）</label>
      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>

    <div class="d-flex">
      <a href="{{ route('students.index') }}" class="btn btn-secondary me-3">キャンセル</a>
      <button type="submit" class="btn btn-primary">登録</button>
    </div>
  </form>
</div>
@endsection