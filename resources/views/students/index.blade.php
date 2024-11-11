@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>生徒一覧</h3>
    <a href="{{ route('students.create') }}" class="btn btn-primary">新規登録</a>
  </div>

  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  @if($students->isEmpty())
  <p>現在、登録されている生徒はいません。</p>
  @else
  <table class="table table-bordered">
    <thead class="table-primary">
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>メールアドレス</th>
        <th>ステータス</th>
      </tr>
    </thead>
    <tbody>
      @foreach($students as $student)
      <tr class="clickable-row hover-effect" data-href="{{ route('students.show', $student->id) }}"
        style="cursor: pointer;">
        <td>{{ $student->id }}</td>
        <td>{{ $student->family_name }} {{ $student->given_name }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->status }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  @endif
</div>

<!-- 行をクリックして詳細ページに移動するためのスクリプト -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
      var rows = document.querySelectorAll('.clickable-row');
      rows.forEach(function(row) {
          row.addEventListener('click', function() {
              window.location.href = row.dataset.href;
          });
      });
  });
</script>

<!-- CSS -->
<style>
  .hover-effect:hover {
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.15);
    transform: scale(1.01);
    transition: box-shadow 0.2s ease, transform 0.2s ease;
  }
</style>

@endsection