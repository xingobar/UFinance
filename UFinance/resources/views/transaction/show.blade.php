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
                                        <th>交易名稱</th>
                                        <th>交易類型</th>
                                        <th>交易金額</th>
                                    </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" name="account[]" value="hehe"></td>
                                    <td>
                                        <select class="form-control" name="type[]">
                                            @foreach($types as $type)
                                                <option value="{{$type->name}}">{{$type->name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="number" name="amount[]" value="100"></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row pull-right">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary">新增</button>
                            </div>
                        </div>
                    </form>                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection