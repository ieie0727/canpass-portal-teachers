@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="mb-4">{{ $section->name }}の記録</h2>

  <div class="mb-4">
    <h5>受験回数： {{ $record->attempt_number ?? '未受験' }}</h5>
    <h5>スコア： {{ $record->score ?? 'ー' }}</h5>
    <h5>
      結果：
      @if($record && $record->is_passed)
      <span class="badge bg-success">合格</span>
      @elseif($record)
      <span class="badge bg-danger">不合格</span>
      @else
      <span class="badge bg-secondary">未受験</span>
      @endif
    </h5>
  </div>

  @if($questions->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-bordered custom-table">
      <thead>
        <tr>
          <th class="text-center">番号</th>
          <th>問題文</th>
          <th class="text-center">正解</th>
          <th class="text-center">結果</th>
        </tr>
      </thead>
      <tbody>
        @php
        $correctIds = $record ? explode(',', $record->corrects) : [];
        $incorrectIds = $record ? explode(',', $record->incorrects) : [];
        @endphp
        @foreach($questions as $question)
        <tr>
          <td class="text-center">{{ $question->number }}</td>
          <td>{{ $question->question_text }}</td>
          <td class="text-center">{{ $question->{'choice' . $question->correct_answer} }}</td>
          <td class="text-center">
            @if(in_array($question->id, $correctIds))
            <span class="badge bg-success">正解</span>
            @elseif(in_array($question->id, $incorrectIds))
            <span class="badge bg-danger">不正解</span>
            @else
            <span class="badge bg-secondary">未解答</span>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @else
  <p class="text-center text-muted">この単元には質問がありません。</p>
  @endif

  {{-- 戻るボタン --}}
  <div class="text-center mt-4">
    <a href="{{ route('students.record_subject', ['student_id' => $student->id, 'subject' => $section->subject]) }}"
      class="btn btn-secondary">戻る</a>
  </div>
</div>
@endsection

<style>
  .custom-table,
  .custom-table th,
  .custom-table td {
    border: 1px solid #333 !important;
    text-align: center !important;
    vertical-align: middle !important;
  }

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