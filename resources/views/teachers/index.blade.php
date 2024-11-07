@extends('layouts.app')

@section('content')
<div class="container">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3>講師一覧</h3>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary">新規登録</a>
  </div>

  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  @if($teachers->isEmpty())
  <p>現在、登録されている講師はいません。</p>
  @else
  <table class="table table-bordered">
    <thead class="table-primary">
      <tr>
        <th>名前</th>
        <th>役割</th>
        <th>社員メール</th>
        <th>ステータス</th>
      </tr>
    </thead>
    <tbody>
      @foreach($teachers as $teacher)
      <tr class="clickable-row hover-effect" data-href="{{ route('teachers.show', $teacher->id) }}"
        style="cursor: pointer;">
        <td>{{ $teacher->family_name }} {{ $teacher->given_name }}</td>
        <td>{{ $teacher->role }}</td>
        <td>{{ $teacher->email_company }}</td>
        <td>{{ $teacher->status }}</td>
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
    /* 影を軽くする */
    transform: scale(1.01);
    /* 拡大率を少し控えめに */
    transition: box-shadow 0.2s ease, transform 0.2s ease;
  }
</style>

@endsection