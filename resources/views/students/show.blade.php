@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex align-items-center justify-content-between mb-3">
    <h3 class="mb-0">{{ $student->family_name }} {{ $student->given_name }}さんの詳細情報</h3>
    <div>
      <a href="{{ route('students.school', ['student_id' => $student->id, 'grade'=>1]) }}"
        class="btn btn-info me-3">学校の成績</a>
      <a href="{{ route('students.record_subject', ['student_id' => $student->id, 'subject' => '英語']) }}"
        class="btn btn-success">学習履歴</a>
    </div>
  </div>

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
    <!-- 左サイドのボタン -->
    <div>
      <a href="{{ route('students.index') }}" class="btn btn-secondary me-3">生徒一覧に戻る</a>
      <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary me-3">編集する</a>
    </div>

    <!-- 右サイドのボタン -->
    <div>
      <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline"
        onsubmit="return confirm('この生徒を削除しますか？');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">削除</button>
      </form>
    </div>
  </div>
</div>
@endsection

<style>
  /* btn-infoボタンの色を変更し、範囲を限定 */
  .container .btn-info {
    color: #fff !important;
  }
</style>