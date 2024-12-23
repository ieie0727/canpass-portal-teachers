@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">{{ $teacher->family_name }} {{ $teacher->given_name }} さんの情報を編集</h3>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
    @csrf
    @method('PUT')

    <table class="table">
      <tbody>
        <!-- 名前 -->
        <tr>
          <th scope="row" class="fs-5">氏名</th>
          <td class="d-flex">
            <div class="me-2 flex-grow-1">
              <input type="text" class="form-control @error('family_name') is-invalid @enderror" id="family_name"
                name="family_name" placeholder="名字" value="{{ old('family_name', $teacher->family_name) }}" required>
              @error('family_name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="flex-grow-1">
              <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name"
                name="given_name" placeholder="名前" value="{{ old('given_name', $teacher->given_name) }}" required>
              @error('given_name')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
          </td>
        </tr>

        <!-- 役割 -->
        <tr>
          <th scope="row" class="fs-5">役割</th>
          <td>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
              <option value="teacher" {{ old('role', $teacher->role) == 'teacher' ? 'selected' : '' }}>teacher</option>
              <option value="admin" {{ old('role', $teacher->role) == 'admin' ? 'selected' : '' }}>admin</option>
            </select>
            @error('role')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>

        <!-- ステータス -->
        <tr>
          <th scope="row" class="fs-5">ステータス</th>
          <td>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
              <option value="稼働" {{ old('status', $teacher->status) == '稼働' ? 'selected' : '' }}>稼働</option>
              <option value="休職" {{ old('status', $teacher->status) == '休職' ? 'selected' : '' }}>休職</option>
              <option value="退職" {{ old('status', $teacher->status) == '退職' ? 'selected' : '' }}>退職</option>
            </select>
            @error('status')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>

        <!-- 社員メール -->
        <tr>
          <th scope="row" class="fs-5">社員メール</th>
          <td>
            <input type="email" class="form-control @error('email_company') is-invalid @enderror" id="email_company"
              name="email_company" value="{{ old('email_company', $teacher->email_company) }}" required>
            @error('email_company')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>

        <!-- プライベートメール -->
        <tr>
          <th scope="row" class="fs-5">プライベートメール</th>
          <td>
            <input type="email" class="form-control @error('email_private') is-invalid @enderror" id="email_private"
              name="email_private" value="{{ old('email_private', $teacher->email_private) }}">
            @error('email_private')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>

        <!-- 生年月日 -->
        <tr>
          <th scope="row" class="fs-5">生年月日</th>
          <td>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
              name="birth_date" value="{{ old('birth_date', $teacher->birth_date) }}" max="9999-12-31" required>
            @error('birth_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>

        <!-- 雇い入れ開始日 -->
        <tr>
          <th scope="row" class="fs-5">雇い入れ開始日</th>
          <td>
            <input type="date" class="form-control @error('hire_date') is-invalid @enderror" id="hire_date"
              name="hire_date" value="{{ old('hire_date', $teacher->hire_date) }}" max="9999-12-31">
            @error('hire_date')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>

        <!-- 面談URL -->
        <tr>
          <th scope="row" class="fs-5">面談URL</th>
          <td>
            <input type="url" class="form-control @error('meeting_url') is-invalid @enderror" id="meeting_url"
              name="meeting_url" value="{{ old('meeting_url', $teacher->meeting_url) }}">
            @error('meeting_url')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
          </td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex mt-4">
      <a href="{{ route('teachers.index') }}" class="btn btn-secondary me-3">キャンセル</a>
      <button type="submit" class="btn btn-primary">保存する</button>
    </div>
  </form>
</div>
@endsection