@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>{{ $sections->first()->subject ?? '教科' }}の単元一覧</h2>
    {{-- 単元作成ボタン --}}
    <a href="{{ route('sections.create',['subject' => $subject]) }}" class="btn btn-primary shadow-sm">単元作成</a>
  </div>

  {{-- 教科ごとの背景色を定義 --}}
  @php
  $headerColors = [
  '英語' => 'background-color: #ffcccc !important;', // 薄い赤
  '数学' => 'background-color: #cce5ff !important;', // 薄い青
  '国語' => 'background-color: #d4edda !important;', // 薄い緑
  '社会' => 'background-color: #e2d6f8 !important;', // 薄い紫
  '理科' => 'background-color: #ffe5b4 !important;', // 薄いオレンジ
  ];
  $subjectStyle = $headerColors[$sections->first()->subject ?? '英語'] ?? 'background-color: #f8f9fa !important;';
  @endphp

  {{-- セクションがある場合はテーブルで一覧表示 --}}
  @if($sections->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm rounded" style="border-color: #333;">
      <thead>
        <tr>
          <th scope="col" class="text-center" style="{{ $subjectStyle }}; border-color: #333;">単元番号</th>
          <th scope="col" style="{{ $subjectStyle }}; border-color: #333;">単元名</th>
          <th scope="col" class="text-center" style="{{ $subjectStyle }}; border-color: #333;">詳細</th>
        </tr>
      </thead>
      <tbody>
        @foreach($sections as $section)
        <tr>
          <td class="text-center font-weight-bold" style="border-color: #333;">{{ $section->number }}</td>
          <td style="border-color: #333;">{{ $section->name }}</td>
          <td class="text-center" style="border-color: #333;">
            <a href="{{ route('sections.show', $section->id) }}"
              class="btn btn-outline-primary btn-sm shadow-sm">詳細を見る</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p>指定された教科の単元がありません。</p>
  @endif

  {{-- 戻るボタン --}}
  <a href="{{ route('sections.home') }}" class="btn btn-secondary mt-4">教科一覧に戻る</a>
</div>
@endsection