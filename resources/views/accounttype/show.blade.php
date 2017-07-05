@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    新增交易類型
                </div>
                <div class="panel-body">
                    <form method="post" action="/addAccountType">
                    {{csrf_field()}}
                        <div class="form-group">
                            <label for="typeName" class="col-md-offset-2 col-md-2 control-label">交易類型名稱</label>
                            <div class="col-md-5">
                                <input type="text" name="typeName" class="form-control" value="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">新增</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection