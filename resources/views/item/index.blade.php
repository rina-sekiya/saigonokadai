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
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>

 <!-- 検索フォーム -->              
<form action="{{ route('search') }}" method="GET">

    <input type="text" name="keyword">
    <input type="submit" class="btn btn-light" value="検索">
  </form>
            

                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>名前</th>
                                <th>在庫数</th>
                                <th>詳細</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->detail }}</td>
                                    <td><a href="/item/edit/{{$item->id}}" class="btn btn-info"> 在庫管理</td>
                                    <td><form method='POST' action="{{route('delete',$item->id)}}">@csrf<button type ="submit" onclick='return confirm("本当に削除しますか？")' class="btn btn-danger"> >>削除</button></form></td>
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
@stop

@section('js')
@stop
