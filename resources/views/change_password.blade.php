@extends('layout.master')
@section('title') Change Password @endsection
@section('contain')
    <div class="row page-titles mx-0">
        <div class="col-sm-6 p-md-0">
        </div>
        <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        @if(Session::get('status') == true)
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                </button>
                                <p>{{ Session::get('massage') }}</p>
                            </div>
                        @endif

                        <form action="{{ url('/change_password') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Current Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" placeholder="current Password" name="current_password"  value="{{ old('current_password') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">New Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" placeholder="New Password" name="new_password" value="{{ old('new_password') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Confirm New Password</label>
                                <div class="col-sm-5">
                                    <input type="password" class="form-control" placeholder="Confirm New Password" name="confirm_password" value="{{ old('confirm_password') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
