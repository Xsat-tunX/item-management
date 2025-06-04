@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h3 class="card-title">商品一覧</h3>
                    </div>
                    
                    <div class="card-header-center">
                        <form method="GET" action="{{ route('item.search') }}" class="search-form">
                            <input type="text" class="searchForm-control" id="search" name="search" placeholder="商品名を入力" value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>
                    </div>

                    <div class="card-header-right">
                        <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>カテゴリー</th>
                                <th>詳細</th>
                                <th>原価</th>
                                <th>数量</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td>{{ $item->cost }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><a href="{{ route('item.edit', ['id' => $item->id]) }} " class="btn btn-default">編集</a></td>
                                    <td>
                                        <form action="{{ route('item.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn-danger" type="submit" onclick="return confirm('削除しますか？')">削除</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
@stop
