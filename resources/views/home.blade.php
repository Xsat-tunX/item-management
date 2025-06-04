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
                        <a>ユーザー一覧</a>
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
                    <div class="card_subtitle">{{ number_format($monthlySales) }}円</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box"> 
                        <a href="{{ route('sales.history') }}">売上一覧</a>
                    </div>
                    <div class="bottom_box"> 
                        <a href="{{ route('sales.add') }}">売上処理</a>
                    </div>
                </div>
            </div>

            <div class="header_card">
                <div class="header_area">
                    <h3>商品総数</h3>
                    <div class="card_subtitle">{{ number_format($totalStock) }} 個</div>
                </div>


                <div class="middle_area">
                    <h3>商品の種類</h3>
                    <div class="card_subtitle">{{ $itemTypes }} 種類</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box"> 
                        <a href="{{ route('item.index') }}">商品一覧</a> 
                    </div> 
                    <div class="bottom_box">
                        <a href="{{ route('item.index') }}">商品情報の変更</a>
                    </div> 
                    <div class="bottom_box">
                        <a href="{{ route('item.index') }}">商品の削除</a>
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
                    <div class="card_subtitle">{{ number_format($monthlyArrive) }}個</div>
                </div>

                <div class="bottom_area">
                    <div class="bottom_box">
                        <a href="{{ route('arrive.history') }}">入荷一覧</a>
                    </div>
                    <div class="bottom_box">
                        <a href="{{ route('item.arrive') }}">入荷処理</a>
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
