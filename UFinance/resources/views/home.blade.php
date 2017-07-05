@extends('layouts.app')

@section('static')
<link rel="stylesheet" href="{{asset('css/index.css')}}">
<script type="text/javascript" src="{{asset('js/index.js')}}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">總交易紀錄</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
