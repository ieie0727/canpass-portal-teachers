@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $section->subject }} - {{ $section->number }}. {{ $section->name }} - 問題No.{{ $question->number }}</h2>
  </div>

  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="card-title">問題</h5>
      <p class="card-text">{{ $question->question_text }}</p>

      @if($question->question_image)
      <div class="mb-3">
        <img src="{{ asset('storage/' . $question->question_image) }}" alt="質問画像" class="img-fluid">
      </div>
      @else
      <p>画像がありません。</p>
      @endif

      <h5 class="card-title mt-4">選択肢</h5>
      <ul class="list-group">
        <li class="list-group-item">1. {{ $question->choice1 }}</li>
        <li class="list-group-item">2. {{ $question->choice2 }}</li>
        <li class="list-group-item">3. {{ $question->choice3 }}</li>
        <li class="list-group-item">4. {{ $question->choice4 }}</li>
      </ul>

      <h5 class="card-title mt-4">正解</h5>
      <p class="card-text">
        {{ $question->correct_answer }}.
        {{ $question->{'choice' . $question->correct_answer} }}
      </p>
    </div>
  </div>

  <div class="d-flex justify-content-between">
    {{-- 問題一覧に戻るボタン --}}
    <a href="{{ route('questions.index', ['sectionId' => $section->id]) }}" class="btn btn-secondary">問題一覧に戻る</a>

    <div>
      {{-- 編集ボタン --}}
      <a href="{{ route('questions.edit', ['sectionId' => $section->id, 'id' => $question->id]) }}"
        class="btn btn-primary me-2">編集</a>

      {{-- 削除ボタン --}}
      <form action="{{ route('questions.destroy', ['sectionId' => $section->id, 'id' => $question->id]) }}"
        method="POST" style="display:inline;" onsubmit="return confirm('この質問を削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">削除</button>
      </form>
    </div>
  </div>
</div>
@endsection