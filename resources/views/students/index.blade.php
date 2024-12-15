@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>生徒一覧</h2>
    {{-- 新規登録ボタン --}}
    <a href="{{ route('students.create') }}" class="btn btn-primary shadow-sm">新規登録</a>
  </div>

  {{-- 生徒がいる場合はテーブルで一覧表示 --}}
  @if($students->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm rounded">
      <thead class="table-primary">
        <tr>
          <th scope="col" class="text-center">ID</th>
          <th scope="col">名前</th>
          <th scope="col">メールアドレス</th>
          <th scope="col" class="text-center">ステータス</th>
          <th scope="col" class="text-center">学校の成績</th>
          <th scope="col" class="text-center">学習履歴</th>
          <th scope="col" class="text-center">詳細</th>
          <th scope="col" class="text-center">削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($students as $student)
        <tr>
          <td class="text-center font-weight-bold">{{ $student->id }}</td>
          <td>{{ $student->family_name }} {{ $student->given_name }}</td>
          <td>{{ $student->email }}</td>
          <td class="text-center">{{ $student->status }}</td>
          <td class="text-center">
            <a href="{{ route('schools.index', ['id' => $student->id, 'grade' => '1']) }}"
              class="btn btn-outline-info btn-sm shadow-sm">学校の成績</a>
          </td>
          <td class="text-center">
            <a href="{{ route('records.by_student', ['student_id' => $student->id, 'subject' => '英語']) }}"
              class="btn btn-outline-success btn-sm shadow-sm">学習履歴</a>
          </td>
          <td class="text-center">
            <a href="{{ route('students.show', $student->id) }}" class="btn btn-outline-primary btn-sm shadow-sm">詳細</a>
          </td>

          <td class="text-center">
            {{-- 削除ボタンをフォームで実装 --}}
            <form action="{{ route('students.destroy', $student->id) }}" method="POST"
              onsubmit="return confirm('この生徒を削除しますか？');">
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
  <p>現在、登録されている生徒はいません。</p>
  @endif
</div>
@endsection