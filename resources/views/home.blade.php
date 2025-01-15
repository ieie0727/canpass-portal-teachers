@extends('layouts.app')

@section('content')
<div class="container">

    {{-- (c) メイン操作メニュー --}}
    <div class="card mb-4">
        <div class="card-header">メニュー</div>
        <div class="card-body">
            <div class="row">
                {{-- 講師情報 --}}
                @can('isAdmin')
                <div class="col-md-6 mb-4">
                    <div class="card text-center shadow-sm card-hover border-primary">
                        <div class="card-body">
                            <h5 class="card-title">講師情報</h5>
                            <p class="card-text">講師情報の閲覧・管理を行います。</p>
                            <a href="{{ route('teachers.index') }}" class="btn btn-outline-primary">講師情報へ</a>
                        </div>
                    </div>
                </div>
                @endcan

                {{-- 生徒情報 --}}
                <div class="col-md-6 mb-4">
                    <div class="card text-center shadow-sm card-hover border-primary">
                        <div class="card-body">
                            <h5 class="card-title">生徒情報</h5>
                            <p class="card-text">生徒情報の閲覧・管理を行います。</p>
                            <a href="{{ route('students.index') }}" class="btn btn-outline-primary">生徒情報へ</a>
                        </div>
                    </div>
                </div>

                {{-- 学習管理 --}}
                <div class="col-md-6 mb-4">
                    <div class="card text-center shadow-sm card-hover border-primary">
                        <div class="card-body">
                            <h5 class="card-title">テスト管理</h5>
                            <p class="card-text">教科ごとの小テスト作成・管理を行います。</p>
                            <a href="{{ route('sections.home') }}" class="btn btn-outline-primary">学習管理へ</a>
                        </div>
                    </div>
                </div>

                {{--
                <div class="col-md-6 mb-4">
                    <div class="card text-center shadow-sm card-hover border-primary">
                        <div class="card-body">
                            <h5 class="card-title">面談管理</h5>
                            <p class="card-text">面談情報を確認します。</p>
                            <a href="#" class="btn btn-outline-primary">面談情報へ</a>
                        </div>
                    </div>
                </div>
                --}}
            </div>
        </div>
    </div>
</div>
@endsection