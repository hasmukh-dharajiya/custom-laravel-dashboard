@if(!$verify_at)
    <div class="row">
        <div class="col-xl-12">
            <div class="alert alert-primary left-icon-big alert-dismissible fade show">
                <div class="media">
                    <div class="alert-left-icon-big">
                        <span><i class="mdi mdi-email-alert"></i></span>
                    </div>
                    <div class="media-body">
                        <h6 class="mt-1 mb-2">Welcome to your account, Dear {{ $user_name ?? 'user' }}!</h6>
                        <p class="mb-0">Please confirm your email address: {{ $email_id ?? 'N/A' }}</p>
                    </div>
                    <div style="margin-top: 10px" id="mail-button">
                        <button type="button" class="btn btn-primary btn-sm" id="verify">Verify Now</button>
                    </div>
                    <div id="mail_box" style="margin-top: 15px; display: none;">
                        <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                        <strong>Mail Send Success!</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('script')
    <script>
        $(document).ready(function (){
            $('#verify').click(function (){
                var l = Ladda.create(document.getElementById('verify'));
                l.start();
                $.ajax({
                    url: '/send/verify',
                    type: 'POST',
                    dataType  : 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response){
                        if (response.status === true){
                            $('#mail_box').show();
                            $('#mail-button').hide();
                            console.log(response)
                        }else {
                            l.stop();
                            console.log(response)
                        }
                    }
                });
            });
        });
    </script>
@endsection
