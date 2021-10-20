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
                                @if($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show">
                                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>
                                        <strong>Error!</strong> {{ $errors->first() }}
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button>
                                    </div>
                                @endif


                                @if(Session::get('status') == true)
                                        <img src="https://my.pc-tracker.com/images/send.png" alt="email_send" style="width: 40%;margin-top: -15px;">
                                        <p>An email with password reset instructions has been sent to your email address, if it exists on our system.</p>
                                        <a href="/login" class="btn btn-primary">Back To Login</a>
                                    @else
                                        <div id="forgot_password">
                                            <h4 class="text-center mb-4">Forgot Password</h4>
                                            <form action="{{ url('/v1/forgot_password') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label><strong>Email</strong></label>
                                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                                </div>
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary btn-block">SUBMIT</button>
                                                </div>
                                            </form>
                                        </div>
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
