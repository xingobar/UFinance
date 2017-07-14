@extends('layouts.app')

@section('static')
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新增交易資訊
                </div>
                <div class="panel-body">
                    <form class="form" method="post" action="/addTransaction">
                        {{csrf_field()}}
                        <table class="table table-striped">
                            <thead>
                                    <tr>
                                        <th>名稱</th>
                                        <th>類型</th>
                                        <th>金額</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="account[]" value="hehe" class="form-control"></td>
                                    <td>
                                        <select class="form-control" name="type[]">
                                            @foreach($types as $type)
                                                <option value="{{$type->name}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" name="amount[]" value="100" class="form-control"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row pull-right">
                            <div class="col-md-12">
                                <button type="button" id="add_to_last" class="btn btn-info">新增一列</button>
                                <button type="button" id="remove_last" class="btn btn-danger">移除一列</button>
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </div>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection