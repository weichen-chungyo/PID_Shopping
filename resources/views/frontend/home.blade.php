@extends('layouts.app')

@section('content')
<div class="container">
    <div class="body row">
        <div class="col-md-2">
            <div class="col">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">個人資料</a>
                    <a class="nav-link " id="v-pills-myShopCart-tab" data-toggle="pill" href="#v-pills-myShopCart" role="tab" aria-controls="v-pills-myShopCart" aria-selected="true">我的購物車</a>
                    <a class="nav-link " id="v-pills-checkOrder-tab" data-toggle="pill" href="#v-pills-checkOrder" role="tab" aria-controls="v-pills-checkOrder" aria-selected="true">查看訂單</a>
                    </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">個人資料</div>
                                    <div class="card-body">
                                        @if(session('success'))
                                            <h1>{{session('success')}}</h1>
                                        @endif
                                        <form method="POST" action="{{url('/editProfile')}}" id="profileForm" name="profileForm" class="form-horizontal">
                                            {!! csrf_field() !!}
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="name" class="col-sm-4 control-label">Old Password </label>
                                                <div class="col-sm-12">
                                                <input
                                                            type="password"
                                                            class="form-control{{ $errors->has('oldPassword') ? ' is-invalid' : '' }}"
                                                            name="oldPassword"
                                                            placeholder="無填寫等同於不修改密碼"
                                                    >
                                                    @if ($errors->has('oldPassword'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('oldPassword') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 col-form-label ">New Password</label>

                                                <div class="col-sm-12">
                                                    <input
                                                            type="password"
                                                            class="form-control{{ $errors->has('newPassword') ? ' is-invalid' : '' }}"
                                                            name="newPassword"
                                                            placeholder="無填寫等同於不修改密碼"
                                                    >
                                                    @if ($errors->has('newPassword'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('newPassword') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group ">
                                                <label class="col-sm-4 col-form-label">Confirm New Password</label>

                                                <div class="col-sm-12">
                                                    <input
                                                            type="password"
                                                            class="form-control{{ $errors->has('newPassword_confirmation') ? ' is-invalid' : '' }}"
                                                            name="newPassword_confirmation"
                                                            placeholder="無填寫等同於不修改密碼"
                                                    >
                                                    @if ($errors->has('newPassword_confirmation'))
                                                        <div class="invalid-feedback">
                                                            <strong>{{ $errors->first('newPassword_confirmation') }}</strong>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Email</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email" value="" maxlength="50" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Addr</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="addr" name="addr" placeholder="Enter Addr" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Phone</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" value="" maxlength="50" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Coin</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="coin" name="coin" placeholder="Enter Coin" value="" maxlength="50" disabled>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-lg-6 offset-lg-4">
                                                    <button id="profileSubmitBtn" type="" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                    <a id="profileResetBtn"type="button" class="btn btn-primary">
                                                        Reset
                                                    </a>
                                                </div>
                                            </div>
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        <div class="tab-pane fade " id="v-pills-myShopCart" role="tabpanel" aria-labelledby="v-pills-myShopCart-tab">
                            <form class="form-inline">
                                <div class="form-group ">
                                    <lable  class="" for="chkAll"> 全選 </lable><input class="form-control" type="checkbox" name="chkAll"  />
                                </div>
                                <div class="form-group">
                                    <a class="form-control btn btn-danger" href="javascript:void(0)" onclick="delShopCartAll()">刪除</a> 
                                </div>
                                <div class="form-group">
                                    <a class="form-control btn btn-success" href="javascript:void(0)"  onclick="buy()">購買</a>
                                </div>
                            </form>
                            <div id="listDiv">

                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-checkOrder" role="tabpanel" aria-labelledby="v-pills-checkOrder-tab">
                            <div id="userOrder" class="row">
                                <h1>訂單查詢</h1>
                                <table id="orderTable" class="table table-bordered " style="width:100%"> 
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Staut</th>
                                            <th>Total</th>
                                            <th width="120px">Details</th>
                                            <th width="320px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                                <table id="orderDetailTable" class="table table-bordered " style="width:100%"> 
                                    <thead>
                                        <tr>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>

                                    </tfoot>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-md-1">
        </div>

    </div>
</div>
@push('scripts')
    <script src="{{ asset('js/user.js') }}"></script>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    
@endpush
@endsection
