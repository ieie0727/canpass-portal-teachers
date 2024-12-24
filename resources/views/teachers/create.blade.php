@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">新規作成</h3>

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

    <table class="table">
      <tbody>
        <!-- 氏名 -->
        <tr>
          <th scope="row" class="fs-5">氏名<span class="text-danger">*</span></th>
          <td class="d-flex">
            <div class="me-2 flex-grow-1">
              <input type="text" class="form-control @error('family_name') is-invalid @enderror" id="family_name"
                name="family_name" placeholder="名字" value="{{ old('family_name') }}" required>
              @error('family_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="flex-grow-1">
              <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name"
                name="given_name" placeholder="名前" value="{{ old('given_name') }}" required>
              @error('given_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </td>
        </tr>

        <!-- 役割 -->
        <tr>
          <th scope="row" class="fs-5">役割<span class="text-danger">*</span></th>
          <td>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
              <option value="teacher" {{ old('role')=='teacher' ? 'selected' : '' }}>teacher</option>
              <option value="admin" {{ old('role')=='admin' ? 'selected' : '' }}>admin</option>
            </select>
            @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- ステータス -->
        <tr>
          <th scope="row" class="fs-5">ステータス<span class="text-danger">*</span></th>
          <td>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
              <option value="稼働" {{ old('status')=='稼働' ? 'selected' : '' }}>稼働</option>
              <option value="休職" {{ old('status')=='休職' ? 'selected' : '' }}>休職</option>
              <option value="退職" {{ old('status')=='退職' ? 'selected' : '' }}>退職</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 社員メール -->
        <tr>
          <th scope="row" class="fs-5">社員メール<span class="text-danger">*</span></th>
          <td>
            <input type="email" class="form-control @error('email_company') is-invalid @enderror" id="email_company"
              name="email_company" value="{{ old('email_company') }}" required>
            @error('email_company')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 社員電話番号 -->
        <tr>
          <th scope="row" class="fs-5">社員電話番号</th>
          <td>
            <input type="text" class="form-control @error('phone_company') is-invalid @enderror" id="phone_company"
              name="phone_company" value="{{ old('phone_company') }}">
            @error('phone_company')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- プライベートメール -->
        <tr>
          <th scope="row" class="fs-5">プライベートメール</th>
          <td>
            <input type="email" class="form-control @error('email_private') is-invalid @enderror" id="email_private"
              name="email_private" value="{{ old('email_private') }}">
            @error('email_private')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- プライベート電話番号 -->
        <tr>
          <th scope="row" class="fs-5">プライベート電話番号</th>
          <td>
            <input type="text" class="form-control @error('phone_private') is-invalid @enderror" id="phone_private"
              name="phone_private" value="{{ old('phone_private') }}">
            @error('phone_private')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 生年月日 -->
        <tr>
          <th scope="row" class="fs-5">生年月日<span class="text-danger">*</span></th>
          <td>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
              name="birth_date" value="{{ old('birth_date') }}" max="9999-12-31" required>
            @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 雇用開始日 -->
        <tr>
          <th scope="row" class="fs-5">雇用開始日<span class="text-danger">*</span></th>
          <td>
            <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date"
              name="hire_date" value="{{ old('hire_date', date('Y-m-d')) }}" max="9999-12-31" required>
            @error('hire_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>


        <!-- 雇用終了日 -->
        <tr>
          <th scope="row" class="fs-5">雇用終了日</th>
          <td>
            <input type="date" class="form-control @error('retirement_date') is-invalid @enderror" id="retirement_date"
              name="retirement_date" value="{{ old('retirement_date') }}" max="9999-12-31">
            @error('retirement_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 面談URL -->
        <tr>
          <th scope="row" class="fs-5">面談URL</th>
          <td>
            <input type="url" class="form-control @error('meeting_url') is-invalid @enderror" id="meeting_url"
              name="meeting_url" value="{{ old('meeting_url') }}">
            @error('meeting_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- パスワード -->
        <tr>
          <th scope="row" class="fs-5">パスワード<span class="text-danger">*</span></th>
          <td>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
              name="password" required>
            @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- パスワード確認 -->
        <tr>
          <th scope="row" class="fs-5">パスワード確認<span class="text-danger">*</span></th>
          <td>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
              id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex mt-4">
      <a href="{{ route('teachers.index') }}" class="btn btn-secondary me-3">キャンセル</a>
      <button type="submit" class="btn btn-primary">作成する</button>
    </div>
  </form>
</div>
@endsection