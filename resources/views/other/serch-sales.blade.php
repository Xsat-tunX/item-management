@extends('adminlte::page')

@section('title', '売上処理')

@section('content_header')
    <h1>売上処理</h1>
@stop

@section('content')
<!-- 商品一覧 -->
    <div class="row section-space">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                            <h3 class="card-title">商品一覧</h3>
                        </div>
                        
                        <div class="card-header-center">
                            <form method="GET" action="{{ route('sales.search') }}" class="search-form">
                                <input type="text" class="searchForm-control" id="search" name="search" placeholder="商品名を入力" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">検索</button>
                            </form>
                        </div>

                        <div class="card-header-right">
                            <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                        </div>
                    </div>
                <div class="sales card-body p-0">
                    <div class="table-scroll">
                        <table class="table table-hover text-nowrap sales-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>名前</th>
                                    <th>種別</th>
                                    <th>詳細</th>
                                    <th>原価</th>
                                    <th>売価</th>
                                    <th>数量</th>
                                </tr>
                            </thead> 
                            <tbody id="item-list">
                                @foreach ($items as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->type }}</td>
                                        <td>{{ $item->detail }}</td>
                                        <td>{{ $item->cost }}</td>
                                        <td> <input type="number" name="price" class="sales-form-control" required></td>
                                        <td> <input type="number" name="quantity" class="sales-form-control" required></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- 売上処理一覧 -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header-left">
                        <h3 class="card-title">売上処理一覧</h3>
                    </div>
                    
                    <div class="card-header-right">
                        <a href="{{ url('items/add') }}" class="btn btn-default">売上一括登録</a>
                    </div>
                </div>
                <div class="sales-list card-body p-0">
                    <div class="table-scroll">
                        <table class="table table-hover text-nowrap sales-table">
                            <thead class="thead-sticky">
                                <tr>
                                    <th>ID</th>
                                    <th>名前</th>
                                    <th>種別</th>
                                    <th>詳細</th>
                                    <th>原価</th>
                                    <th>売価</th>
                                    <th>数量</th>
                                </tr>
                            </thead>
                            <tbody id="sales-list">
                                <tr class="placeholder">
                                    <td colspan="7" class="text-center text-muted">ここにリストをドロップ</td>
                                </tr>
                                <!-- ドラッグされた商品がここに表示される -->
                            </tbody>
                        </table>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    //商品一覧からー＞売上処理にドラッグ可能に
    new Sortable(document.getElementById('item-list'),{
        group: {
            name: 'shared',
            pull: 'clone',
            put: false
        },
        animation: 150
    });

    new Sortable(document.getElementById('sales-list'),{
        group: 'shared',
        animation: 150,
        onAdd: function(evt) {
            //新しく追加された<tr>を取得
            const salesList = document.getElementById('sales-list');
            const newRow = evt.item;

            //placeholderを消す
            const placeholder = salesList.querySelector('.placeholder');
            if (placeholder) {
                placeholder.remove();
            }

            //削除ボタン作成
            let deleteButton = document.createElement('button');
            deleteButton.textContent = '削除';
            deleteButton.classList.add('btn', 'btn-danger', 'btn-sm');

            //クリックしたら<tr>を削除
            deleteButton.addEventListener('click',function() {
                newRow.remove();
            });

            //最後の<td>にボタン追加
            const lastcell = newRow.querySelector('td:last-child');
            if (lastcell) {
                lastcell.appendChild(deleteButton);
            } else {
                //<td>が足りなかったら作ってもいい
                const td = document.createElement('td');
                td.appendChild(deleteButton);
                newRow.appendChild(td);
            }
        }
    });

</script>
@stop