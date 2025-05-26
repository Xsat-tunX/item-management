@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="main">
        <div class="main_header">
            <div class="header_card">
                <div class="header_area">
                    <h3>ユーザー</h3>
                    <p>ユーザーを追加、管理をします</p>
                </div>

                <div class="middle_area">
                    <h3>ユーザー数</h3>
                    <div class="card_subtitle">1</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box"> 
                        <a>一覧表示</a>
                    </div>
                    <div class="bottom_box"> 
                        <a>ユーザーの追加</a>
                    </div>
                    <div class="bottom_box"> 
                        <a>ユーザー情報の変更</a>
                    </div>
                    <div class="bottom_box"> 
                        <a>ユーザーの削除</a>
                    </div>
                </div>
            </div>
        
            <div class="header_card">
                <div class="header_area">
                    <h3>売上</h3>
                    <p>売上を管理をします</p>
                </div>

                <div class="middle_area">
                    <h3>今月の売上</h3>
                    <div class="card_subtitle">100,000円</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box"> 
                        <a>一覧表示</a>
                    </div>
                    <div class="bottom_box"> 
                        <a>売上処理</a>
                    </div>
                </div>
            </div>

            <div class="header_card">
                <div class="header_area">
                    <h3>商品総数</h3>
                    <div class="card_subtitle">100個</div>
                </div>


                <div class="middle_area">
                    <h3>商品の種類</h3>
                    <div class="card_subtitle">25種類</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box"> 
                        <a>一覧表示</a> 
                    </div> 
                    <div class="bottom_box">
                        <a>商品情報の変更</a>
                    </div> 
                    <div class="bottom_box">
                        <a>商品の削除</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main_bottom">
            <div class="bottom_card">
                <div class="header_area">
                    <h3>入荷</h3>
                    <p>入荷商品を管理をします</p>
                </div>

                <div class="middle_area">
                    <h3>今月の入荷数</h3>
                    <div class="card_subtitle">10個</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box">
                        <a class="bottom_box">一覧表示</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
