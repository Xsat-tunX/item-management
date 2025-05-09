@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="main">
        <div class="main_header">
            <div class="header_area">
                <p class="heder_box">ユーザー数</p>
                <p class="bottom_box">1</p>
            </div>

            <div class="header_area">
                <p class="heder_box">今月の売上</p>
                <p class="bottom_box">100,000円</p>
            </div>

        </div>

        <div class="main_bottom">
            <div class="bottom_area">
                <p class="heder_box">商品数</p>
                <p class="bottom_box">100</p>
            </div>

            <div class="bottom_area">
                <p class="heder_box"></p>
                <p class="bottom_box"></p>
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
