@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">単元の編集</h2>

  {{-- フォーム --}}
  <form action="{{ route('sections.update', $section->id) }}" method="POST">
    @csrf
    @method('PUT')

    {{-- 教科の選択 --}}
    <div class="form-group mb-3">
      <label for="subject">教科</label>
      <select name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
        @foreach ($subjects as $subject)
        <option value="{{ $subject }}" {{ $subject===$section->subject ? 'selected' : '' }}>{{ $subject }}</option>
        @endforeach
      </select>
      @error('subject')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 単元番号の入力 --}}
    <div class="form-group mb-3">
      <label for="number">単元番号</label>
      <input type="number" name="number" id="number" value="{{ old('number', $section->number) }}"
        class="form-control @error('number') is-invalid @enderror" required>
      @error('number')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 単元名の入力 --}}
    <div class="form-group mb-3">
      <label for="name">単元名</label>
      <input type="text" name="name" id="name" value="{{ old('name', $section->name) }}"
        class="form-control @error('name') is-invalid @enderror" required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 更新ボタン --}}
    <button type="submit" class="btn btn-primary">更新</button>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary">キャンセル</a>
  </form>
</div>
@endsection