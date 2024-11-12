@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>講師一覧</h2>
    {{-- 新規登録ボタン --}}
    <a href="{{ route('teachers.create') }}" class="btn btn-primary shadow-sm">新規登録</a>
  </div>

  {{-- 講師情報がある場合はテーブルで一覧表示 --}}
  @if($teachers->isNotEmpty())
  <div class="table-responsive">
    <table class="table table-hover table-bordered shadow-sm rounded" style="border-color: #333;">
      <thead class="table-primary">
        <tr>
          <th scope="col" class="text-center">名前</th>
          <th scope="col" class="text-center">役割</th>
          <th scope="col" class="text-center">社員メール</th>
          <th scope="col" class="text-center">ステータス</th>
          <th scope="col" class="text-center">詳細</th>
          <th scope="col" class="text-center">削除</th>
        </tr>
      </thead>
      <tbody>
        @foreach($teachers as $teacher)
        <tr>
          <td class="text-center font-weight-bold">{{ $teacher->family_name }} {{ $teacher->given_name }}</td>
          <td class="text-center">{{ $teacher->role }}</td>
          <td class="text-center">{{ $teacher->email_company }}</td>
          <td class="text-center">{{ $teacher->status }}</td>
          <td class="text-center">
            <a href="{{ route('teachers.show', $teacher->id) }}" class="btn btn-outline-primary btn-sm shadow-sm">詳細</a>
          </td>
          <td class="text-center">
            {{-- 削除ボタンをフォームで実装 --}}
            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
              onsubmit="return confirm('この講師を削除しますか？');">
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
  <p>現在、登録されている講師はいません。</p>
  @endif
</div>
@endsection