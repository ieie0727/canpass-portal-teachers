@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $section->subject }} - {{ $section->number }}. {{ $section->name }} - 問題No.{{ $question->number }} 編集</h2>
  </div>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <form action="{{ route('questions.update', ['section_id' => $section->id, 'question_id' => $question->id]) }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- 問題文 --}}
        <div class="form-group mb-3">
          <label for="question_text">問題</label>
          <textarea name="question_text" id="question_text"
            class="form-control @error('question_text') is-invalid @enderror"
            required>{{ old('question_text', $question->question_text) }}</textarea>
          @error('question_text')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- 問題画像 --}}
        <div class="form-group mb-3">
          <label for="question_image">問題画像 (任意)</label>
          @if($question->question_image)
          <div class="mb-2">
            <img src="{{ asset('storage/' . $question->question_image) }}" alt="問題画像" class="img-fluid">
            <div class="form-check mt-2">
              <input type="checkbox" name="delete_question_image" id="delete_question_image" class="form-check-input">
              <label for="delete_question_image" class="form-check-label">画像を削除する</label>
            </div>
          </div>
          @endif
          <input type="file" name="question_image" id="question_image"
            class="form-control @error('question_image') is-invalid @enderror">
          @error('question_image')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>


        {{-- 問題番号 --}}
        <div class="form-group mb-3">
          <label for="number">問題番号</label>
          <input type="number" name="number" id="number" class="form-control @error('number') is-invalid @enderror"
            value="{{ old('number', $question->number) }}" required>
          @error('number')
          <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- 選択肢 --}}
        @for ($i = 1; $i <= 4; $i++) <div class="form-group mb-3">
          <label for="choice{{ $i }}">選択肢 {{ $i }}</label>
          <input type="text" name="choice{{ $i }}" id="choice{{ $i }}"
            class="form-control @error('choice' . $i) is-invalid @enderror"
            value="{{ old('choice' . $i, $question->{'choice' . $i}) }}" required>
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
        <option value="" disabled>正解の選択肢を選択</option>
        @for ($i = 1; $i <= 4; $i++) <option value="{{ $i }}" {{ old('correct_answer', $question->correct_answer) == $i
          ? 'selected' : '' }}>選択肢 {{ $i }}</option>
          @endfor
      </select>
      @error('correct_answer')
      <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="d-flex align-items-center">
      {{-- キャンセルボタン --}}
      <a href="{{ route('questions.show', ['section_id' => $section->id, 'question_id' => $question->id]) }}"
        class="btn btn-secondary me-3">キャンセル</a>

      {{-- 更新ボタン --}}
      <button type="submit" class="btn btn-primary">更新</button>
    </div>
    </form>
  </div>
</div>
</div>
@endsection