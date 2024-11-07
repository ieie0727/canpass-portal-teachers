@extends('layouts.app')

@section('content')
<div class="container">
  <h3 class="mb-3">{{ $teacher->family_name }} {{ $teacher->given_name }}さんの詳細情報</h3>

  <table class="table table-bordered">
    <tbody>
      <tr>
        <th style="width: 20%;">役割</th>
        <td>{{ $teacher->role }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">社員メール</th>
        <td>{{ $teacher->email_company }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">会社電話番号</th>
        <td>{{ $teacher->phone_company ?? '-' }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">プライベートメール</th>
        <td>{{ $teacher->email_private ?? '-' }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">プライベート電話番号</th>
        <td>{{ $teacher->phone_private ?? '-' }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">生年月日</th>
        <td>{{ $teacher->birth_date }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">勤務開始日</th>
        <td>{{ $teacher->hire_date }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">退職日</th>
        <td>{{ $teacher->retirement_date ?? '-' }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">ステータス</th>
        <td>{{ $teacher->status }}</td>
      </tr>
      <tr>
        <th style="width: 20%;">面談URL</th>
        <td>
          @if($teacher->meeting_url)
          <a href="{{ $teacher->meeting_url }}" target="_blank">こちら</a>
          @else
          未登録
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="mt-3">
    <a href="{{ route('teachers.index') }}" class="btn btn-secondary me-2">戻る</a>
    <a href="{{ route('teachers.edit', $teacher->id) }}" class="btn btn-primary">編集</a>
  </div>

</div>
@endsection