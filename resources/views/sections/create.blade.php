@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">単元の作成</h2>

  {{-- フォーム --}}
  <form action="{{ route('sections.store') }}" method="POST">
    @csrf

    {{-- 教科の選択 --}}
    <div class="form-group mb-3">
      <label for="subject">教科</label>
      <select name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" required>
        @foreach ($subjects as $subject)
        @if ($subject===$currentSubject)
        <option value="{{ $subject }}" selected>{{ $subject }}</option>
        @else
        <option value="{{ $subject }}">{{ $subject }}</option>
        @endif
        @endforeach
      </select>
      @error('subject')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 単元番号の入力 --}}
    <div class="form-group mb-3">
      <label for="number">単元番号</label>
      <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
        required>
      @error('number')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 単元名の入力 --}}
    <div class="form-group mb-3">
      <label for="name">単元名</label>
      <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
      @error('name')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 作成ボタン --}}
    <button type="submit" class="btn btn-primary">作成</button>
    <a href="{{ route('sections.index') }}" class="btn btn-secondary">キャンセル</a>
  </form>
</div>
@endsection