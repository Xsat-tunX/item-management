@extends('adminlte::page')

@section('title', '商品入荷履歴')

@section('content_header')
    <h1>商品入荷履歴一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="history-card-header">                        
                    <div class="history-card-header-left">
                        <h3 class="card-title mb-0">入荷履歴一覧</h3>
                    </div>

                    <div class="history-card-header-center">
                        <form method="GET" action="{{ route('arriveHistory.search') }}" class="history-keyword-form">
                            <input type="text" class="historyKeywordForm-control" name="keyword" placeholder="商品名を入力" value="{{ request('keyword') }}">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>
                    </div>

                    <div class="history-card-header-right">
                        <form method="GET" action="{{ route('arriveHistory.search') }}" class="history-date-form">
                            <input type="date" class="historyDateForm-control" name="date_from" value="{{ request('date_from') }}">
                            <span>〜</span>
                            <input type="date" class="historyDateForm-control" name="date_to" value="{{ request('date_to') }}">
                            <button type="submit" class="btn btn-primary">検索</button>
                        </form>
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>入荷日</th>
                                    <th>ID</th>
                                    <th>名前</th>
                                    <th>種別</th>
                                    <th>カテゴリー</th>
                                    <th>詳細</th>
                                    <th>原価</th>
                                    <th>数量</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($logs as $log)
                                    <tr>
                                        <td>{{ $log->updated_at->format('Y-m-d')}}</td>
                                        <td>{{ $log->id }}</td>
                                        <td>{{ $log->item->name }}</td>
                                        <td>{{ $log->type }}</td>
                                        <td>{{ $log->item->category }}</td>
                                        <td>{{ $log->item->detail }}</td>
                                        <td>{{ $log->item->cost }}</td>
                                        <td>{{ $log->quantity }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>Total</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($totalCost) }}</td>
                                    <td>{{ $totalQuantity }}</td> 
                                </tr>
                            </tfoot>
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
@stop
