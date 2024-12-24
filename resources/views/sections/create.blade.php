@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">単元の作成</h2>

  {{-- フォーム --}}
  <form action="{{ route('sections.store') }}" method="POST">
    @csrf

    {{-- 教科の選択 --}}
    <div class="form-group mb-3">
      <label for="subject">教科<span class="text-danger">*</span></label>
      <select name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
        @foreach ($subjects as $subject)
        <option value="{{ $subject }}" {{ old('subject', $currentSubject)===$subject ? 'selected' : '' }}>
          {{ $subject }}
        </option>
        @endforeach
      </select>
      @error('subject')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 単元番号の入力 --}}
    <div class="form-group mb-3">
      <label for="number">単元番号<span class="text-danger">*</span></label>
      <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
        value="{{ old('number', $sections->count() + 1) }}" required>
      @error('number')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 単元名の入力 --}}
    <div class="form-group mb-3">
      <label for="name">単元名<span class="text-danger">*</span></label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name') }}" required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 合格点の入力 --}}
    <div class="form-group mb-3">
      <label for="passing_score">合格点<span class="text-danger">*</span></label>
      <input type="number" name="passing_score" id="passing_score"
        class="form-control @error('passing_score') is-invalid @enderror" value="{{ old('passing_score', 0) }}"
        required>
      @error('passing_score')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 作成・キャンセルボタン --}}
    <div class="d-flex">
      <a href="{{ route('sections.index', ['subject' => $currentSubject]) }}" class="btn btn-secondary me-3">キャンセル</a>
      <button type="submit" class="btn btn-primary">作成</button>
    </div>
  </form>
</div>
@endsection