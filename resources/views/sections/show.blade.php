@extends('layouts.app')

@section('content')
<div class="container">
  {{-- 上部: 教科名・単元名と編集・問題追加・単元削除ボタン --}}
  <div class="d-flex justify-content-between align-items-center mb-1">
    <div>
      <h2>{{ $section->subject }} - {{ $section->number }}. {{ $section->name }}</h2>
      {{-- 現在の問題数と合格点 --}}
      <p class="text-muted mb-0">問題数: {{ $questions->count() }} | 合格点: {{ $section->passing_score }}</p>
    </div>
    <div>
      {{-- 問題追加ボタン --}}
      <a href="{{ route('questions.create', ['section_id' => $section->id]) }}" class="btn btn-success me-3">問題追加</a>

      {{-- 単元編集ボタン --}}
      <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-primary me-3">単元編集</a>

      {{-- 単元削除ボタン --}}
      <form action="{{ route('sections.destroy', $section->id) }}" method="POST" style="display:inline;"
        onsubmit="return confirm('この単元を削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">単元削除</button>
      </form>
    </div>
  </div>

  {{-- 質問一覧テーブル --}}
  @if($questions->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm rounded">
      <thead class="table-light">
        <tr>
          <th scope="col" class="text-center">番号</th>
          <th scope="col">問題文</th>
          <th scope="col" class="text-center">詳細</th>
          <th scope="col" class="text-center">削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
        <tr>
          <td class="text-center align-middle">{{ $question->number }}</td>
          <td class="align-middle" style="white-space: pre-wrap;">{{ $question->question_text }}</td>
          <td class="text-center align-middle">
            <a href="{{ route('questions.show', ['section_id'=>$section->id,'question_id'=>$question->id]) }}"
              class="btn btn-outline-primary btn-sm shadow-sm">詳細</a>
          </td>
          <td class="text-center align-middle">
            {{-- 削除ボタンをフォームで実装 --}}
            <form action="{{ route('questions.destroy', ['section_id'=>$section->id,'question_id'=>$question->id]) }}"
              method="POST" onsubmit="return confirm('この問題を削除しますか？');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-outline-danger btn-sm shadow-sm">削除</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p>この単元にはまだ問題が登録されていません。</p>
  @endif

  {{-- 戻るボタン --}}
  <a href="{{ route('sections.index', ['subject' => $section->subject]) }}" class="btn btn-secondary mt-4">単元一覧に戻る</a>
</div>
@endsection