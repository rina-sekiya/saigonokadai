@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>在庫管理</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{'/item/edit/'.$item->id }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group"> 
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
                        </div>

                        <div class="form-group">
                            <label for="type">在庫数</label>
                            <input type="number" class="form-control" id="type" name="type" value="{{ $item->type }}">
                        </div>


                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" value="{{ $item->detail }}">
                        </div>
                    </div>
                     
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">変更</button>
                        <input type="hidden" name="id" value="{{$item->id}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
<h1>Create Post</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif