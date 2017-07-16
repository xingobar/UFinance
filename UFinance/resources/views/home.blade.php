@extends('layouts.app')

@section('static')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
<style>
 .panel-body button{
     width:100px;
     height:40px;
 }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(count($transactions) > 0)
            @foreach($transactions as $transaction)
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="#collapse{{$transaction->id}}" data-toggle="collapse">收支紀錄 {{$transaction->created_at->toDateString()}}</a>
                        </h4>
                    </div>
                    <div id="collapse{{$transaction->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>交易名稱</th>
                                        <th>交易類型</th>
                                        <th>交易金額</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accounts as $account)
                                        @if($account->transactionId === $transaction->id)
                                        <tr>
                                            <td>{{$account->accountName}}</td>
                                            <td>{{$account->accountTypeName}}</td>
                                            <td>{{$account->amount}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="row text-right">
                                <div class="col-md-12 pull-right">
                                    <input type="hidden" class="transaction-id" name="transaction_id" value="{{$transaction->id}}">
                                    <button type="submit" class="btn btn-success modify-transaction" data-toggle="modal" data-target="#transaction{{$transaction->id}}"><span class="glyphicon glyphicon-pencil"></span> 編輯</button>
                                    <button type="button" class="btn btn-danger delete-transaction">刪除</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="transaction{{$transaction->id}}" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">收支紀錄 {{$transaction->created_at->toDateString()}}</h4>
                        </div>
                        <form class="form" method="post" action="/update">
                            {{csrf_field()}}
                            <input type="hidden" name="transaction_id" value="{{$transaction->id}}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="modal-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>交易名稱</th>
                                            <th>交易類型</th>
                                            <th>交易金額</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($accounts as $account)
                                            @if($account->transactionId === $transaction->id)
                                                <tr> 
                                                    <td><input type="text" name="account[]" value="{{$account->accountName}}" class="form-control"/></td>
                                                    <td>
                                                        <select class="form-control" name="type[]">
                                                            @foreach($types as $type)
                                                                <option value="{{$type->name}}" {{$account->accountTypeName === $type->name ? 'selected':''}}>{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td><input type="number" name="amount[]" value="{{$account->amount}}" class="form-control"/></td>
                                                </tr>
                                                @endif
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">提交</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">關閉</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                <p class="flex-center title">Not Record</p>
            @endif
        </div>
        <div class="col-md-4">
            <ul class="list-group">
                <li class="list-group-item" style="font-size:1.2em;background-color:rgb(241, 99, 99);color:#ececec">交易性質 / 種類</li>
                @foreach($types as $type)
                    <a class="list-group-item">{{$type->name}}</a>
                @endforeach
                @if(Auth::check())
                    <a href="/type" class="list-group-item">新增交易種類</a>
                @endif
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            {{$transactions->render()}}
        </div>
    </div>
</div>
@endsection
