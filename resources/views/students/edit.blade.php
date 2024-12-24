@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">生徒情報の編集</h3>

  <form action="{{ route('students.update', $student->id) }}" method="POST">
    @csrf
    @method('PUT')

    <table class="table">
      <tbody>
        <!-- 氏名 -->
        <tr>
          <th scope="row" class="fs-5">氏名<span class="text-danger">*</span></th>
          <td class="d-flex">
            <div class="me-2 flex-grow-1">
              <input type="text" class="form-control @error('family_name') is-invalid @enderror" id="family_name"
                name="family_name" placeholder="名字" value="{{ old('family_name', $student->family_name) }}" required>
              @error('family_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="flex-grow-1">
              <input type="text" class="form-control @error('given_name') is-invalid @enderror" id="given_name"
                name="given_name" placeholder="名前" value="{{ old('given_name', $student->given_name) }}" required>
              @error('given_name')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
          </td>
        </tr>

        <!-- メールアドレス -->
        <tr>
          <th scope="row" class="fs-5">メールアドレス<span class="text-danger">*</span></th>
          <td>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
              value="{{ old('email', $student->email) }}" required>
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 生年月日 -->
        <tr>
          <th scope="row" class="fs-5">生年月日<span class="text-danger">*</span></th>
          <td>
            <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date"
              name="birth_date" value="{{ old('birth_date', $student->birth_date) }}" max="9999-12-31" required>
            @error('birth_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 入塾日 -->
        <tr>
          <th scope="row" class="fs-5">入塾日<span class="text-danger">*</span></th>
          <td>
            <input type="date" class="form-control @error('admission_date') is-invalid @enderror" id="admission_date"
              name="admission_date" value="{{ old('admission_date', $student->admission_date) }}" max="9999-12-31"
              required>
            @error('admission_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- 退塾日 -->
        <tr>
          <th scope="row" class="fs-5">退塾日</th>
          <td>
            <input type="date" class="form-control @error('withdrawal_date') is-invalid @enderror" id="withdrawal_date"
              name="withdrawal_date" value="{{ old('withdrawal_date', $student->withdrawal_date) }}" max="9999-12-31">
            @error('withdrawal_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>

        <!-- ステータス -->
        <tr>
          <th scope="row" class="fs-5">ステータス<span class="text-danger">*</span></th>
          <td>
            <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
              <option value="在籍" {{ old('status', $student->status) == '在籍' ? 'selected' : '' }}>在籍</option>
              <option value="休塾" {{ old('status', $student->status) == '休塾' ? 'selected' : '' }}>休塾</option>
              <option value="退塾" {{ old('status', $student->status) == '退塾' ? 'selected' : '' }}>退塾</option>
            </select>
            @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </td>
        </tr>
      </tbody>
    </table>

    <div class="d-flex mt-4">
      <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary me-3">キャンセル</a>
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
  </form>
</div>
@endsection