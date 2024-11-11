@extends('layouts.app')

@section('content')
<div class="container">
  {{-- 上部: 教科名・単元名と編集ボタン --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2>{{ $section->subject }} - {{ $section->name }}</h2>
    </div>
    {{-- 編集ボタン --}}
    <a href="{{ route('sections.edit', $section->id) }}" class="btn btn-primary">編集</a>
  </div>

  {{-- 質問一覧テーブル --}}
  @if($questions->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm rounded">
      <thead class="table-light">
        <tr>
          <th scope="col" class="text-center">番号</th>
          <th scope="col">問題文</th>
          <th scope="col" class="text-center">正解番号</th>
          <th scope="col" class="text-center">詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach($questions as $question)
        <tr>
          <td class="text-center">{{ $question->number }}</td>
          <td>{{ $question->question_text }}</td>
          <td class="text-center">{{ $question->correct_answer }}</td>
          <td class="text-center">
            <a href="{{ route('questions.show', $question->id) }}"
              class="btn btn-outline-primary btn-sm shadow-sm">詳細を見る</a>
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
  <a href="{{ route('sections.index') }}" class="btn btn-secondary mt-4">単元一覧に戻る</a>
</div>
@endsection