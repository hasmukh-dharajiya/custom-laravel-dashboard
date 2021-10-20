<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Username & Password Recovery - Merchant Back Office</title>
    <meta name="description" content="Some description for the page"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">

</head>

<body class="h-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                @if(Session::get('success_status') == true)
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button>
                                        <p>{{ Session::get('message') }}</p>
                                    </div>
                                    <a href="/login" class="btn btn-primary">Go back to login</a>
                                @endif

                                @if(!Session::get('success_status') == true)
                                @if(!$status)
                                    <div align="center">
                                        <p>{{ $message }}</p>
                                        <a href="/login" class="btn btn-primary">Go back to login</a>
                                    </div>
                                @else
                                @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible fade show">
                                            <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                            </button>
                                            @foreach($errors->all() as $error)
                                                <p>{{ $error }}</p>
                                            @endforeach
                                        </div>
                                @endif



                                    <div id="reset_password">
                                        <h4 class="text-center mb-4">Reset your password</h4>
                                        <form action="{{ url('/v1/reset_password') }}" method="POST">
                                            @csrf
                                            <input type="hidden" class="form-control" name="key" value="{{ collect(request()->segments())->last() }}">
                                            <div class="form-group">
                                                <label><strong>New Password</strong></label>
                                                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                            </div>
                                            <div class="form-group">
                                                <label><strong>Confirm New Password</strong></label>
                                                <input type="password" class="form-control" name="new_password" value="{{ old('new_password') }}">
                                            </div>
                                            <div class="text-center">
                                                <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                            </div>
                                        </form>
                                    </div>
                                        @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('/vendor/global/global.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/chart.js/Chart.bundle.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/svganimation/vivus.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('/vendor/svganimation/svg.animation.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/custom.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/deznav-init.js') }}" type="text/javascript"></script>
</body>

</html>
