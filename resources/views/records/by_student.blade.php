@extends('layouts.app')

@section('content')
<div class="container">
  @php
  $headerColors = [
  '英語' => 'background-color: #ffcccc !important;', // 薄い赤
  '数学' => 'background-color: #cce5ff !important;', // 薄い青
  '国語' => 'background-color: #d4edda !important;', // 薄い緑
  '社会' => 'background-color: #e2d6f8 !important;', // 薄い紫
  '理科' => 'background-color: #ffe5b4 !important;', // 薄いオレンジ
  ];
  $subjectStyle = $headerColors[$subject] ?? 'background-color: #f8f9fa !important;';
  @endphp

  <h3 class="mb-4 p-3">{{ $student->family_name }} {{ $student->given_name }}さんの学習履歴</h3>

  {{-- 科目のタブ --}}
  <nav>
    <ul class="nav nav-tabs mb-4">
      @foreach(['英語', '数学', '国語', '理科', '社会'] as $tabSubject)
      <li class="nav-item">
        <a class="nav-link {{ $subject == $tabSubject ? 'active font-weight-bold' : '' }}"
          href="{{ route('records.by_student', ['student_id' => $student->id, 'subject' => $tabSubject]) }}">
          {{ $tabSubject }}
        </a>
      </li>
      @endforeach
    </ul>
  </nav>

  {{-- 学習履歴のテーブル --}}
  @if($sections->isEmpty())
  <div class="alert alert-info">現在、この科目には単元が登録されていません。</div>
  @else
  <div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm rounded" style="border-color: #333;">
      <thead>
        <tr>
          <th scope="col" class="text-center" style="{{ $subjectStyle }}">No.</th>
          <th scope="col" style="{{ $subjectStyle }}">単元名</th>
          <th scope="col" class="text-center" style="{{ $subjectStyle }}">合格</th>
          <th scope="col" class="text-center" style="{{ $subjectStyle }}">正解数</th>
          <th scope="col" class="text-center" style="{{ $subjectStyle }}">日時</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $index => $section)
        @php
        $record = $records->get($section->id); // 該当単元の記録を取得
        @endphp
        <tr class="table-row">
          <td class="text-center">{{ $index + 1 }}</td>
          <td>{{ $section->name }}</td>
          <td class="text-center">
            <span
              class="badge {{ $record ? ($record->is_passed ? 'badge-success' : 'badge-danger') : 'badge-secondary' }}">
              {{ $record ? ($record->is_passed ? '合格' : '不合格') : 'ー' }}
            </span>
          </td>
          <td class="text-center">{{ $record ? $record->score : 'ー' }}</td>
          <td class="text-center">{{ $record ? $record->created_at->format('Y-m-d H:i') : 'ー' }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif

  {{-- 戻るボタン --}}
  <a href="{{ route('students.show', ['id' => $student->id]) }}" class="btn btn-secondary mt-4">生徒情報に戻る</a>
</div>

<!-- CSS -->
<style>
  /* テーブルの行に軽い陰影とホバーエフェクトを追加 */
  .table-hover tbody tr:hover {
    background-color: #f1f4f9;
    transition: background-color 0.2s ease;
  }


  /* バッジスタイル */
  .badge-success {
    background-color: #28a745;
  }

  .badge-danger {
    background-color: #dc3545;
  }

  .badge-secondary {
    background-color: #6c757d;
  }

  < !-- CSS --><style>

  /* タブの基本スタイル */
  .nav-tabs .nav-link {
    color: #555;
    font-weight: bold;
    border: none;
    padding: 10px 15px;
    transition: color 0.3s ease, background-color 0.3s ease;
  }

  /* タブのホバー効果 */
  .nav-tabs .nav-link:hover {
    background-color: rgba(0, 123, 255, 0.05);
    border-radius: 4px;
  }

  /* アクティブタブの色付け（教科ごとに色を変える） */
  .nav-tabs .nav-link.active {
    font-weight: bold;
    border-radius: 4px;
  }
</style>

</style>
@endsection