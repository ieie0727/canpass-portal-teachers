@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">{{ $student->family_name }} {{ $student->given_name }}さんの詳細情報</h3>

  <table class="table table-bordered">
    <tbody>
      <tr>
        <th style="width: 20%;">メールアドレス</th>
        <td>{{ $student->email }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">生年月日</th>
        <td>{{ $student->birth_date }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">入塾日</th>
        <td>{{ $student->admission_date }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">ステータス</th>
        <td>{{ $student->status }}</td>
      </tr>
    </tbody>
  </table>

  <div class="d-flex justify-content-between mt-3">
    <div>
      <a href="{{ route('students.index') }}" class="btn btn-secondary me-3">戻る</a>
      <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary me-3">編集</a>
      <a href="{{ route('records.by_student', ['student_id' => $student->id, 'subject' => '英語']) }}"
        class="btn btn-success">学習履歴</a>
    </div>
    <form action="{{ route('students.destroy', $student->id) }}" method="POST"
      onsubmit="return confirm('この生徒を削除しますか？');">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger">削除</button>
    </form>
  </div>
</div>
@endsection