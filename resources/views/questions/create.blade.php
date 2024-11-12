@extends('layouts.app')

@section('content')
<div class="container">
  {{-- 上部: 質問作成タイトル --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $section->subject }} - {{ $section->number }}. {{ $section->name }}</h2>
  </div>

  {{-- 質問作成フォーム --}}
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form action="{{ route('questions.store', ['sectionId' => $section->id]) }}" method="POST"
        enctype="multipart/form-data">
        @csrf

        {{-- 問題番号 --}}
        <div class="form-group mb-3">
          <label for="number">問題番号</label>
          <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
            value="{{ old('number') }}" required>
          @error('number')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- 問題文 --}}
        <div class="form-group mb-3">
          <label for="question_text">問題</label>
          <textarea name="question_text" id="question_text"
            class="form-control @error('question_text') is-invalid @enderror"
            required>{{ old('question_text') }}</textarea>
          @error('question_text')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- 問題画像 --}}
        <div class="form-group mb-3">
          <label for="question_image">問題画像 (任意)</label>
          <input type="file" name="question_image" id="question_image"
            class="form-control @error('question_image') is-invalid @enderror">
          @error('question_image')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>



        {{-- 選択肢 --}}
        @for ($i = 1; $i <= 4; $i++) <div class="form-group mb-3">
          <label for="choice{{ $i }}">選択肢 {{ $i }}</label>
          <input type="text" name="choice{{ $i }}" id="choice{{ $i }}"
            class="form-control @error('choice' . $i) is-invalid @enderror" value="{{ old('choice' . $i) }}" required>
          @error('choice' . $i)
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
    </div>
    @endfor

    {{-- 正解 --}}
    <div class="form-group mb-3">
      <label for="correct_answer">正解</label>
      <select name="correct_answer" id="correct_answer"
        class="form-control @error('correct_answer') is-invalid @enderror" required>
        <option value="" disabled selected>正解の選択肢を選択</option>
        @for ($i = 1; $i <= 4; $i++) <option value="{{ $i }}" {{ old('correct_answer')==$i ? 'selected' : '' }}>選択肢 {{
          $i }}</option>
          @endfor
      </select>
      @error('correct_answer')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    {{-- 作成ボタン --}}
    <button type="submit" class="btn btn-primary">作成</button>
    <a href="{{ route('sections.show', ['id' => $section->id]) }}" class="btn btn-secondary">キャンセル</a>
    </form>
  </div>
</div>
</div>
@endsection