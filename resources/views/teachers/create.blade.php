@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">新しい教師の情報を追加</h3>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('teachers.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="family_name" class="form-label">名字</label>
      <input type="text" class="form-control @error('family_name') is-invalid @enderror" id="family_name"
        name="family_name" value="{{ old('family_name') }}" required>
      @error('family_name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="given_name" class="form-label">名前</label>
      <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name"
        name="given_name" value="{{ old('given_name') }}" required>
      @error('given_name')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="role" class="form-label">役割</label>
      <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
        <option value="teacher" {{ old('role')=='teacher' ? 'selected' : '' }}>teacher</option>
        <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>admin</option>
      </select>
      @error('role')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">ステータス</label>
      <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
        <option value="active" {{ old('status')=='active' ? 'selected' : '' }}>稼働</option>
        <option value="on_leave" {{ old('status')=='on_leave' ? 'selected' : '' }}>休職</option>
        <option value="retired" {{ old('status')=='retired' ? 'selected' : '' }}>退職</option>
      </select>
      @error('status')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email_company" class="form-label">社員メール</label>
      <input type="email" class="form-control @error('email_company') is-invalid @enderror" id="email_company"
        name="email_company" value="{{ old('email_company') }}" required>
      @error('email_company')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="phone_company" class="form-label">会社電話番号</label>
      <input type="text" class="form-control @error('phone_company') is-invalid @enderror" id="phone_company"
        name="phone_company" value="{{ old('phone_company') }}">
      @error('phone_company')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="email_private" class="form-label">プライベートメール</label>
      <input type="email" class="form-control @error('email_private') is-invalid @enderror" id="email_private"
        name="email_private" value="{{ old('email_private') }}">
      @error('email_private')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="phone_private" class="form-label">プライベート電話番号</label>
      <input type="text" class="form-control @error('phone_private') is-invalid @enderror" id="phone_private"
        name="phone_private" value="{{ old('phone_private') }}">
      @error('phone_private')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="birth_date" class="form-label">生年月日</label>
      <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
        name="birth_date" value="{{ old('birth_date') }}" required>
      @error('birth_date')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="hire_date" class="form-label">勤務開始日</label>
      <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date" name="hire_date"
        value="{{ old('hire_date') }}">
      @error('hire_date')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="retirement_date" class="form-label">退職日</label>
      <input type="date" class="form-control @error('retirement_date') is-invalid @enderror" id="retirement_date"
        name="retirement_date" value="{{ old('retirement_date') }}">
      @error('retirement_date')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="meeting_url" class="form-label">面談URL</label>
      <input type="url" class="form-control @error('meeting_url') is-invalid @enderror" id="meeting_url"
        name="meeting_url" value="{{ old('meeting_url') }}">
      @error('meeting_url')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <!-- パスワードフィールドの追加 -->
    <div class="mb-3">
      <label for="password" class="form-label">パスワード</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
        required>
      @error('password')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="mb-3">
      <label for="password_confirmation" class="form-label">パスワード確認</label>
      <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
        id="password_confirmation" name="password_confirmation" required>
      @error('password_confirmation')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="d-flex mt-4">
      <button type="submit" class="btn btn-primary me-2">追加</button>
      <a href="{{ route('teachers.index') }}" class="btn btn-secondary">キャンセル</a>
    </div>
  </form>
</div>
@endsection