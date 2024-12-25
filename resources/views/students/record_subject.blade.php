@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $student->family_name }} {{ $student->given_name }}さんの学習履歴 ({{ $subject }})</h2>

  {{-- 教科ごとの背景色を定義 --}}
  @php
  $headerColors = [
  '英語' => 'background-color: #ffcccc;', // 薄い赤
  '数学' => 'background-color: #cce5ff;', // 薄い青
  '国語' => 'background-color: #d4edda;', // 薄い緑
  '社会' => 'background-color: #e2d6f8;', // 薄い紫
  '理科' => 'background-color: #ffe5b4;', // 薄いオレンジ
  ];
  $subjectStyle = $headerColors[$subject] ?? 'background-color: #f8f9fa;'; // デフォルト色
  @endphp

  {{-- 科目のタブ --}}
  <nav>
    <ul class="nav nav-tabs mb-4">
      @foreach(['英語', '数学', '国語', '理科', '社会'] as $tabSubject)
      <li class="nav-item">
        <a class="nav-link {{ $subject == $tabSubject ? 'active' : '' }}"
          href="{{ route('students.record_subject', ['student_id' => $student->id, 'subject' => $tabSubject]) }}">
          {{ $tabSubject }}
        </a>
      </li>
      @endforeach
    </ul>
  </nav>

  {{-- 学習履歴のテーブル --}}
  @if($sections->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-bordered custom-table">
      <thead class="custom-header" style="{{ $subjectStyle }}">
        <tr>
          <th class="text-center">番号</th>
          <th>単元名</th>
          <th class="text-center">問題数</th>
          <th class="text-center">合格点</th>
          <th class="text-center">正解数</th>
          <th class="text-center">結果</th>
          <th class="text-center">詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $section)
        @php
        $record = $records->firstWhere('section_id', $section->id);
        $correctIds = $record ? explode(',', $record->corrects) : [];
        $correctCount = count($correctIds);
        $questionCount = $section->questions->count();
        @endphp

        <tr class="custom-row">
          <td>{{ $section->number }}</td>
          <td>{{ $section->name }}</td>
          <td>{{ $questionCount }}</td>
          <td>{{ $section->passing_score }}</td>
          <td>{{ $correctCount }}</td>
          <td>
            @if($record)
            @if($record->is_passed)
            <span class="badge bg-success">合格</span>
            @else
            <span class="badge bg-danger">不合格</span>
            @endif
            @else
            <span class="badge bg-secondary">未受験</span>
            @endif
          </td>
          <td>
            @if($record)
            <a href="{{ route('students.record_detail', ['student_id' => $student->id, 'section_id' => $section->id]) }}"
              class="btn btn-outline-primary btn-sm">
              詳細
            </a>
            @else
            ー
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center text-muted">この教科には単元がありません。</p>
  @endif

  {{-- 戻るボタン --}}
  <div class="text-center mt-4">
    <a href="{{ route('students.show', $student->id) }}" class="btn btn-secondary">生徒情報に戻る</a>
  </div>
</div>
@endsection

<style>
  /* テーブル全体の罫線を濃くする */
  .custom-table,
  .custom-table th,
  .custom-table td {
    border: 1px solid #333 !important;
    text-align: center !important;
    vertical-align: middle !important;
  }

  /* ヘッダーのスタイル */
  .custom-header {
    color: #000;
    font-weight: bold;
  }

  /* 通常の行の文字色を黒に設定 */
  .custom-row {
    background-color: #fff;
    color: #000 !important;
  }

  /* バッジのスタイル */
  .badge {
    font-size: 1rem;
    padding: 0.5em 0.75em;
    border-radius: 0.5rem;
  }

  .bg-success {
    background-color: #28a745 !important;
    color: #fff !important;
  }

  .bg-danger {
    background-color: #dc3545 !important;
    color: #fff !important;
  }

  .bg-secondary {
    background-color: #6c757d !important;
    color: #fff !important;
  }
</style>