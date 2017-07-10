@extends('layouts.app')

@section('static')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
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
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @else
                <p class="flex-center title">Not Record</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
            {{$transactions->render()}}
        </div>
    </div>
</div>
@endsection
